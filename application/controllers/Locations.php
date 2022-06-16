<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Locations extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $locations = LocationModel::all();
        $this->twig->display('locations/index', compact('locations'));
    }

    public function ajax_store()
    {
        $this->input->is_ajax_request() || show_404();
        if (!$this->form_validation->run('create_location')) {
            $output = [
                'statusCode' => '400',
                'message' => validation_errors(),
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($output));

            return;
        }
        LocationModel::create([
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        ]);
        $this->output->set_content_type('application/json')->set_output(json_encode(['statusCode' => '200']));
    }

    public function table_data()
    {
        $this->input->is_ajax_request() || show_404();

        $data = LocationModel::all();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
