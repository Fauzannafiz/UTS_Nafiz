<?php
namespace App\Modules\Laporan\Controllers;

use App\Controllers\BaseController;
use App\Modules\Laporan\Models\ModelLaporan;
use FPDF;
class LaporanFpdf extends BaseController
{
    protected $ModelLaporan;
    public function __construct()
    {
        $this->ModelLaporan = new ModelLaporan();
    }
    function index()
    {
        error_reporting(0);
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage('l', 'legal');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(100, 7, 'LAPORAN ADUAN INTERNET ', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO ', 1, 0);
        $pdf->Cell(25, 6, 'ID Laporan ', 1, 0);
        $pdf->Cell(20, 6, 'Sarana ', 1, 0);
        $pdf->Cell(20, 6, 'Nama CS ', 1, 0);
        $pdf->Cell(45, 6, 'Nama Pelapor ', 1, 0);
        $pdf->Cell(35, 6, 'Tanggal', 1, 0);
        $pdf->Cell(80, 6, 'Detail Aduan ', 1, 0);
        $pdf->Cell(45, 6, 'No HP/Email ', 1, 0);
        // $pdf->Cell(45, 6, 'Screenshot ', 1, 0);
        $pdf->Cell(45, 6, 'Status Laporan ', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $i = 1;
        $laporan = $this->ModelLaporan->getLaporan();
        foreach ($laporan as $item) {
            $pdf->Cell(10, 20, $i++, 1, 0);
            // $img = base_url('uploads/' . $item['screenshot']);
            $pdf->Cell(25, 20, $item['id_laporan'], 1, 0);
            $pdf->Cell(20, 20, $item['nama_sarana'], 1, 0);
            $pdf->Cell(20, 20, $item['nama_cs'], 1, 0);
            $pdf->Cell(45, 20, $item['nama'], 1, 0);
            $pdf->Cell(35, 20, $item['tanggal'], 1, 0);
            $pdf->Cell(80, 20, $item['detail'], 1, 0);
            $pdf->Cell(45, 20, $item['hp_email'], 1, 0);
            // $pdf->Cell(25, 20, $pdf->Image($img, $pdf->GetX(), $pdf->GetY(), 15), 1, 0);
            $pdf->Cell(45, 20, $item['status_laporan'], 1, 1);
            
        }
        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('D', 'Laporan - PDF.pdf');
    }
}
