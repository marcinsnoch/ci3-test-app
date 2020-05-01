<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_token')) {
    function generate_token()
    {
        $ci = & get_instance();
        $encryption_key = $ci->config->item('encryption_key');
        $token = openssl_random_pseudo_bytes(16);
        return bin2hex($token . $encryption_key);
    }
}

// End of file auth_helper.php
// Location: ./application/helpers/auth_helper.php
