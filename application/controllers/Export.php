<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./lib/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function kelulusan($skpa_gelombang_id){
		$this->db->where('skpa_gelombang.id', $skpa_gelombang_id)
				 ->join('skpa', 'skpa.id = skpa_gelombang.skpa_id');

		$skpa = $this->db->get('skpa_gelombang')->row_array();

		$mhs  = $this->db->select('*, skpa_gelombang_daftar.id AS skpa_gelombang_daftar_id,
                         dosen1.kode_dosen AS kode_dosen1, dosen1.nama_dosen AS nama_dosen1,
                         dosen2.kode_dosen AS kode_dosen2, dosen2.nama_dosen AS nama_dosen2,
                         penguji.kode_dosen AS kode_penguji, penguji.nama_dosen AS nama_penguji')
               ->join('skpa_gelombang_daftar', 'skpa_gelombang_daftar.skpa_gelombang_id = skpa_gelombang.id')
               ->join('pengajuan_judul', 'pengajuan_judul.skpa_gelombang_daftar_id = skpa_gelombang_daftar.id')
               ->join('mahasiswa', 'mahasiswa.id = skpa_gelombang_daftar.mahasiswa_id')
               ->join('dosen dosen1', 'dosen1.id = skpa_gelombang_daftar.pembimbing_1_id')
               ->join('dosen dosen2', 'dosen2.id = skpa_gelombang_daftar.pembimbing_2_id', 'LEFT')
               ->join('dosen penguji', 'penguji.id = skpa_gelombang_daftar.penguji_id', 'LEFT')
               ->order_by('mahasiswa.nama_mahasiswa', 'ASC')
               ->where('is_acc_3','1')
               ->group_start()
               		->where('is_revisi','0')
               		->or_where('is_revisi','-1')
               ->group_end()
               ->get('skpa_gelombang')->result_array();

		$spreadsheet = new Spreadsheet();
		$title = 'Daftar Kelulusan Penerbitan SKPA '.$skpa['kode_skpa']." ".$skpa['tahun']." Gelombang ".$skpa['gelombang'];

		$spreadsheet->getProperties()->setCreator('App - S2020')
					->setTitle($title)
					->setSubject('Daftar Mahasiswa yang lulus penerbitan SK PA');

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'NIM')
					->setCellValue('C1', 'NAMA MAHASISWA')
					->setCellValue('D1', 'JUDUL PA')
					->setCellValue('E1', 'PEMBIMBING 1')
					->setCellValue('F1', 'PEMBIMBING 2')
					->setCellValue('G1', 'PENGUJI');

		$i = 2; $n = 0;
		foreach($mhs as $row) { $n++; 
			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A'.$i, $n)
						->setCellValue('B'.$i, $row['nim'])
						->setCellValue('C'.$i, $row['nama_mahasiswa'])
						->setCellValue('D'.$i, $row['nama_judul'])
						->setCellValue('E'.$i, $row['kode_dosen1']." - ".$row['nama_dosen1'])
						->setCellValue('F'.$i, $row['kode_dosen2']." - ".$row['nama_dosen2'])
						->setCellValue('G'.$i, $row['kode_penguji']." - ".$row['nama_penguji']);
			$i++;
		}

		$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}
}