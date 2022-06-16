<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Options extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $options = OptionModel::all();

        if ($this->input->post('update_options')) {
            foreach ($options as $val) {
                OptionModel::where('id', '=', $val->id)->update(['values' => $this->input->post($val->name) ?: null]);
            }
            alert_success('Zaktualizowano!');
            redirect('options');
        }

        $this->twig->display('options/index', compact('options'));
    }
}
