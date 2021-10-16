 <div class="container-fluid">
 	<div class="row page-title">
 		<div class="col-md-12">
 			<nav aria-label="breadcrumb" class="float-right mt-1">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Komite PA
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
 						<h5 class="header-title mb-1 mt-0">Informasi Komite</h5>
 						<p class="sub-header"></p>

 						<div class="row">
 							<div class="col-md-12">
 								<?php echo $this->session->flashdata('alert_message') ?>
 							</div>
 						</div>

 						<?php if ($skpa['notif_to_seminar'] == '1') {
								if (isset($last_judul) && $last_judul['is_acc_2'] == '1') {

									echo "<center><h5 class='text-success'><i class='fa fa-check'></i> ANDA LULUS KOMITE PA</h5></center>";
									$ketentuan = '
									  Setelah Judul PA disetujui sidang komite, mahasiswa melakukan proses bimbingan dengan pembimbing untuk menyelesaikan buku proposal hingga Bab IV. Proses bimbingan harus tercatat pada form bimbingan pra seminar.';

									$alertKetentuan = "<div class='alert alert-success'><b><i class='fa fa-check-circle'></i> Lulus Sidang Komite</b> <br> " . $ketentuan . "</div>";
									$catatan = "<div class='alert alert-success'><b><i class='fa fa-check-circle'></i> Catatan:</b> <br> " . $last_judul['catatan'] . "</div>";
									echo $alertKetentuan;
									echo $catatan;
								} else {
									if (isset($last_judul) && $last_judul['is_acc_1'] == '-1') {
										echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> BERKAS PROPOSAL BELUM DIKONFIRMASI</h5>
                                    Harap menunggu status persetujuan proposal</h5></center>";
									} else {
										if (isset($last_judul) && $last_judul['is_acc_2'] == '-1') {
											echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> Berkas belum dikonfirmasi</h5>
                                  Harap hubungi dosen koordinator Anda untuk melakukan konfirmasi berkas proposal</h5></center>";
										} else {
											echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> Sidang Komite PA Tidak Lulus</h5>
                                    Pengajuan judul anda tidak lolos, silahkan coba gelombang berikutnya</h5></center> <br>";

											$ketentuan = 'Judul pengajuan Project Akhir telah ada sebelumnya';

											$alertKetentuan = "<div class='alert alert-danger'><b><i class='fa fa-check-circle'></i> Tidak Lulus</b> <br> " . $ketentuan . "</div>";
											echo $alertKetentuan;
											$catatan = "<div class='alert alert-danger'><b><i class='fa fa-check-circle'></i> Catatan:</b> <br> " . isset($last_judul) && isset($last_judul) ? $last_judul['catatan'] : '' . "</div>";
											echo $catatan;
										}
									}
								}
							?>

 						<?php } else {

								echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> STATUS: INFORMASI SEMINAR PROPOSAL BELUM DIBERITAHU</h5></center>";
							} ?>

 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>
