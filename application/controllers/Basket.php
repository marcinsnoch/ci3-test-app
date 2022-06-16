<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Basket extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $this->twig->display('basket/index');
    }

    // insert item in to basket
    public function insert($id)
    {
        $product = ProductModel::find($id) ?? show_404();

        // sprawdź czy można dodać do koszyka

//        if (in_array($product->status, [4, 5, 6, 8, 13, 14])) {
//            alert_error('Nie możesz zamówieć tego produktu.');
//            redirect('products/show/' . $product->id);
//        }

        $data = [
            'id' => $product->id,
            'qty' => 1,
            'price' => 1.0,
            'name' => $product->number,
            'options' => [
                'item_name' => $product->name,
            ],
        ];
        $this->cart->insert($data);
        alert_success('Dodano do koszyka!');
        redirect('products/show/' . $product->id);
    }

    // remove item from basket
    public function remove($row_id)
    {
        if ($row_id) {
            $this->cart->remove($row_id);
            alert_info('Produkt usunięty z koszyka!');
        }
        redirect('basket');
    }

    // remove all items from the basket
    public function destroy()
    {
        $this->cart->destroy();
        alert_info('Zawartość koszyka wyczyszczona!');
        redirect('basket');
    }

    public function ajax_store()
    {
        $this->input->is_ajax_request() || show_404();

//        if ($this->is_admin('return') or!$this->form_validation->run('create_account')) {
//            $out = [
//                'statusCode' => '400',
//                'message' => 'Nie posiadasz uprawnień do wykonania tej akcji!',
//            ];
//            $this->output
//                    ->set_content_type('application/json')
//                    ->set_output(json_encode($out));
//            return;
//        }

        $id = $this->input->post('id');
        $quantity = $this->input->post('quantity');

        $product = ProductModel::find($id) ?? show_404();
        $data = [
            'id' => $product->id,
            'qty' => $quantity,
            'price' => 1.0,
            'name' => $product->number,
            'options' => [
                'item_name' => $product->name,
            ],
        ];
        $this->cart->insert($data);

        $out = [
            'statusCode' => '200',
            'message' => 'Dodano nowe konto!',
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($out));
    }
}
