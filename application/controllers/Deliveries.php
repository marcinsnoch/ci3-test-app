<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Deliveries extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $this->twig->display('deliveries/index');
    }

    public function edit($id = null)
    {
        $delivery = DeliveryModel::with('product')->find($id);
        $this->twig->display('deliveries/edit', compact('delivery'));
    }

    public function destroy($id)
    {
        $this->is_admin();
        $delivery = DeliveryModel::with('product')->find($id);
        $delivery->product->quantity = ($delivery->product->quantity - $delivery->quantity);
        $delivery->push();
        $delivery->delete();
        alert_success('Dostawa usunięta!');
        redirect('deliveries');
    }

    public function ajax_store()
    {
        $this->input->is_ajax_request() || show_404();

        if (!$this->is_admin(false)) {
            $this->_return_json_message('400', 'Nie posiadasz uprawnień do wykonania tej akcji!');
            return;
        }

        if (!$this->form_validation->run('create_delivery')) {
            $this->_return_json_message('200', validation_errors());
            return;
        }

        $product = ProductModel::where('number', $this->input->post('product_number'))->first();
        $product->deliveries()->create([
            'date' => $this->input->post('date'),
            'quantity' => $this->input->post('quantity'),
            'user_id' => 1,
        ]);
        $product->quantity = ($product->quantity + $this->input->post('quantity'));
        $product->save();
        //TODO: sprawdź czy podano adres do powiadomień (table:options)
        $this->load->library('Sendmail');
        $this->sendmail->deliveryConfirmationEmail(UserModel::find($product->user_id), $product);
        $this->_return_json_message('200', 'Dodano dostawę produktu!');
    }

    public function table_data()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $data = DeliveryModel::with('product', 'user')->get();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
