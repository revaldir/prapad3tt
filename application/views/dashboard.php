 <div class="container-fluid">
 	<div class="row page-title">
 		<div class="col-md-12">
 			<nav aria-label="breadcrumb" class="float-right mt-1">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 					<li class="breadcrumb-item active" aria-current="page"><?= $this->session->userdata('user_data')['posisi'] ?></li>
 				</ol>
 			</nav>
 		</div>
 	</div>

 	<?php $profile = $this->session->userdata('user_data'); ?>

 	<!-- alerts -->
 	<div class="row">
 		<div class="col-xl-12">
 			<div class="card">
 				<div class="card-body">
 					<div>
 						<h5 class="header-title mb-1 mt-0">Dashboard</h5>
 						<p class="sub-header"></p>

 						<div class="row">
 							<div class="col-md-12">
 								<?php echo $this->session->flashdata('alert_message') ?>
 							</div>
 						</div>

 						<?php if ($profile['posisi'] == 'Mahasiswa') { ?>
 							<div class="row">
 								<div class="col-md-12">
 									<?php
										$notif_r = $notif_t = '';

										if (isset($last_judul) && $last_judul['is_acc_3'] == '1') {
											if ($last_judul['is_revisi'] == '0' || $last_judul['is_revisi'] == '-1') {
												$notif_r = '<div class="alert alert-success">
                                      <div class="row">
                                        <div class="col-md-9"><i class="fa fa-check"></i><b> PENERBITAN SKPA DITERIMA</b>, Klik link disamping untuk melihat info penerbitan SK PA</div>
                                        <div class="col-md-3 text-right"><a class="btn btn-outline-light text-right" href="' . site_url('skpa/penerbitan') . '"><b>LIHAT INFO</b></a></div>
                                      </div>
                                    </div>';
											} else {

												$notif_r = '<div class="alert alert-warning">
                                      <div class="row">
                                        <div class="col-md-9"><i class="fa fa-check"></i><b> PENERBITAN SKPA DIREVISI</b>, Klik tombol disamping untuk melihat untuk upload berkas revisi</div>
                                        <div class="col-md-3 text-right"><a class="btn btn-outline-light text-right" href="' . site_url('skpa/penerbitan') . '"><b>LIHAT INFO</b></a></div>
                                      </div>
                                    </div>';
											}
										} else if (isset($last_judul) && $last_judul['is_acc_3'] == '0') {

											$notif_r = '<div class="alert alert-danger">
                                    <i class="fa fa-ban"></i><b> PENERBITAN SKPA DITOLAK</b>, Anda tidak lulus, Harap ajukan kembali pada periode gelombang berikutnya
                                  </div>';
										} else {
											$notif_r = '<div class="alert alert-warning">
                                    <i class="fa fa-warning"></i><b> HASIL SEMINAR BELUM DIKONFIRMASI</b>, Silahkan hubungi dosen koordinator anda untuk melakukan konfirmasi hasil seminar
                                  </div>';
										}

										if (isset($last_judul) && $last_judul['is_acc_2'] == '0') {
											$notif_t = '<div class="alert alert-danger">
                                    <i class="fa fa-ban"></i><b> GAGAL SIDANG KOMITE</b>, Harap ajukan kembali pada periode gelombang berikutnya
                                  </div>';
										} else if (isset($last_judul) && $last_judul['is_acc_2'] == '1') {
											$notif_t = '<div class="alert alert-success">
                                    <div class="row">
                                      <div class="col-md-9"><i class="fa fa-check"></i><b> SIDANG KOMITE DITERIMA</b>, Klik link disamping untuk melihat jadwal seminar</div>
                                      <div class="col-md-3 text-right"><a class="btn btn-outline-light text-right" href="' . site_url('skpa/seminar') . '"><b>LIHAT JADWAL</b></a></div>
                                    </div>
                                  </div>';
										} else {
											$notif_t = '<div class="alert alert-warning">
                                    <i class="fa fa-warning"></i><b> BERKAS BELUM DIKONFIRMASI</b>, Harap hubungi dosen koordinator anda untuk melakukan konfirmasi berkas proposal
                                  </div>';
										}
										?>
 								</div>
 							</div>

 						<?php

								if (isset($skpa) && $skpa['notif_result_seminar'] == '1') {
									echo $notif_r;
								} else if (isset($skpa) && $skpa['notif_to_seminar'] == '1') {
									echo $notif_t;
								} else {
									if (isset($last_judul) && ($last_judul['is_acc_2'] == '-1' || $last_judul['is_acc_1'] == '1 ')) {
										echo '<div class="alert alert-success">
                                    <i class="fa fa-check-circle"></i><b> BERKAS SUDAH DIKONFIRMASI</b>, Harap menunggu informasi jadwal seminar proposal
                                  </div>';
									} else if (isset($last_judul) && $last_judul['is_acc_1'] == '0') {
										echo '<div class="alert alert-danger">
                                    <i class="fa fa-check-ban"></i><b> BERKAS DITOLAK</b>, Harap segera upload ulang <b><a style="color:#fff" href="' . site_url('skpa/daftar') . '">Disini</a></b>
                                  </div>';
									}
								}
							} ?>

 						<?php if ($profile['posisi'] == 'Mahasiswa') { ?>

 							<div class="row">
 								<div class="col-md-8">
 									<div class="card-header">
 										<h6>Informasi dan Pemberitahuan</h6>
 									</div>
 									<div class="card-body">
 										<?= $option['info_tambahan'] ?>
 									</div>
 								</div>

 								<div class="col-md-4">
 									<div class="card-header">
 										<h6>Progress</h6>
 									</div>
 									<div class="card-body">
 										<table class="table">
 											<tr>
 												<th>Pengajuan Judul</th>
 												<td class="text-right">
 													<?php if (isset($last_judul) && $last_judul['is_acc_1'] == '1') {
															echo "<i class='fa fa-check-circle text-success'></i>";
														} else {
															echo "-";
														} ?>
 												</td>
 											</tr>

 											<tr>
 												<th>Komite PA</th>
 												<td class="text-right">
 													<?php if (isset($last_judul) && $last_judul['is_acc_2'] == '1') {
															echo "<i class='fa fa-check-circle text-success'></i>";
														} else {
															echo "-";
														} ?>
 												</td>
 											</tr>

 											<tr>
 												<th>Seminar PA</th>
 												<td class="text-right">
 													<?php if (isset($last_judul) && $last_judul['is_acc_3'] == '1') {
															echo "<i class='fa fa-check-circle text-success'></i>";
														} else {
															echo "-";
														} ?>
 												</td>
 											</tr>

 											<tr>
 												<th>Penerbitan SK PA</th>
 												<td class="text-right">
 													<?php if (isset($last_judul) && $last_judul['is_acc_3'] == '1') {
															if ($last_judul['is_revisi'] == '0' || $last_judul['is_revisi'] == '-1') {
																echo "<i class='fa fa-check-circle text-success'></i>";
															} else {
																echo "<span class='badge badge-warning'>Revisi</span>";
															}
														} else {
															echo "-";
														} ?>
 												</td>
 											</tr>
 										</table>
 									</div>
 								</div>
 							</div>

 							<?php if (is_null($last_judul)) { ?>
 								<div class="col-md-row">
 									<div class="col-md-12">
 										<div class="alert alert-info">
 											<b><i class="fa fa-warning"></i> Belum Terdaftar </b><br>
 											Anda belum terdaftar pada gelombang ini, silahkan melakukan daftar dengan memilih dosen pembimbing pada menu <b>Pendaftaran SK PA</b>
 										</div>
 									</div>
 								</div>
 							<?php } ?>

 						<?php } ?>


 						<div class="row">
 							<div class="col-md-6">
 								<div class="card">
 									<div class="card-header">
 										<h6>Jadwal Gelombang Aktif</h6>
 									</div>
 									<div class="card-body">

 										<label class="badge badge-light" style="background-color: #eee">Tanggal Penentuan Judul</label>
 										<div class="row">
 											<div class="col-md-6">
 												<label>Mulai</label><br>
 												<?= $skpa['tanggal_judul_start'] ?>
 											</div>
 											<div class="col-md-6">
 												<label>Selesai</label><br>
 												<?= $skpa['tanggal_judul_end'] ?>
 											</div>
 										</div>

 										<hr>

 										<label class="badge badge-light" style="background-color: #eee">Tanggal Sidang Komite</label>
 										<div class="row">
 											<div class="col-md-4">
 												<label>Start</label><br>
 												<?= $skpa['tanggal_sidang_start'] ?>
 											</div>
 											<div class="col-md-4">
 												<label>Selesai</label><br>
 												<?= $skpa['tanggal_sidang_end'] ?>
 											</div>
 											<div class="col-md-4">
 												<label>Pemberitahuan</label><br>
 												<?= $skpa['tanggal_hasil_sidang'] ?>
 											</div>
 										</div>

 										<hr>

 										<label class="badge badge-light" style="background-color: #eee">Tanggal Seminar</label>
 										<div class="row">
 											<div class="col-md-4">
 												<label>Start</label><br>
 												<?= $skpa['tanggal_seminar_start'] ?>
 											</div>
 											<div class="col-md-4">
 												<label>Selesai</label><br>
 												<?= $skpa['tanggal_seminar_end'] ?>
 											</div>
 											<div class="col-md-4">
 												<label>Pemberitahuan</label><br>
 												<?= $skpa['tanggal_hasil_seminar'] ?>
 											</div>
 										</div>

 										<hr>

 										<label class="badge badge-light" style="background-color: #eee">Tanggal Penerbitan SK PA</label>
 										<div class="row">
 											<div class="col-md-4">
 												<?= $skpa['tanggal_terbit_skpa'] ?>
 											</div>
 										</div>

 									</div>
 								</div>
 							</div>


 							<div class="col-md-6">
 								<div class="card">
 									<div class="card-header">
 										<h6>Informasi Profil</h6>
 									</div>
 									<div class="card-body">
 										<table class="table">

 											<?php if ($profile['posisi'] == 'Dosen') { ?>
 												<tr>
 													<th style="width: 30%; background-color: #eee">Kode Dosen / NIP</th>
 													<td><?= $profile['kode_dosen'] . " / " . $profile['nip'] ?></td>
 												</tr>

 											<?php } else if ($profile['posisi'] == 'Mahasiswa') { ?>
 												<tr>
 													<th style="width: 30%; background-color: #eee">NIM</th>
 													<td><?= $profile['nim'] ?></td>
 												</tr>

 											<?php } ?>

 											<tr>
 												<th style="width: 30%; background-color: #eee">Nama</th>
 												<td><?= $profile['nama'] ?></td>
 											</tr>

 											<tr>
 												<th style="width: 30%; background-color: #eee">Posisi</th>
 												<td><?= $profile['posisi'] ?></td>
 											</tr>

 											<?php if ($profile['posisi'] != 'Superadmin') { ?>

 												<?php if ($profile['posisi'] == 'Mahasiswa') { ?>

 													<tr>
 														<th style="width: 30%; background-color: #eee">Fakultas</th>
 														<td><?= $profile['nama_fakultas'] ?></td>
 													</tr>

 													<tr>
 														<th style="width: 30%; background-color: #eee">Jurusan</th>
 														<td><?= $profile['nama_jurusan'] ?></td>
 													</tr>

 													<?php $angkatan = $this->db->where('angkatan_kelas.id', $profile['kelas_id'])
															->join('angkatan', 'angkatan.id = angkatan_kelas.angkatan_id')
															->get('angkatan_kelas')->row_array();
														?>

 													<tr>
 														<th style="width: 30%; background-color: #eee">Angkatan</th>
 														<td><?= $angkatan['nama_angkatan'] ?></td>
 													</tr>

 													<tr>
 														<th style="width: 30%; background-color: #eee">Kelas</th>
 														<td><?= $angkatan['nama_kelas'] ?></td>
 													</tr>

 												<?php } ?>


 											<?php } ?>

 										</table>
 									</div>
 								</div>
 							</div>

 						</div>

 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>
