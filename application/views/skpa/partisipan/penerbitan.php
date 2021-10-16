 <div class="container-fluid">
 	<div class="row page-title">
 		<div class="col-md-12">
 			<nav aria-label="breadcrumb" class="float-right mt-1">
 				<ol class="breadcrumb">
 					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 					<li class="breadcrumb-item active" aria-current="page">Penerbitan SK PA
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
 						<h5 class="header-title mb-1 mt-0">Informasi Penerbitan SK PA</h5>
 						<p><b>Judul PA : </b> <?= isset($last_judul) ? $last_judul['nama_judul'] : '' ?></p>
 						<p class="sub-header"></p>

 						<div class="row">
 							<div class="col-md-12">
 								<?php echo $this->session->flashdata('alert_message') ?>
 							</div>
 						</div>

 						<?php if ($skpa['notif_result_seminar'] == '1') {
								if (isset($last_judul) && $last_judul['is_acc_3'] == '1') {
									if ($last_judul['is_revisi'] == '1' && $last_judul['is_revisi_acc'] != '1') {
							?>
 									<center>
 										<h5 class='text-warning'><i class='fa fa-warning'></i> REVISI BERKAS SEMINAR</h5>
 										Silahkan upload berkas revisi seminar Anda</h5>
 									</center>


 									<?php
										if ($last_judul['is_revisi_acc'] == '-1') {
											if ($last_judul['is_revisi_upload'] == '0') {
												echo "<center><br><button data-toggle='modal' data-target='#modalRevisi' class='btn btn-warning'>UPLOAD BERKAS REVISI</button></center>";
											} else {
												if ($last_judul['is_revisi_acc'] == '-1') {
													echo "<center><span class='badge badge-success'><i class='fa fa-check-circle'></i> Berkas sudah diupload</span></center>";
													echo "<center><h6><i class='fa fa-clock-o'></i> Menunggu konfirmasi berkas revisi</h6></center>";
												}
											}
										} else if ($last_judul['is_revisi_acc'] == '0') {
											echo "<center><span class='badge badge-danger'><i class='fa fa-ban'></i> Berkas ditolak</span>";
											echo "<hr>Keterangan : <br> " . $last_judul['ket_tolak'] . "</center>";
											echo "<hr><center><br><button data-toggle='modal' data-target='#modalRevisi' class='btn btn-warning'>UPLOAD ULANG</button></center>";
										}
									} else {
										echo "<center><h5 class='text-success'><i class='fa fa-check-circle'></i> SELAMAT, ANDA LULUS SEMINAR PROPOSAL</h5>
                                    Silahkan ikuti langkah dibawah ini untuk proses penerbitan SK PA</h5></center>";
										?>
 									<div class="">
 										<h6><b>Syarat dan Ketentuan : </b></h6>
 										<ol>
 											<li>Pembuatan SK Proyek Akhir diajukan Mahasiswa setelah lulus Seminar Proposal PA maksimal 1 bulan setelah tanggal seminar.</li>

 											<li>
 												Untuk mendapatkan SK PA mahasiswa harus Mengajukan SK PA melalui akun i-Gracias mahasiswa pada menu TA/PA, sekaligus mengupload Proposal dan dokumen pendukung (dalam 1 file *.pdf) yang meliputi <a href="https://igracias.telkomuniversity.ac.id/">( Klik Disini untuk akses igracias )</a> :
 												<ul>
 													<li>Scan cover proposal yang sudah diparaf oleh dosen pembimbing untuk validasi judul Bahasa Inggris Proposal</li>
 													<li>Scan lembar pengesahan yang sudah ditandatangani pembimbing</li>
 													<li>Proposal</li>
 													<li>Scan form berita acara seminar</li>
 													<li>Scan form revisi seminar</li>
 												</ul>
 											</li>

 											<li>Pengajuan SK PA akan dibantu secara kolektif oleh Koord. PA setiap tanggal 10 tiap bulan, dan akan dieksekusi oleh pihak LAK tiap minggu ke-3 dan ke-4 tiap bulan. Jadi pastikan pengajuan SK PA tidak melebihi tanggal 10, jika melebihi tanggal 10 SK PA akan diterbitkan bulan selanjutnya.</li>

 											<li>Khusus mahasiswa dengan pembimbing luar (praktisi), SK PA akan diterbitkan setelah mengirimkan scan biodata pembimbing luar (format Biodata pembimbing luar PA). ke la@tass.telkomuniversity.ac.id cc : dwiandi@tass.telkomuniversity.ac.id</li>
 										</ol>
 									</div>

 								<?php
									}
									?>

 							<?php
								} else {
									if (isset($last_judul) && $last_judul['is_acc_3'] == '-1') {
										echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> HASIL SEMINAR BELUM DIKONFIRMASI</h5>
                                    Silahkan hubungi dosen koordinator Anda untuk melakukan konfirmasi hasil seminar</h5></center>";
									} else {
										if (isset($last_judul) && $last_judul['is_acc_3'] == '1') {
											echo "<center><h5 class='text-warning'><i class='fa fa-warning'></i> Berkas belum dikonfirmasi</h5>Harap hubungi dosen koordinator Anda untuk melakukan konfirmasi berkas proposal</h5></center>";
										} else {
											echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> Penerbitan SK PA Ditolak</h5>
                                    Hasil seminar Anda tidak lulus, silahkan coba gelombang berikutnya</h5></center>";
										}
									}
								}
								?>

 						<?php } else {

								echo "<center><h5 class='text-danger'><i class='fa fa-ban'></i> STATUS INFO PENERBITAN SK PA BELUM DIBERITAHU</h5></center>";
							} ?>


 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>

 <?php if (isset($last_judul)) : ?>
 	<form action="<?php echo site_url('upload_revisi_seminar/' . $last_judul['pengajuan_judul_id']) ?>" method="post" enctype="multipart/form-data">
 		<div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 			<div class="modal-dialog">
 				<div class="modal-content">
 					<div class="modal-header">
 						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> UPLOAD REVISI
 							<button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
 					</div>

 					<div class="modal-body">
 						<label>Berkas</label><br>
 						<input type="file" name="file_revisi" class="btn btn-light" required="">
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

 <script type="text/javascript">
 	function ajukan(id, dosen) {
 		$('#e_id').val(id);
 		$('#current_dosen').text(dosen);

 		$('#modalGantiDosen').modal('show');
 	}
 </script>
