<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/(:any)'] = 'Auth/get_page/$1';
$route['do_login/(:any)'] = 'Auth/login/$1';
$route['daftar'] = 'Auth/daftar';
$route['do_register'] = 'Auth/do_register';


//----------------------------------------------------//
//                     MASTER DATA                    //
//----------------------------------------------------//
##Informasi
$route['master_data/informasi'] = 'Dashboard/informasi';
$route['insert_info']			= 'Dashboard/insert_info';
$route['insert_syarat']			= 'Dashboard/insert_syarat';

## Angkatan
$route['master_data/angkatan']   = 'Angkatan';
$route['insert_angkatan']		 = 'Angkatan/add';
$route['update_angkatan']		 = 'Angkatan/update';
$route['delete_angkatan/(:any)'] = 'Angkatan/delete/$1';

## Kelas
$route['master_data/angkatan/kelas/(:any)'] = 'Angkatan/kelas/$1';
$route['insert_kelas/(:any)']		 	 	= 'Angkatan/add_kelas/$1';
$route['update_kelas/(:any)']		 		= 'Angkatan/update_kelas/$1';
$route['delete_kelas/(:any)/(:any)'] 		= 'Angkatan/delete_kelas/$1/$2';
$route['get_kelas']							= 'Auth/get_kelas';

## Jurusan
$route['master_data/jurusan']     = 'Jurusan';
$route['insert_jurusan']	   	  = 'Jurusan/add';
$route['update_jurusan']	   	  = 'Jurusan/update';
$route['delete_jurusan/(:any)']   = 'Jurusan/delete/$1';

## Fakultas
$route['master_data/fakultas']   = 'Fakultas';
$route['master_data/fakultas/detail/(:any)'] = 'Fakultas/detail/$1';
$route['insert_fakultas']		 = 'Fakultas/add';
$route['update_fakultas']		 = 'Fakultas/update';
$route['delete_fakultas/(:any)'] = 'Fakultas/delete/$1';
$route['insert_fakultas_jurusan'] = 'Fakultas/add_jurusan';
$route['delete_fakultas_jurusan/(:any)/(:any)'] = 'Fakultas/delete_jurusan/$1/$2';

## Dosen
$route['master_data/dosen']     = 'Dosen';
$route['insert_dosen']		    = 'Dosen/add';
$route['update_dosen']		    = 'Dosen/update';
$route['delete_dosen/(:any)']   = 'Dosen/delete/$1';

## Mahasiswa
$route['master_data/mahasiswa']         = 'Mahasiswa';
$route['master_data/mahasiswa/detail/(:any)']  = 'Mahasiswa/detail/$1';
$route['insert_mahasiswa']		    = 'Mahasiswa/add';
$route['update_mahasiswa']		    = 'Mahasiswa/update';
$route['delete_mahasiswa/(:any)']   = 'Mahasiswa/delete/$1';

//----------------------------------------------------//
//                      TRANSAKSI                     //
//----------------------------------------------------//

## Superadmin
$route['skpa/list']     	 = 'Skpa/list';
$route['insert_skpa']		 = 'Skpa/add';
$route['get_file/(:any)']	 = 'Export/kelulusan/$1';
$route['skpa/detail/(:any)'] = 'Skpa/detail/$1';
$route['skpa/detail/(:any)/progress/(:any)'] = 'Skpa/progress/$1/$2';
$route['set_seminar/(:any)/(:any)']	= 'Skpa/set_seminar/$1/$2';

$route['insert_gelombang/(:any)'] = 'Skpa/add_gelombang/$1';
$route['update_gelombang/(:any)'] = 'Skpa/update_gelombang/$1';
$route['set_gelombang/(:any)/(:any)/(:any)'] = 'Skpa/set_gelombang/$1/$2/$3';
$route['set_notif/(:any)/(:any)/(:any)'] = 'Skpa/set_notif/$1/$2/$3';

$route['insert_partisipan/(:any)'] = 'Skpa/add_partisipan/$1';
$route['update_partisipan/(:any)'] = 'Skpa/update_partisipan/$1';
$route['insert_partisipan'] = 'Partisipan/add_partisipan';

## Mahasiswa
$route['skpa/daftar'] = 'Partisipan/index';
$route['insert_judul/(:any)'] = 'Partisipan/insert_judul/$1';
$route['edit_judul/(:any)']   = 'Partisipan/edit_judul/$1';
$route['upload_berkas_seminar/(:any)'] = 'Partisipan/upload_berkas_seminar/$1';
$route['upload_revisi_seminar/(:any)'] = 'Partisipan/upload_revisi_seminar/$1';
$route['skpa/daftar/change']  = 'Partisipan/change';

$route['skpa/komite_status']  = 'Skpa/komite_status';

$route['skpa/seminar'] = 'Partisipan/seminar';
$route['skpa/penerbitan'] = 'Partisipan/penerbitan';

## Admin
$route['skpa/request'] 			     = 'Partisipan/request';
$route['skpa/request/detail/(:any)'] = 'Partisipan/request_detail/$1';
$route['insert_comment/(:any)'] 	 = 'Partisipan/insert_comment/$1';
$route['set_approval/(:any)/(:any)'] = 'Partisipan/set_approval/$1/$2';

$route['skpa/komite'] 			     = 'Skpa/komite';
$route['set_approval_komite/(:any)/(:any)'] = 'Skpa/komite_approval/$1/$2';

$route['skpa/berkas_seminar'] = 'Skpa/berkas_seminar';
$route['set_approval_berkas_seminar/(:any)/(:any)'] = 'Skpa/berkas_seminar_approval/$1/$2';

$route['skpa/confirmation'] 			     	  = 'Skpa/confirmation';
$route['set_approval_confirmation/(:any)/(:any)'] = 'Skpa/confirmation_approval/$1/$2';

$route['skpa/revisi'] 			     	    = 'Skpa/revisi';
$route['set_approval_revisi/(:any)/(:any)'] = 'Skpa/revisi_approval/$1/$2';

$route['skpa/recommendation']	= 'Skpa/recommendation';
$route['insert_rekomendasi']	= 'Skpa/insert_recommendation';
$route['delete_rekomendasi/(:any)']	= 'Skpa/delete_recommendation/$1';
$route['change_rekomendasi/(:any)']	= 'Skpa/change_status_recommendation/$1';
$route['update_rekomendasi']	= 'Skpa/update_recommendation';

$route['rekomendasi_judul']	= 'Partisipan/rekomendasi_judul';

//----------------------------------------------------//
//                      LAPORAN                       //
//----------------------------------------------------//

$route['laporan/jurnal']   = 'Laporan/jurnal';
$route['laporan/neraca_saldo'] = 'Laporan/neraca_saldo';
