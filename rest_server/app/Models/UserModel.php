<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table        = 'users';
    protected $primaryKey   =  'id';
    protected $allowedFields    = [
        'firstname',
        'lastname',
        'email',
        'password'
    ];

    protected $beforeInsert = ['beforeinsert'];
    protected $beforeUpdate = ['beforeupdate'];

    protected function beforeinsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeupdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
