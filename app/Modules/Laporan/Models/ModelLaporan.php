<?php
namespace App\Modules\Laporan\Models;
use CodeIgniter\Model;
class ModelLaporan extends Model {
    protected $table      = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = ['id_sarana', 'id_cs','nama', 'tanggal', 'detail', 'hp_email', 'screenshot', 'id_status'];

    public function getLaporan() {
        $laporan = $this
        // ->db
        ->table('laporan')
        ->join('sarana', 'laporan.id_sarana = sarana.id_sarana')
        ->join('cs', 'laporan.id_cs = cs.id_cs')
        ->join('status', 'laporan.id_status = status.id_status')
        ->paginate(10);
        // ->get()
        // ->getResultArray();
        
        return $laporan;
    }

    public function get_cs() {
        return $this->db->table('cs')->get()->getResultArray(); 
    }

    public function get_sarana() {
        return $this->db->table('sarana')->get()->getResultArray(); 
    }

    public function get_status() {
        return $this->db->table('status')->get()->getResultArray(); 
    }
}