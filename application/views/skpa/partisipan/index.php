 <div class="container-fluid">
 	<div class="row page-title">
 		<div class="col-md-12">
 			<nav aria-label="breadcrumb" class="float-right mt-1">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Pengajuan Judul</li>
 				</ol>
 			</nav>
 		</div>
 	</div>

 	<!-- alerts -->
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="card">
 				<div class="card-body">
 					<div>
 						<h5 class="header-title mb-1 mt-0">Pengajuan Judul</h5>
 						<p class="sub-header"></p>

 						<div class="row">
 							<div class="col-md-12">
 								<?php echo $this->session->flashdata('alert_message') ?>
 							</div>
 						</div>

 						<?php

							if (!empty($skpa)) {
								if (!is_null($gelombang)) {


							?>

 								<?php

									$dosen2 = '-';
									if ($gelombang['nama_dosen2'] != '') {
										$dosen2 = $gelombang['nama_dosen2'] . "<br><small>" . $gelombang['kode_dosen2'] . "</small>";
									}

									?>

 								<div class="row">
 									<div class="col-md-9">
 										<div class="card">
 											<div class="card-header">
 												<h6>Dosen</h6>
 											</div>
 											<div class="card-body">
 												<table class="table">
 													<tr>
 														<th>Pembimbing 1</th>
 														<th>Pembimbing 2</th>
 													</tr>

 													<tr>
 														<td><?= $gelombang['nama_dosen1'] . " <br><small>" . $gelombang['kode_dosen1'] . "</small>" ?></td>
 														<td><?= $dosen2 ?></td>
 													</tr>
 												</table>
 											</div>
 										</div>
 									</div>

 									<div class="col-md-3">
 										<div class="card">
 											<div class="card-header">
 												<h6>Periode</h6>
 											</div>
 											<div class="card-body">
 												<table class="table">
 													<tr>
 														<th class="text-center">Tahun Ajaran <?= $skpa['tahun'] ?> Gelombang - <?= $skpa['gelombang'] ?></th>
 													</tr>

 													<tr>
 														<td class="text-center"><?= indonesian_date($skpa['start']) . " <br>s/d<br> " . indonesian_date($skpa['end']) ?></td>
 													</tr>
 												</table>
 											</div>
 										</div>
 									</div>

 								</div>

 								<?php

									$status = true;

									foreach ($judul as $row) {

										if ($row['is_acc_1'] == '0') {
											$status = false;
										}
									} ?>

 								<?php if (!$status) { ?>
 									<div class="row">
 										<div class="col-md-12">
 											<div class="alert alert-danger">
 												<div class="row">
 													<div class="col-md-9"><i class="fa fa-ban"></i><b> Berkas Ditolak : </b> <?= $row['ket_tolak'] ?></div>
 													<div class="col-md-3 text-right"><a class='btn btn-outline-light text-right' href='javascript:void(0)' data-toggle="modal" data-target="#modalUpload"><b>UPLOAD ULANG</b></a></div>
 												</div>
 											</div>
 										</div>
 									</div>
 								<?php } ?>

 								<div class="row">
 									<div class="col-md-12">
 										<div class="card">
 											<div class="card-header">
 												<h6>Pengajuan Judul</h6>
 											</div>
 											<div class="card-body">

 												<?php if (empty($judul)) { ?>

 													<form enctype="multipart/form-data" method="POST" action="<?= site_url('insert_judul/' . $gelombang['skpa_gelombang_daftar_id']) ?>">
 														<div class="row">
 															<div class="form-group col-md-6">
 																<label>Judul PA</label>
 																<input autocomplete="off" type="text" class="form-control" name="nama_judul" required="" placeholder="Nama Judul PA...">
 															</div>

 															<div class="form-group col-md-3">
 																<label>Berkas File</label>
 																<input type="file" class="btn btn-light" name="file_judul" required="">
 															</div>

 															<div class="form-group col-md-3 text-center">
 																<Br>
 																<button style="margin-top:7px" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
 															</div>
 														</div>
 													</form>

 												<?php } ?>

 												<div class="table-responsive">
 													<table class="display table">
 														<thead style="background-color: #eee">
 															<tr>
 																<th>Judul</th>
 																<th style="width: 13%" class="text-center">File</th>
 																<th style="width: 17%">Waktu Upload</th>
 																<th class="text-center" style="width: 20%">Status ACC Kordinator</th>
 															</tr>
 														</thead>
 														<tbody>
 															<?php $n = 0;
																if (empty($judul)) {
																	echo "<tr><td colspan='6' class='text-center text-danger'><h5><i class='fa fa-ban'></i> Judul PA Belum Diajukan</h5></td></tr>";
																} else {

																	foreach ($judul as $row) {
																		$n++; ?>

 																	<tr>
 																		<td><?= $row['nama_judul'] ?></td>
 																		<td class="text-center"><a href="<?= base_url('assets/file/' . $row['file_judul']) ?>" class=""><i class="fa fa-download"></i> Download</a></td>

 																		<td><?= $row['waktu_upload'] ?></td>

 																		<td class="text-center">
 																			<?= show_acc($row['is_acc_1']) ?><br>
 																			<small><?= $row['waktu_acc_1'] ?></small>
 																		</td>


 																	</tr>

 															<?php }
																} ?>

 														</tbody>
 													</table>
 												</div>

 												<hr>

 												<div class="alert alert-info">
 													<b>Ketentuan : </b> <br>
 													Mahasiswa yang mengajukan topik PA ke komite PA harus mengisikan data dan mengupload (dalam 1 file .* pdf). Berkas yang diperlukan :
 													<ol>
 														<li>Pra Proposal</li>
 														<li>Form Kesediaan Membimbing yang telah ditanda tangani</li>
 														<li>Print Kartu Hasil Studi ( KHS )</li>
 													</ol>
 												</div>

 											</div>
 										</div>
 									</div>
 								</div>

 								<?php
								} else {
									$tanggal_end = $skpa['tanggal_judul_end'];
									$currentdate = date('Y-m-d');

									if ((strtotime($currentdate)) <= (strtotime($tanggal_end))) {
									?>
 									<center>
 										<h5 class="text-danger"><i class="fa fa-warning"></i> Anda belum terdaftar pada gelombang ini.</h5>
 										<p>Silahkan memilih dosen pembimbing untuk melakukan pendaftaran pada gelombang saat ini.</p>
 									</center>

 									<hr>

 									<form method="POST" action="<?= site_url('insert_partisipan') ?>">
 										<input type="hidden" name="skpa_gelombang_id" value="<?= $skpa['skpa_gelombang_id'] ?>">

 										<div class="row">

 											<div class="form-group col-md-5">
 												<label>Pembimbing 1</label>
 												<select class="form-control" required="" id="pbb1" name="pembimbing_1_id">
 													<option value="">Pilih</option>
 													<?php foreach ($dosen as $row) { ?>
 														<option value="<?= $row['id'] ?>"><?= $row['kode_dosen'] . " / " . $row['nama_dosen'] ?></option>
 													<?php } ?>
 												</select>
 											</div>

 											<div class="form-group col-md-5">
 												<label>Pembimbing 2</label>
 												<select class="form-control" disabled="" id="pbb2" name="pembimbing_2_id">
 													<option value="">Harap Pilih Pembimbing 1</option>
 													<?php foreach ($dosen as $row) { ?>
 														<option value="<?= $row['id'] ?>"><?= $row['kode_dosen'] . " / " . $row['nama_dosen'] ?></option>
 													<?php } ?>
 												</select>
 											</div>

 											<div class="col-md-2">
 												<br>
 												<button style="margin-top: 7px" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
 											</div>
 										</div>
 									</form>
 								<?php
									} else { ?>
 									<h5 class="text-danger"><i class="fa fa-warning"></i> Pendaftaran gelombang aktif telah selesai, silahkan mendaftar pada gelombang selanjutnya</h5>
 							<?php
									}
								}
							} else { ?>
 							<center>
 								<h5 class="text-danger"><i class="fa fa-warning"></i> Gelombang Pendaftaran SK PA Belum Dibuka</h5>
 							</center>
 						<?php } ?>



 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>


 <?php if (isset($gelombang)) : ?>
 	<form action="<?php echo site_url('edit_judul/' . $gelombang['skpa_gelombang_daftar_id']) ?>" method="post" enctype="multipart/form-data">
 		<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 			<div class="modal-dialog modal-lg">
 				<div class="modal-content">
 					<div class="modal-header bg-primary">
 						<h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Upload Ulang Berkas</h4>
 						<button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
 					</div>

 					<div class="modal-body">
 						<div class="row">
 							<div class="form-group col-md-3">
 								<label>Berkas File</label>
 								<input type="file" class="btn btn-light" name="file_judul" required="">
 							</div>
 						</div>
 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
 						<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Upload</button>
 					</div>

 				</div>
 			</div>
 		</div>
 	</form>
 <?php endif; ?>

 <script type="text/javascript">
 	$(document).on('change', '#pbb1', function() {
 		if ($(this).val() != '') {
 			reset();

 		} else {
 			$('#pbb2').attr('disabled', 'disabled')
 			$('#pbb2 option').removeAttr('selected');
 			$('#pbb2 option[value=""]').attr('selected', 'selected').text('Harap Pilih Pembimbing 1');
 		}
 	});

 	$(document).on('change', '#pbb2', function() {
 		var pbb1 = $('#pbb1').val();
 		if ($(this).val() != pbb1) {

 		} else {
 			alert('Pembimbing 2 tidak boleh sama dengan pembimbing 1');
 			reset();
 		}
 	});

 	function reset() {
 		$('#pbb2').removeAttr('disabled', 'disabled');
 		$('#pbb2 option').removeAttr('selected');
 		$('#pbb2 option[value=""]').attr('selected', 'selected').text('Tidak Ada');
 	}
 </script>
