<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    protected $models = [
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['title'] = 'Tytuł w zmiennej';
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */