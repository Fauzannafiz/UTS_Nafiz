<?php
namespace App\Modules\Pengguna\Models;
use CodeIgniter\Model;
class ModelGroups extends Model {
    protected $table      = 'auth_groups_users';
    protected $allowedFields = ['groud_id', 'user_id'];

    public function get_groups() {
        return $this->db->table('auth_groups_users')->get()->getResultArray(); 
    }
}