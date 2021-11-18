<?php
namespace App\Modules\Laporan\Controllers;
use App\Modules\Laporan\Models\ModelLaporan;
use App\Controllers\BaseController;

class Laporan extends BaseController
{
  public function index() {
    $laporan = new ModelLaporan();
    $data['laporan'] = $laporan->getLaporan();
    // $data['pager'] = $laporan->pager;
    $home = 'App\Modules\Laporan\Views\home';
    return view($home, $data);
  }

  public function tambah() {
    session();
    
    $data = [
      'validation' => \Config\Services::validation()
    ];
    $tambah = 'App\Modules\Laporan\Views\tambah_laporan';
    return view($tambah, $data);
  }

  public function ubah($id_laporan) {
    $laporan = new ModelLaporan();
    $data['laporan'] = $laporan->find($id_laporan);
    if (!$data['laporan']) return redirect()->to('/Laporan');
    $edit = 'App\Modules\Laporan\Views\edit_laporan';
    return view($edit, $data);
  }

  public function edit($id_laporan) {
    $laporan = new ModelLaporan();
    $lap = $laporan->find($id_laporan);
    $ss = $this->request->getFile('screenshot');
    $fileSS = $ss->getName();
    $ss->move('uploads', $fileSS);
    if (!$lap) return redirect()->to('/Laporan');

    $laporan->update($id_laporan, [
      'id_sarana' => $this->request->getVar('id_sarana'),
      'id_cs' => $this->request->getVar('id_cs'),
      'nama' => $this->request->getVar('nama'),
      'tanggal' => $this->request->getVar('tanggal'),
      'detail' => $this->request->getVar('detail'),
      'hp_email' => $this->request->getPost('hp_email'),
      'screenshot' => $fileSS,
      'id_status' => $this->request->getVar('id_status')
    ]);

    return redirect()->to('/Laporan');
  }

  public function create() {  
    // Validasi
    if(!$this->validate([
      'id_sarana' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'Sarana Laporan Tidak Boleh Kosong'
        ]
      ],

      'id_cs' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'CS Penerima Laporan Tidak Boleh Kosong'
        ]
      ],

      'nama' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'Nama Pelapor Tidak Boleh Kosong'
        ]
      ],

      'tanggal' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'Tanggal Laporan Tidak Boleh Kosong'
        ]
      ],

      'detail' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'Detail Laporan Tidak Boleh Kosong'
        ]
      ],

      'screenshot' => [
        'rules' => [
          'mime_in[screenshot,image/png,image/jpg,application/pdf,application/msword]',
          'max_size[screenshot,5096]',
        ],
        'errors' => [
          'mime_in' => 'Hanya Menerima File PNG, JPG, Docx, dan PDF',
          'max_size' => 'Ukuran File Tidak Boleh Melebihi 5MB'
        ]
      ],
      
      'id_status' => [
        'rules' => [
          'required'
        ],
        'errors' => [
          'required' => 'Status Laporan Tidak Boleh Kosong'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/Laporan/tambah')->withInput();
    }
    $laporan = new ModelLaporan();
    $ss = $this->request->getFile('screenshot');
    $fileSS = $ss->getName();
    $ss->move('uploads', $fileSS);
    $laporan->save([
      'id_sarana' => $this->request->getPost('id_sarana'),
      'id_cs' => $this->request->getPost('id_cs'),
      'nama' => $this->request->getPost('nama'),
      'tanggal' => $this->request->getPost('tanggal'),
      'detail' => $this->request->getPost('detail'),
      'hp_email' => $this->request->getPost('hp_email'),
      'screenshot' => $fileSS,
      'id_status' => $this->request->getPost('id_status')
    ]);

    return redirect()->to('/Laporan');
  }

  public function delete($id_laporan) {
    $laporan = new ModelLaporan();
    $laporan->delete($id_laporan);
    return redirect()->to('/Laporan');
  }
}