<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 1/28/15
 * Time: 19:59
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

class Order_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        return $this->load->database();
    }

    function t_f_select($trade_no)
    {
        $this->db->where('trade_no', $trade_no);
        $query = $this->db->get('transaction_form');
        if ($query->num_rows() > 0)
        {
            return $query->result()[0];
        }
        else
        {
            return FALSE;
        }
    }

    function t_select($trade_no)
    {
        $this->db->where('trade_no', $trade_no);
        $query = $this->db->get('transactions');
        if ($query->num_rows() > 0)
        {
            return $query->result()[0];
        }
        else
        {
            return FALSE;
        }
    }

    function add_money($trade_no)
    {
        $this->db->where('trade_no', $trade_no);
        $query = $this->db->get('transactions');
        if ($query->num_rows() > 0)
        {
            $query = $query->result()[0];
            if ($query->result)
            {
                return TRUE;
            }
            else
            {
                $data = array(
                    'result' => TRUE,
                    'ftime' => time()
                );
                $this->db->where('trade_no', $trade_no);
                $this->db->update('transactions', $data);
            }
        }
        else
        {
            return FALSE;
        }
        $this->db->select('money');
        $this->db->where('user_name', $query->user_name);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0)
        {
            $money = $query->result()[0]->money;
            $money = $money + $query->amount;
            $data = array( 'money' => $money );
            $this->db->limit(1);
            $this->db->where('user_name', $query->user_name);
            return $this->db->update('user',$data);
        }
        else
        {
            return FALSE;
        }
    }

    function finish_trade($trade_no, $notify_id, $buyer_email, $ftime)
    {
        $data = array(
            'notify_id' => $notify_id,
            'buyer_email' => $buyer_email,
            'ftime' => $ftime,
            'result' => TRUE
        );
        $this->db->where('trade_no', $trade_no);
        return $this->db->update('transactions',$data);
    }
}