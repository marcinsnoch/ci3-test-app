<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller {

    protected $models = [
    ];
    protected $twig_globals = [
        'config',
        'session',
    ];

    public function __construct() {
        parent::__construct();
        $this->logged_in();
    }

    public function index() {
        $title = 'Article';
        $this->twig->display('home/index', compact('title'));
    }

    public function test() {
        $this->twig->display('home/test');
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */