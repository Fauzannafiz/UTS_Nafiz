<?php
namespace App\Modules\Laporan\Controllers;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use App\Modules\Laporan\Models\ModelLaporan;
use App\Controllers\BaseController;

class LaporanWord extends BaseController
{
    protected $ModelLaporan;
    public function __construct() {
        $this->ModelLaporan = new ModelLaporan();
    }
    function index() {
        $word = new PhpWord();
        $sect = $word->addSection();
        $title = array('size' => 16, 'bold' => true);
        $sect->addText("LAPORAN ADUAN INTERNET", $title);
        $sect->addTextBreak(1);
        $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 20);
        $styleCell = array('valign' => 'center');
        $fontHeader = array('bold' => true);
        $noSpace = array('spaceAfter' => 0);
        $imgStyle = array('width' => 50, 'height' => 50);
        $word->addTableStyle('mytable', $styleTable);
        $table = $sect->addTable('mytable');
        $table->addRow();
        $table->addCell(500, $styleCell)->addText('NO', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('ID Laporan', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Sarana', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Nama CS', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Nama Pelapor', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Tanggal', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Detail Aduan', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('No HP/Email', $fontHeader, $noSpace);
        $table->addCell(3000, $styleCell)->addText('Screenshot', $fontHeader, $noSpace);
        $table->addCell(2000, $styleCell)->addText('Status Laporan', $fontHeader, $noSpace);
        $laporan = $this->ModelLaporan->getLaporan();
        $i = 1;
        foreach ($laporan as $item) {
            $table->addRow();
            $table->addCell(500, $styleCell)->addText($i++, array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['id_laporan'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['nama_sarana'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['nama_cs'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['nama'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['tanggal'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['detail'], array(), $noSpace);
            $table->addCell(2000, $styleCell)->addText($item['hp_email'], array(), $noSpace);
            $table->addCell(3000, $styleCell)->addImage('uploads/' . $item['screenshot'], $imgStyle);
            $table->addCell(2000, $styleCell)->addText($item['status_laporan'], array(), $noSpace);
        }
        $filename = "Laporan - Word.docx";
        header('Content-Type: application/msword');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $objWriter = IOFactory::createWriter($word, 'Word2007');
        $objWriter->save('php://output');
        exit;
    }
}