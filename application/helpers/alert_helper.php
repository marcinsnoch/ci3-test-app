<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Codeigniter alert helper.
 *
 * @author   Marcin Snoch marcin.msx@gmail.com
 *
 * @version  1.0.0
 */

/**
 * Base alert.
 *
 * Set alert data in session
 *
 * @access    public
 * @param     string   message to show in alert box
 */
function _base_alert($type, $msg, $title, $timer)
{
    $CI = & get_instance();
    $alert = serialize([
        'type' => $type,
        'msg' => $msg,
        'title' => $title,
        'timer' => $timer,
    ]);
    $CI->session->set_flashdata('alert', $alert);
}

/*
 * Info alert
 *
 * Set info alert
 *
 * @access    public
 * @param     string   message to show in alert box
 */
if (!function_exists('alert_info')) {
    function alert_info($msg = '', $title = 'Info', $timer = 3)
    {
        if ($title === '' || $title === null) {
            $title = 'Info';
        }

        _base_alert('info', $msg, $title, $timer);
    }
}

/*
 * Success alert
 *
 * Set success alert
 *
 * @access    public
 * @param     string   message to show in alert box
 */
if (!function_exists('alert_success')) {
    function alert_success($msg = '', $title = 'Success', $timer = 3)
    {
        if ($title === '' || $title === null) {
            $title = 'Success';
        }

        _base_alert('success', $msg, $title, $timer);
    }
}

/*
 * Warning alert
 *
 * Set warning alert
 *
 * @access    public
 * @param     string   message to show in alert box
 */
if (!function_exists('alert_warning')) {
    function alert_warning($msg = '', $title = 'Warning', $timer = 3)
    {
        if ($title === '' || $title === null) {
            $title = 'Warning';
        }

        _base_alert('warning', $msg, $title, $timer);
    }
}

/*
 * Error alert
 *
 * Set error alert
 *
 * @access    public
 * @param     string   message to show in alert box
 */
if (!function_exists('alert_error')) {
    function alert_error($msg = '', $title = 'Error', $timer = 3)
    {
        if ($title === '' || $title === null) {
            $title = 'Error';
        }

        _base_alert('danger', $msg, $title, $timer);
    }
}

/**
 * Process alert
 *
 * Display Bootstrap alerts
 *
 * @access    public
 * @param     string   $alert_data
 * @return    html
 */
function process_alert($alert_data = null, $return = false)
{
    if ($alert_data) {
        $data = unserialize($alert_data);
        if ($return) {
            return json_encode($data);
        }
        $icon = [
            'info' => 'glyphicon glyphicon-info-sign',
            'success' => 'glyphicon glyphicon-ok',
            'warning' => 'glyphicon glyphicon-warning-sign',
            'danger' => 'glyphicon glyphicon-remove',
        ];
        $html = '<div id="alert" style="position: fixed; top: 5%; left: 0; right: 0; width: 50%; margin: auto; z-index: 999999;">';
        $html .= '<div class="alert alert-' . $data['type'] . '" data-timer="' . $data['timer'] . '" >';
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $html .= '<span class="' . $icon[$data['type']] . '"></span>&nbsp;&nbsp;';
        $html .= '<strong>' . $data['title'] . '</strong>';
        $html .= '<p>' . $data['msg'] . '</p>';
        $html .= '</div></div>';

        return $html;
    }
}

// End of file alert_helper.php
// Location: ./application/helpers/alert_helper.php
