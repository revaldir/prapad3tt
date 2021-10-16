 <div class="container-fluid">
 	<div class="row page-title">
 		<div class="col-md-12">
 			<nav aria-label="breadcrumb" class="float-right mt-1">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Seminar PA
 					<li>
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
 						<h5 class="header-title mb-1 mt-0">Informasi Seminar</h5>
 						<p class="sub-header"></p>

 						<div class="row">
 							<div class="col-md-12">
 								<?php echo $this->session->flashdata('alert_message') ?>
 							</div>
 						</div>

 						<?php if ($skpa['notif_to_seminar'] == '1') {
								if (isset($last_judul) && $last_judul['is_acc_2'] == '1') {
									if ($last_judul['is_acc_2_1'] == '1') {
							?>

 									<div class="row">
 										<div class="col-md-12 text-center">
 											<b>JUDUL PA</b> <br> <?= $last_judul['nama_judul'] ?>
 											<hr>
 										</div>

 										<div class="col-md-12">
 											<div class="card">
 												<div class="card-header">
 													DETAIL
 												</div>
 												<div class="card-body">
 													<table class="table">
 														<tr>
 															<th>SKPA</th>
 															<td><?= $gelombang['kode_skpa'] . " / Tahun " . $gelombang['tahun'] ?></td>
 														</tr>

 														<tr>
 															<th>GELOMBANG</th>
 															<td>Gel. <?= $gelombang['gelombang'] ?></td>
 														</tr>

 														<tr>
 															<th>JADWAL SEMINAR</th>
 															<td><?= indonesian_date($gelombang['tanggal_seminar']) . " " . date('H:i', strtotime($gelombang['jam_seminar'])) ?></td>
 														</tr>

 														<tr>
 															<th>RUANGAN</th>
 															<td><?= $gelombang['ruangan'] ?></td>
 														</tr>

 														<tr>
 															<th>PENGUJI</th>
 															<td><?= $gelombang['kode_penguji'] . " - " . $gelombang['nama_penguji'] ?></td>
 														</tr>

 														<tr>
 															<td colspan="2">
 																<div class="alert alert-danger">
 																	<b><i class="fa fa-warning"></i> INFORMASI TAMBAHAN</b><br><br>
 																	<ol>
 																		<li>
 																			Harap persiapkan berkas berikut saat mengikuti seminar proposal :
 																			<ul>
 																				<li>Form berita acara seminar</li>
 																				<li>Form penilaian seminar</li>
 																				<li>Form revisi seminar</li>
 																			</ul>
 																		</li>

 																		<li>
 																			Mahasiswa juga harus menyerahkan buku proposal yang telah ditandatangani pembimbing kepada dosen seminar sebelum pelaksanaan seminar proposal.
 																		</li>

 																		<li>
 																			Mahasiswa yang dinyatakan tidak lulus Seminar proposal Proyek Akhir mengajukan Seminar kembali pada periode selanjutnya.
 																		</li>
 																	</ol>

 																</div>
 															</td>
 														</tr>
 													</table>
 												</div>
 											</div>
 										</div>
 									</div>

 							<?php     } else {

										echo "<center><h5 class='text-success'><i class='fa fa-check'></i> ANDA DAPAT MENGIKUTI SEMINAR PROPOSAL</h5>
                                    Harap upload berkas seminar.</h5></center>";

										$ketentuan = '
  <ol>
    <li> Mahasiswa mengajukan pendaftaran seminar proposal PA dengan mengupload (dalam 1 file*.pdf). file yang diupload adalah : <br>
      <ul>
        <li>Proposal yang telah di tandatangani pembimbing</li>
        <li>Form bimbingan pra seminar yang telah ditandatangani pbb 1 dan pbb 2</li>
      </ul>
    </li>

    <li>Mahasiswa yang tidak melaksanakan Seminar PA pada periode seminar PA yang berlaku (dengan alasan apapun) maka dianggap tidak siap dengan judul PA yang diajukan dan harus mengganti judul PA.
    </li>

    <li>Setelah syarat-syarat pendaftaran seminar dipenuhi, mahasiswa melaksanakan seminar Proyek Akhir yang dijadwalkan oleh Koordinator PA dengan dihadiri oleh dosen seminar dan salah satu dosen pembimbing. Jadwal seminar Proposal PA bisa dilihat pada bagian Informasi dan Pemberitahuan.</li>';

										$alertKetentuan = "<div class='alert alert-danger'><b><i class='fa fa-warning'></i> Syarat dan Ketentuan</b> <br> " . $ketentuan . "</div>";

										if ($last_judul['is_acc_2_1'] == '-1') {
											if ($last_judul['is_berkas_seminar_upload'] == '0') {
												echo "<center><br><button data-toggle='modal' data-target='#modalBerkasSeminar' class='btn btn-warning'>UPLOAD BERKAS SEMINAR</button></center>";
											} else {
												echo "<center><span class='badge badge-success'><i class='fa fa-check-circle'></i> Berkas sudah diupload</span></center>";
												echo "<center><h6><i class='fa fa-clock-o'></i> Menunggu konfirmasi berkas seminar</h6></center>";
											}

											echo "<hr>" . $alertKetentuan;
										} else if ($last_judul['is_acc_2_1'] == '0') {
											echo "<center><span class='badge badge-danger'><i class='fa fa-ban'></i> Berkas ditolak</span>";
											echo "<hr>Keterangan : <br> " . $last_judul['ket_tolak'] . "</center>";
											echo "<hr><center><br><button data-toggle='modal' data-target='#modalBerkasSeminar' class='btn btn-warning'>UPLOAD ULANG</button></center>";

											echo "<hr>" . $alertKetentuan;
										}
									}
								} else {
									if (isset($last_judul) && $last_judul['is_acc_1'] == '-1') {
										echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> BERKAS PROPOSAL BELUM DIKONFIRMASI</h5>
                                    Harap menunggu status persetujuan proposal</h5></center>";
									} else {
										if (isset($last_judul) && $last_judul['is_acc_2'] == '-1') {
											echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> Berkas belum dikonfirmasi</h5>
                                  Harap hubungi dosen koordinator Anda untuk melakukan konfirmasi berkas proposal</h5></center>";
										} else {
											echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> Anda tidak dapat mengiktui seminar proposal</h5>
                                    Pengajuan judul Anda tidak lolos, silahkan coba gelombang berikutnya</h5></center>";
										}
									}
								}
								?>

 						<?php } else {

								echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> STATUS INFO SEMINAR PROPOSAL BELUM DIBERITAHU</h5></center>";
							} ?>


 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>

 <?php if (isset($last_judul)) : ?>
 	<form action="<?php echo site_url('upload_berkas_seminar/' . $last_judul['pengajuan_judul_id']) ?>" method="post" enctype="multipart/form-data">
 		<div class="modal fade" id="modalBerkasSeminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 			<div class="modal-dialog">
 				<div class="modal-content">
 					<div class="modal-header">
 						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> UPLOAD BERKAS SEMINAR
 							<button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
 					</div>

 					<div class="modal-body">
 						<div class="row">

 							<?php if ($gelombang['pembimbing_2_id'] == '') { ?>
 								<div class="col-md-12">
 									<label>Pembimbing 2</label>
 									<select class="form-control" name="pembimbing_2_id" required="">
 										<option value="">Harap pilih pembimbing 2</option>
 										<?php foreach ($dosen as $row) {
												if ($gelombang['pembimbing_1_id'] != $row['id']) { ?>
 												<option value="<?= $row['id'] ?>"><?= $row['kode_dosen'] . " - " . $row['nama_dosen'] ?></option>
 										<?php  }
											} ?>
 									</select>
 									<br>
 								</div>
 							<?php } ?>

 							<div class="col-md-12">
 								<label>Berkas</label><br>
 								<input type="file" name="file_seminar" class="btn btn-light" required="">
 							</div>

 						</div>
 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
 						<button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i> Upload</button>
 					</div>

 				</div>
 			</div>
 		</div>
 	</form>
 <?php endif; ?>
