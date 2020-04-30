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
        $title = 'Article';
        $this->twig->display('home/index', compact('title'));
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */