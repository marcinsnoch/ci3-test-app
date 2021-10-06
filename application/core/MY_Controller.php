<?php

class MY_Controller extends CI_Controller
{

    /**
     * A list of helpers to be autoloaded.
     */
    protected $helpers = [];

    /**
     * A list of Twig globals.
     */
    protected $twig_globals = [];


    /**
     * Initialize the controller, tie into the CodeIgniter superobject
     * and try to autoload the models and helpers.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->language('application');
        $this->_load_twig_globals(['config', 'session']);
        $this->_load_helpers();
        $this->_activity();
    }

    /**
     * Load helpers based on the $this->helpers array.
     */
    private function _load_helpers()
    {
        foreach ($this->helpers as $helper) {
            $this->load->helper($helper);
        }
    }

    /**
     * Load Twig globals
     */
    private function _load_twig_globals($defaults = [])
    {
        $globals = array_merge($defaults, $this->twig_globals);
        foreach ($globals as $key => $val) {
            if (is_int($key)) {
                $this->twig->addGlobal($val, $this->{$val});
            } else {
                $this->twig->addGlobal($key, $val);
            }
        }
    }

    /**
     * Redirect to login page
     * if not logged in
     */
    public function logged_in()
    {
        if ((bool) !$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
    
    public function _activity()
    {
        $last_activity = $this->session->last_activity;
        if ($this->uri->segment(1) != 'logout' && $last_activity) {
            $interval = 600; // 10 min.
            $time_since = (now() - human_to_unix($last_activity));
            if ($time_since > $interval) {
                $this->db->set('last_activity', unix_to_human(now(), true, 'eu'))->where('id', $this->session->user_id)->update('users');
            }        
        }
    }
}
