<?php
namespace App\Modules\Laporan\Controllers;
use App\Modules\Laporan\Models\ModelLaporan;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;

class LaporanSpreadsheet extends BaseController {
    protected $ModelLaporan;
    public function __construct() {
        $this->ModelLaporan = new ModelLaporan();
    }
    function index() {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'LAPORAN ADUAN INTERNET');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
        $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()
        ->setCellValue('A3', 'NO')
        ->setCellValue('B3', 'ID Laporan')
        ->setCellValue('C3', 'Sarana')
        ->setCellValue('D3', 'Nama CS')
        ->setCellValue('E3', 'Nama Pelapor')
        ->setCellValue('F3', 'Tanggal')
        ->setCellValue('G3', 'Detail Aduan')
        ->setCellValue('H3', 'No HP/Email')
        ->setCellValue('I3', 'Screenshot')
        ->setCellValue('J3', 'Status Laporan');
        $spreadsheet->getActiveSheet()->getStyle('A1:I3')->getFont()->setBold(true);
        $laporan = $this->ModelLaporan->getLaporan();
        $i = 1;
        $rowID = 4;
        foreach ($laporan as $item) {
            $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $rowID, $i++)
            ->setCellValue('B' . $rowID, $item['id_laporan'])
            ->setCellValue('C' . $rowID, $item['nama_sarana'])
            ->setCellValue('D' . $rowID, $item['nama_cs'])
            ->setCellValue('E' . $rowID, $item['nama'])
            ->setCellValue('F' . $rowID, $item['tanggal'])
            ->setCellValue('G' . $rowID, $item['detail'])
            ->setCellValue('H' . $rowID, $item['hp_email'])
            ->setCellValue('J' . $rowID, $item['status_laporan']);
            $foto = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $foto->setPath('uploads/' . $item['screenshot']);
            $foto->setCoordinates('I' . $rowID);
            $foto->setOffsetX(0);
            $foto->setOffsetY(0);
            $foto->setWidth(70);
            $foto->setHeight(70);
            $foto->setWorksheet($spreadsheet->getActiveSheet());
            $spreadsheet->getActiveSheet()->getRowDimension($rowID)->setRowHeight(50);
            $rowID++;
        }
        foreach (range('A', 'J') as $ColumnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($ColumnID)->setAutoSize(true);
        }
        $border = array(
                'allBorder' => array (
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
        );
        $spreadsheet->getActiveSheet()->getStyle('A3' . ':J' . ($rowID - 1))->getBorders()->applyFromArray($border);
        $alignmet = array (
                'alignment' => array (
                'vertical' =>\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            )
        );
        $spreadsheet->getActiveSheet()->getStyle('A3' . ':J' . ($rowID - 1))->applyFromArray($alignmet);
        $filename = 'Laporan - Excel.xlsx';
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadseetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename .'"');
        header('Cahce-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit;
    }
}