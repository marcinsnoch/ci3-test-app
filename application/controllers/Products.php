<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
    }

    public function index()
    {
        $warehouses = WarehouseModel::pluck('name', 'id')->prepend('Wybierz magazyn', '')->toArray();
        $years = [2020 => '2020', '2021', '2022', '2023'];
        krsort($years);
        $this->twig->display('products/index', compact('warehouses', 'years'));
    }

    public function create()
    {
        $this->is_admin();
        $warehouses = WarehouseModel::pluck('name', 'id')->prepend('', '')->toArray();
        $locations = LocationModel::pluck('name', 'id')->prepend('', '')->toArray();

        if ($this->input->post('create_product') && $this->form_validation->run('create_product')) {
            ProductModel::create([
                'number' => $this->input->post('number'),
                'name' => $this->input->post('name'),
                'warehouse_id' => $this->input->post('warehouse_id'),
                'user_id' => $this->session->user_id,
            ]);
            alert_success('Dodano produkt!');
            redirect('products');
        }
        $this->twig->display('products/create', compact('locations', 'warehouses'));
    }

    public function show($id)
    {
        $locations = LocationModel::pluck('name', 'id')->prepend('-brak-', '')->toArray();
        $product = ProductModel::with('allocations.account', 'deliveries.user', 'user')->find($id);
        $this->twig->display('products/show', compact('locations', 'product'));
    }

    public function edit($id)
    {
        $product = ProductModel::with('allocations.account', 'user')->find($id);
        $warehouses = WarehouseModel::pluck('name', 'id')->toArray();
        $this->twig->display('products/edit', compact('product', 'warehouses'));
    }

    public function allocations($id)
    {
        $product = ProductModel::with('allocations.account')->find($id);
        $this->twig->display('products/allocations', compact('product'));
    }

    // Ajax methods
    public function location()
    {
        $this->input->is_ajax_request() || show_404();
        $this->is_admin('return');
        $product = ProductModel::find($this->input->post('product_id')) ?? show_404();
        $product->location_id = $this->input->post('location_id') ?: null;
        $product->save();
        $this->_return_json_message('200', 'Lokalizacja produktu zmieniona!');
    }

    public function table_data()
    {
        $this->input->is_ajax_request() || show_404();

        $data = ProductModel::with('location', 'warehouse')
            ->when($this->session->account_id > 0, function ($query) {
                $query->whereHas('allocations', function ($query) {
                    $query->where('account_id', $this->session->account_id);
                });
            })
            ->when(array_key_exists('warehouse', $this->input->get()), function ($query) {
                $query->where('warehouse_id', $this->input->get('warehouse'));
            })
            ->when(array_key_exists('year', $this->input->get()), function ($query) {
                $query->whereRaw('YEAR(created_at) = ' . $this->input->get('year'));
            })
            ->get();

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // Private methods
    public function _product_check($number)
    {
        if (ProductModel::where('number', $number)->count()) {
            $this->form_validation->set_message('_product_check', 'Produkt o podanym kodzie już istnieje. Wprowadź inny kod prodktu.');

            return false;
        }

        return true;
    }
}
