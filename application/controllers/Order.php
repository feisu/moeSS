<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 1/28/15
 * Time: 19:55
 */

/**
 * moeSS
 *
 * moeSS is an open source Shadowsocks frontend for PHP 5.4 or newer
 * Copyright (C) 2015  wzxjohn
 *
 * This file is part of moeSS.
 *
 * moeSS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * moeSS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with moeSS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package	moeSS
 * @author	wzxjohn
 * @copyright	Copyright (c) 2015, wzxjohn (https://maoxian.de/)
 * @license	http://www.gnu.org/licenses/ GPLv3 License
 * @link	http://github.com/wzxjohn/moeSS
 * @since	Version 1.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }

    function is_login()
    {
        if ($this->session->userdata('s_uid') && $this->session->userdata('s_username'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function form($trade_no)
    {
        if ($this->is_login())
        {
            $trade = $this->order_model->t_select($trade_no);
            if (!$trade)
            {
                echo "非法访问！";
            }
            if ($this->session->userdata('s_username') == $trade->user_name)
            {
                echo $trade->body;
            }
            else
            {
                echo "非法访问！";
            }
        }
        else
        {
            redirect(site_url('user/login'));
        }
        return;
    }

    function callback ($method)
    {
        // 加载支付宝配置
        $this->config->load('alipay', TRUE);
        // 加载支付宝返回通知类库
        require_once(APPPATH."third_party/alipay/alipay_notify.class.php");
        // 初始化支付宝返回通知类
        $alipayNotify = new AlipayNotify($this->config->item('alipay'));

        $input = array();
        $is_ajax = FALSE;
        $notify_status = 'success';

        // 这里做同步还是异步的判断并获取返回数据验证请求
        switch ($method) {
            case 'notify':
                $result = $alipayNotify->verifyNotify();
                $input = $this->input->post();
                $is_ajax = TRUE;
                break;

            case 'return':
                $result = $alipayNotify->verifyReturn();
                $input = $this->input->get();
                break;

            default:
                return $this->out_not_found();
                break;
        }

        // 支付宝返回支付成功和交易结束标志
        if ($result && ($input['trade_status'] == 'TRADE_FINISHED' || $input['trade_status'] == 'TRADE_SUCCESS'))
        {
            $trade_no = $input['out_trade_no'];

            // 验证成功则更新订单信息（略）
            // ...
        }
        else
        {
            // 否则置状态为失败
            $notify_status = 'fail';
        }

        if ($is_ajax)
        {
            // 异步方式调用模板输出状态
            $this->view->load('alipay', array('status' => $notify_status));
        }
        else
        {
            // 同步方式跳转到订单详情控制器，redirect方法要你自己写
            return $this->redirect("order/view/$id#status:$notify_status");
        }
    }
}
