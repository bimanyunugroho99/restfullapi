<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PropertyModel;

class Property extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\PropertyModel';

    public function __construct()
    {
        $this->property = new PropertyModel();
    }

    public function index()
    {
        $property = $this->property->getProperty();
        if ($property) {
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $property,
            ];
            return $this->respond($response, 200);
        } else {
            $msg = ['message' => 'Data Is Not Found'];
            $response = [
                'status' => 401,
                'error' => true,
                'data' => $msg,
            ];
            return $this->respond($response, 401);
        }
    }


    public function create()
    {
        $validation =  \Config\Services::validation();

        $id_detail      = $this->request->getVar('id_detail');
        $nama_property  = $this->request->getVar('nama_property');
        $harga_property = $this->request->getVar('harga_property');
        $slug           = url_title($nama_property, '-', TRUE);

        $data = [
            'id_detail' => $id_detail,
            'slug'   =>  $slug,
            'nama_property' => $nama_property,
            'harga_property'    =>  $harga_property
        ];

        if ($validation->run($data, 'property') == FALSE) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {
            $simpan = $this->model->insertProperty($data);
            if ($simpan) {
                $msg = ['message' => 'Created category successfully'];
                $response = [
                    'status' => 200,
                    'error' => false,
                    'data' => $msg,
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function show($slug = NULL)
    {
        $get = $this->model->getProperty($slug);
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $get,
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response, $code);
    }

    public function edit($slug = NULL)
    {
        $get = $this->model->getProperty($slug);
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $get,
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response, $code);
    }

    public function update($slug = NULL)
    {
        $validation =  \Config\Services::validation();

        $data = $this->request->getRawInput();

        if ($validation->run($data, 'property') == FALSE) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {
            $ubah = $this->model->updateProperty($data, $slug);
            if ($ubah) {
                $msg = ['message' => 'Updated property successfully'];
                $response = [
                    'status' => 200,
                    'error' => false,
                    'data' => $msg,
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function delete($slug = NULL)
    {
        $hapus = $this->model->deleteProperty($slug);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Deleted category successfully'];
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $msg,
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response, $code);
    }
}
