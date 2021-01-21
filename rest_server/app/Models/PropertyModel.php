<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{

    protected $table = 'property';
    protected $primaryKey = 'id_property';
    protected $allowedFields    = [
        'id_detail',
        'slug',
        'nama_property',
        'harga_property'
    ];

    public function getProperty($slug = null)
    {
        if ($slug === null) {
            return $this->join('detail', 'detail.id_detail = property.id_detail')->findAll();
        } else {
            return $this->join('detail', 'detail.id_detail = property.id_detail')->getWhere(['slug' => $slug])->getRowArray();
        }
    }

    public function insertProperty($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateProperty($data, $slug)
    {
        return $this->db->table($this->table)->update($data, ['slug' => $slug]);
    }

    public function deleteProperty($slug)
    {
        return $this->db->table($this->table)->delete(['slug' => $slug]);
    }
}
