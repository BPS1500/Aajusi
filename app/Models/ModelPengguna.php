<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengguna extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'fullname', 'email', 'nip_lama','roles', 'is_active', 'created_at'];

    public function getRoleName($roleId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $query = $builder->select('role_name')->where('id', $roleId)->get();
        return $query->getRow() ? $query->getRow()->role_name : null;
    }

    public function getRoleNames(array $roleIds)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $query = $builder->select('id, role_name')->whereIn('id', $roleIds)->get();
        $roles = [];
        foreach ($query->getResult() as $row) {
            $roles[$row->id] = $row->role_name;
        }
        return $roles;
    }
}
