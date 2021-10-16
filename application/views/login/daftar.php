<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>PENDAFTARAN PRA PA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/istana_logo.png">

	<!-- App css -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg">

	<div class="account-pages my-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-10">
					<div class="card">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-md-6 p-5">
									<div class="mx-auto mb-5">
										<a href="index.php">
											<!--<img src="<?php echo base_url() ?>assets/images/istana_logo.png" alt="" height="24" />-->
											<h3 class="d-inline align-middle ml-1 text-logo">PENDAFTARAN PRA PA</h3>
										</a>
									</div>

									<h6 class="h5 mb-0 mt-4">Daftar Akun</h6>
									<p class="text-muted mt-1 mb-4">Lakukan Registrasi akun untuk dapat mengakses aplikasi</p>

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<form action="<?php echo site_url('do_register/') ?>" method="POST" class="authentication-form">
										<div class="form-group">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="user"></i>
													</span>
												</div>
												<input type="text" required="" name="nama_mahasiswa" class="form-control" id="email" placeholder="Nama Lengkap...">
											</div>
										</div>

										<div class="form-group mt-4">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="credit-card"></i>
													</span>
												</div>
												<input type="text" required="" name="nim" class="form-control" id="email" placeholder="NIM...">
											</div>
										</div>

										<div class="form-group mt-4">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="users"></i>
													</span>
												</div>
												<select class="form-control" required="" name="angkatan_id" id="angkatan">
													<option value="">Pilih Angkatan</option>
													<?php foreach ($angkatan as $row) { ?>
														<option value="<?= $row['id'] ?>">
															<?= $row['nama_angkatan'] ?>
														</option>
													<?php } ?>
												</select>
												<small id="ket"></small>
											</div>
										</div>

										<div class="form-group mt-4">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="calendar"></i>
													</span>
												</div>
												<select class="form-control" required="" name="kelas_id" id="kelas">
													<option value="">Pilih Kelas</option>
												</select>
											</div>
										</div>

										<div class="form-group mt-4">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="phone"></i>
													</span>
												</div>
												<input type="text" required="" name="no_telp" class="form-control" id="email" placeholder="No Telp...">
											</div>
										</div>


										<div class="form-group mt-4">
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="icon-dual" data-feather="lock"></i>
													</span>
												</div>
												<input type="password" required="" name="password" class="form-control" id="password" placeholder="Password...">
											</div>
										</div>

										<div class="form-group mb-0 text-center">
											<button class="btn btn-primary btn-block" type="submit"> Daftar Sekarang
											</button>
										</div>

										<div class="form-group mt-4 text-center">
											<a href="<?= site_url('') ?>">Login Disini</a>
										</div>
									</form>
								</div>
								<div class="col-lg-6 d-none d-md-inline-block">
									<img src="<?= base_url('assets/images/logod3tt.jpg') ?>" class="img-fluid">
								</div>
							</div>

						</div> <!-- end card-body -->
					</div>
					<!-- end card -->


				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->

	<!-- Vendor js -->
	<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>

	<!-- App js -->
	<script src="<?php echo base_url() ?>assets/js/app.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>

</body>

</html>


<script type="text/javascript">
	$(document).on('change', '#angkatan', function() {
		if ($(this).val() == '') {
			$('#kelas').html('<option value="">Pilih Kelas</option>');
		} else {
			$.ajax({
				method: "POST",
				url: "<?= site_url('get_kelas') ?>",
				dataType: "json",
				data: {
					angkatan_id: $(this).val()
				},
				beforeSend: function() {
					$('#ket').html('<i class="fa fa-spinner fa-spin"></i> Mengambil Data');
				},
				success: function(res) {
					if (res.status) {
						$('#ket').html('');
						var txt = '<option value="">Pilih Kelas</option>';
						$.each(res.data, function(index, val) {
							txt += "<option value='" + val.id + "'>" + val.nama_kelas + "</option>";
						});
						$('#kelas').html(txt);
					}
				}
			});
		}
	});
</script>
