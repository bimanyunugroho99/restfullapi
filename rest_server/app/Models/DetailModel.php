<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{

    protected $table = 'detail';
    protected $primaryKey = 'id_detail';
    protected $allowedFields    = [
        'gambar',
        'jenis'
    ];

    public function getDetail($id_detail = null)
    {
        if ($id_detail === null) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_detail' => $id_detail])->getRowArray();
        }
    }

    public function insertDetail($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDetail($data, $id_detail)
    {
        return $this->db->table($this->table)->update($data, ['id_detail' => $id_detail]);
    }

    public function deleteDetail($id_detail)
    {
        return $this->db->table($this->table)->delete(['id_detail' => $id_detail]);
    }
}
