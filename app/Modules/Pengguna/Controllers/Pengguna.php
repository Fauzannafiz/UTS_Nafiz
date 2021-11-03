<?php
namespace App\Modules\Pengguna\Controllers;
use App\Controllers\BaseController;

use App\Modules\Pengguna\Models\ModelGroups;

class Pengguna extends BaseController {
    protected $db, $builder;
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index() {
        $data['title'] = 'List Pengguna';

        
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
        $viewPengguna = 'App\Modules\Pengguna\Views\viewPengguna';
        return view($viewPengguna, $data);
    }

    public function detail($id = 0) {
        $data['title'] = 'Detail Pengguna';

        
        $this->builder->select('users.id as userid, username, email, fullname, user_image,name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if(empty($data['user'])) {
            return redirect()->to('/Pengguna');
        }
        $detailPengguna = 'App\Modules\Pengguna\Views\detailPengguna';
        return view($detailPengguna, $data);
    }

    public function delete($id) {

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $query->$this->builder->delete($id);
        return redirect()->to('/Pengguna');
    }

    public function ubah($user_id) {
        $groups = new ModelGroups();
        $data['auth_groups_users'] = $groups->find($user_id);
        if (!$data['auth_groups_users']) return redirect()->to('Pengguna');
        $editPengguna = 'App\Modules\Pengguna\Views\editPengguna';
        return view($editPengguna, $data);
      }

    public function edit($user_id) {
        $groups = new ModelGroups();
        $groups->update($user_id, [
            'group_id' => $this->request->getVar('group_id'),
        ]);
    }
}
?>