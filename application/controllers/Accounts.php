<?php

class Accounts extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $this->twig->display('accounts/index');
    }

    public function edit($id = null)
    {
        $this->is_admin();
        $account = AccountModel::withTrashed()->find($id);
        if ($this->input->post('update_account') && $this->form_validation->run('update_account')) {
            $account->name = $this->input->post('name');
            $account->save();
            alert_success('Zapisano!');
            redirect('accounts');
        }
        $this->twig->display('accounts/edit', compact('account'));
    }

    public function destroy($id)
    {
        $this->is_admin();
        AccountModel::find($id)->delete();
        alert_success('Konto wyłączone!');
        redirect('accounts');
    }

    public function restore($id)
    {
        $this->is_admin();
        AccountModel::withTrashed()->where('id', $id)->restore();
        alert_success('Konto włączone!');
        redirect('accounts');
    }

    public function allocations($id = null)
    {
        $account = AccountModel::find($id);
        $this->twig->display('accounts/allocations', compact('account'));
    }

    // Ajax methods
    public function ajax_get()
    {
        $this->input->is_ajax_request() || show_404();
        $accounts = AccountModel::pluck('name', 'id')->prepend('', '')->toArray();
        $this->output->set_content_type('application/json')->set_output(json_encode($accounts));
    }

    public function ajax_set()
    {
        $this->input->is_ajax_request() || show_404();

        $account_id = $this->input->post('account_id');
        if ($account_id > 0) {
            $this->session->set_userdata(['account_id' => $account_id]);

            return;
        }

        $this->session->set_userdata(['account_id' => '']);
    }

    public function ajax_store()
    {
        $this->input->is_ajax_request() || show_404();
        if (!$this->is_admin(false)) {
            $this->_return_json_message('400', 'Nie posiadasz uprawnień do wykonania tej akcji!');

            return;
        }

        if (!$this->form_validation->run('create_account')) {
            $this->_return_json_message('400', 'Błąd walidacji danych!');

            return;
        }
        AccountModel::create(['name' => $this->input->post('name')]);
        $this->_return_json_message('200', 'Dodano nowe konto!');
    }

    public function table_data()
    {
        $this->input->is_ajax_request() || show_404();
        $data = AccountModel::when(array_key_exists('archive', $this->input->get()), function ($query) {
            $query->onlyTrashed();
        })->get();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function products_table_data()
    {
        $this->input->is_ajax_request() || show_404();
        $data = AccountModel::with('products.product')->find($this->input->get('account_id'));
        $this->output->set_content_type('application/json')->set_output(json_encode($data->products));
    }
}
