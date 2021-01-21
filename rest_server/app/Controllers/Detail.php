<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DetailModel;

class Detail extends ResourceController
{
    protected $format       = 'json';
    protected $modelName    = 'App\Models\DetailModel';

    public function __construct()
    {
        $this->detail   = new DetailModel();
    }

    public function index()
    {
        $detail = $this->detail->getDetail();
        if ($detail) {
            $response = [
                'status'    => 200,
                'error'     => false,
                'data'      => $detail,
            ];
            return $this->respond($response, 200);
        } else {
            $msg = ['message'   => 'Data is not found'];
            $response = [
                'status'    => 401,
                'error'    => true,
                'data'      => $msg,
            ];
            return $this->respond($response, 401);
        }
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'gambar'    => 'uploaded[gambar]|max_size[gambar, 1024]|is_image[gambar]',
            'jenis'     => 'required'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $this->validator->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {

            $file = $this->request->getFile('gambar');
            if (!$file->isValid())
                return $this->fail($file->getErrorString());

            $file->move('./assets/uploads');

            $jenis      = $this->request->getVar('jenis');
            $data = [
                'gambar'    => $file->getName(),
                'jenis'     => $jenis
            ];
            $simpan = $this->model->insertDetail($data);
            if ($simpan) {
                $msg = ['message' => 'Created detail successfully'];
                $response = [
                    'status'    => 200,
                    'error'     => false,
                    'data'      => $msg,
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function show($id_detail = null)
    {
        $get = $this->model->getDetail($id_detail);
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

    public function edit($id_detail = null)
    {
        $get = $this->model->getDetail($id_detail);
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

    public function update($id_property = null)
    {
        helper(['form']);

        $rules = [
            'gambar'    => 'uploaded[gambar]|max_size[gambar, 1024]|is_image[gambar]',
            'jenis'     => 'required'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $this->validator->getErrors(),
            ];
            return $this->respond($response, 500);
        } else {
            $file = $this->request->getFile('gambar');
            if ($file->getError() == 4) {
                $namaGambar = $this->request->getVar('gambar');
            } else {
                $namaGambar = $file->getRandomName();
                $file->move('./assets/uploads', $namaGambar);
            }
            $jenis      = $this->request->getVar('jenis');
            $data = [
                'gambar'    => $file->getName(),
                'jenis'     => $jenis
            ];
            $ubah = $this->model->updateDetail($data, $id_property);
            if ($ubah) {
                $msg = ['message' => 'Updated detail successfully'];
                $response = [
                    'status'    => 200,
                    'error'     => false,
                    'data'      => $msg,
                ];
                return $this->respond($response, 200);
            }
        }
    }

    public function delete($id_detail = null)
    {
        $hapus = $this->model->deleteDetail($id_detail);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Deleted detail successfully'];
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
