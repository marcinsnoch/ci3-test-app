<?php

$config = [
    'login' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email'],
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'trim|required'],
    ],
    'user_email' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email|callback__email_exist'],
    ],
    'recovery_password' => [
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'required|trim|min_length[8]'],
        ['field' => 'confirm_password', 'label' => 'Powtórz hasło', 'rules' => 'required|trim|matches[password]'],
    ],
    'register_user' => [
        ['field' => 'full_name', 'label' => 'Imię i nazwisko', 'rules' => 'required|trim'],
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email|callback__email_not_exist'],
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'trim|required'],
        ['field' => 'confirm_password', 'label' => 'Powtórz hasło', 'rules' => 'required|trim|matches[password]'],
        ['field' => 'terms', 'label' => 'Regulamin', 'rules' => 'required'],
    ],
    'create_user' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim'],
        ['field' => 'full_name', 'label' => 'Imię i nazwisko', 'rules' => 'required|trim'],
        ['field' => 'is_admin', 'label' => 'Type', 'rules' => 'required|trim'],
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'trim'],
        ['field' => 'confirm_password', 'label' => 'Powtórz hasło', 'rules' => 'trim|matches[password]'],
    ],
    'update_user' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim'],
        ['field' => 'full_name', 'label' => 'Imię i nazwisko', 'rules' => 'required|trim'],
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'trim'],
        ['field' => 'confirm_password', 'label' => 'Powtórz hasło', 'rules' => 'trim|matches[password]'],
    ],
    'update_profile' => [
        ['field' => 'full_name', 'label' => 'Imię i nazwisko', 'rules' => 'required|trim'],
        ['field' => 'password', 'label' => 'Hasło', 'rules' => 'trim'],
        ['field' => 'confirm_password', 'label' => 'Powtórz hasło', 'rules' => 'trim|matches[password]'],
    ],
    'create_account' => [
        ['field' => 'name', 'label' => 'Nazwa', 'rules' => 'required|trim'],
    ],
    'update_account' => [
        ['field' => 'name', 'label' => 'Nazwa', 'rules' => 'required|trim'],
    ],
    'create_location' => [
        ['field' => 'name', 'label' => 'Nazwa lokalizacji', 'rules' => 'required|trim'],
        ['field' => 'description', 'label' => 'Opis', 'rules' => 'trim'],
    ],
    'create_product' => [
        ['field' => 'number', 'label' => 'Numer produktu', 'rules' => 'required|callback__product_check|trim'],
        ['field' => 'name', 'label' => 'Nazwa produktu', 'rules' => 'required|trim'],
        ['field' => 'warehouse_id', 'label' => 'Magazyn', 'rules' => 'required|trim'],
    ],
    'create_delivery' => [
        ['field' => 'date', 'label' => 'Data dostawy', 'rules' => 'required|trim'],
        ['field' => 'product_number', 'label' => 'Numer produktu', 'rules' => 'required|trim'],
        ['field' => 'quantity', 'label' => 'Ilość', 'rules' => 'required|trim'],
    ],
];

$config['error_prefix'] = '<div class="invalid-feedback">';
$config['error_suffix'] = '</div>';
