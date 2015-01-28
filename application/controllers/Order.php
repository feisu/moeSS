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

class Admin extends CI_Controller
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
}
