<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $users = UserModel::all();
        $this->twig->display('users/index', compact('users'));
    }

    public function create()
    {
        $this->is_admin();
        // validate the data
        if ($this->input->post('create') && $this->form_validation->run('create_user')) {
            // create account
            UserModel::create([
                'type' => $this->input->post('is_admin'),
                'email' => $this->input->post('email'),
                'full_name' => $this->input->post('full_name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ]);
            // set flash msg. "check your email..."
            alert_success('User created.');
            // redirect to login page
            redirect('users');
        }
        $this->twig->display('users/create');
    }

    public function edit($id)
    {
        $this->is_admin();
        $user = UserModel::withTrashed()->find($id);
        if ($this->input->post('update') && $this->form_validation->run('update_user')) {
            $user->email = $this->input->post('email');
            $user->full_name = $this->input->post('full_name');
            $user->is_admin = $this->input->post('is_admin');
            if ($this->input->post('password')) {
                $user->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $user->save();
            alert_success('Details have been saved.');
            redirect('/users');
        }
        $this->twig->display('users/edit', compact('user'));
    }

    public function destroy($id)
    {
        $this->is_admin();
        if ($id == $this->session->user_id) {
            alert_error('Nie możesz usunąć własnego konta! <br> W tym celu skontaktuj się z Administratorem.');
            redirect('users');
        }
        UserModel::find($id)->delete();
        alert_success('User deleted.');
        redirect('users');
    }

    public function restore($id)
    {
        $this->is_admin();
        UserModel::withTrashed()->find($id)->restore();
        alert_success('User restored.');
        redirect('users');
    }
}
