<?php

/**
 * A base controller for CodeIgniter with view autoloading, layout support,
 * model loading, helper loading, asides/partials and per-controller 404.
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-controller
 *
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */
class MY_Controller extends CI_Controller
{

    /**
     * A list of models to be autoloaded.
     */
    protected $models = [];

    /**
     * A formatting string for the model autoloading feature.
     * The percent symbol (%) will be replaced with the model name.
     */
    protected $model_string = '%_model';

    /**
     * A list of helpers to be autoloaded.
     */
    protected $helpers = [];
    
    /**
     * A list of Twig globals.
     */
    protected $twig_globals = [];


    /**
     * Initialise the controller, tie into the CodeIgniter superobject
     * and try to autoload the models and helpers.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->language('application');

        $this->_load_twig_globals();
        $this->_load_models();
        $this->_load_helpers();
    }

    /**
     * Load models based on the $this->models array.
     */
    private function _load_models()
    {
        foreach ($this->models as $model) {
            $this->load->model($this->_model_name($model), $model);
        }
    }

    /**
     * Returns the loadable model name based on
     * the model formatting string.
     */
    protected function _model_name($model)
    {
        return str_replace('%', $model, $this->model_string);
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
    private function _load_twig_globals()
    {
        foreach ($this->twig_globals as $global) {
            $this->twig->addGlobal($global, $this->{$global});
        }
    }
}
