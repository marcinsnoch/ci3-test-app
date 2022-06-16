<?php
defined('BASEPATH') or exit('No direct script access allowed');

// twig library configs
$config['twig'] = [
    'functions' => [
        'array_key_exists',
        'app_lang',
        'character_limiter',
        'dd',
        'in_basket',
        'lang',
    ],
    'functions_safe' => [
        'accounts_dropdown',
        'process_alert',
        'heading',
        'label',
        'countries_list',
    ]
];
