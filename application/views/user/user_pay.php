<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 1/28/15
 * Time: 17:30
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
$this->load->helper('form');
?><!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="utf-8">
    <meta name="google" value="notranslate" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title><?php echo SITE_NAME; ?> - 账户充值</title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('favicon.ico'); ?>" />
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url("static/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url("static/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url("static/css/AdminLTE.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("static/bootstrap-dialog/css/bootstrap-dialog.min.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.0.2 -->
    <script src="<?php echo base_url("static/js/jquery-2.0.3.min.js"); ?>"></script>
    <script src="<?php echo base_url("static/js/jquery.validate.min.js"); ?>"></script>
    <script src="<?php echo base_url("static/js/jquery.form.min.js"); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url("static/js/bootstrap.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("static/js/md5.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("static/bootstrap-dialog/js/bootstrap-dialog.min.js"); ?>"></script>
</head>
<body class="bg-black">
<div class="form-box" id="login-box">
    <div class="header"><?php echo SITE_NAME; ?> - 账户充值</div>
    <?php
    $attributes = array(
        'role' => 'form',
        'id' => 'payForm'//,
        //'onsubmit' => 'return logincheck()'
    );
    echo form_open('user/do_pay', $attributes);
    ?>
    <div class="body bg-gray">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input type="text"  id="username" name="username" class="form-control" tabindex=1 placeholder="Username" value="<?php echo $user_name; ?>" required disabled>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money fa-fw"></i></span>
                <input type="number"  id="fee" name="fee" class="form-control" tabindex=2 placeholder="Password" required>
            </div>
        </div>
    </div>
    <div class="footer">
        <button type="submit" class="btn bg-olive btn-block" name="login" tabindex=4>充值</button>
    </div>
    <?php echo form_close(); ?>
</div>
</body>
</html>
