<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('accounts_dropdown')) {
    function accounts_dropdown()
    {
        $ci = &get_instance();
        $query = $ci->db->query('SELECT `name`, `id` FROM `accounts` WHERE `deleted_at` IS NULL;');
        $accounts = [''=>'Wybierz konto'];
        foreach ($query->result() as $account) {
            $accounts[$account->id] = $account->name;
        }
        return form_dropdown('account_id', $accounts, $ci->session->account_id, 'id="accountIdDropDown" class="form-control"');
    }
}

if (!function_exists('array_from_post')) {
    function array_from_post(array $fields)
    {
        $ci = &get_instance();
        $data = [];
        foreach ($fields as $field) {
            $input = $ci->input->post($field);
            if ($input == '' || $input == false) {
                $data[$field] = null;
            } else {
                $data[$field] = $input;
            }
        }

        return $data;
    }
}

if (!function_exists('alert_success')) {
    function alert_success($msg, $title = null, $options = null)
    {
        $ci = &get_instance();
        $ci->session->set_flashdata('alert', ['type' => 'success', 'msg' => $msg, 'title' => $title, 'options' => $options]);
    }
}
if (!function_exists('alert_info')) {
    function alert_info($msg, $title = null, $options = null)
    {
        $ci = &get_instance();
        $ci->session->set_flashdata('alert', ['type' => 'info', 'msg' => $msg, 'title' => $title, 'options' => $options]);
    }
}

if (!function_exists('alert_warning')) {
    function alert_warning($msg, $title = null, $options = null)
    {
        $ci = &get_instance();
        $ci->session->set_flashdata('alert', ['type' => 'warning', 'msg' => $msg, 'title' => $title, 'options' => $options]);
    }
}

if (!function_exists('alert_error')) {
    function alert_error($msg, $title = null, $options = null)
    {
        $ci = &get_instance();
        $ci->session->set_flashdata('alert', ['type' => 'error', 'msg' => $msg, 'title' => $title, 'options' => $options]);
    }
}

// End of file application_helper.php
// Location: ./application/helpers/application_helper.php
