<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $user = UserModel::find($this->session->user_id);
        $this->twig->display('profile/index', compact('user'));
    }
}
