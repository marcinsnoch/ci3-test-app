<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $this->twig->display('orders/index');
    }

    public function create()
    {
        $accounts = AccountModel::pluck('name', 'id')->prepend('', '')->toArray();
        $this->twig->display('orders/create', compact('accounts'));
    }

    public function show($id)
    {
        $order = OrderModel::with('shipments')->find($id);
        $this->twig->display('orders/show', compact('order'));
    }

    public function destroy($id)
    {
        $this->is_admin();
        OrderModel::find($id)->delete();
        alert_success('Zamówienie usunięte.');
        redirect('orders');
    }

    public function prepare()
    {
        dump($this->cart->contents());
    }

    public function table_data()
    {
        $this->input->is_ajax_request() || show_404();
        $data = OrderModel::with('products', 'user')->get();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
