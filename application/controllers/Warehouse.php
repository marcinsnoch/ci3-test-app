<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $this->twig->display('warehouse/index');
    }

    public function table_data()
    {
        $this->input->is_ajax_request() || show_404();

        $data = WarehouseModel::all();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
