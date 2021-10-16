<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shreyu.coderthemes.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Nov 2019 03:34:59 GMT -->

<head>
	<meta charset="utf-8" />
	<title>PENDAFTARAN PRA PA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/istana_logo.png">

	<!-- plugins -->
	<link href="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

	<!-- App css -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link href="<?php echo base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/libs/summernote-0.8.18-dist/summernote.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>

	<style type="text/css">
		.note-toolbar {
			background-color: #777 !important
		}
	</style>

</head>

<body>
	<!-- Begin page -->
	<div id="wrapper">

		<!-- Topbar Start -->
		<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
			<div class="container-fluid">
				<!-- LOGO -->
				<a href="#" class="navbar-brand mr-0 mr-md-2 logo">
					<span class="logo-lg">
						<!--<img src="<?php echo base_url() ?>assets/images/istana_logo.png" alt="" height="24" />-->
						<span class="d-inline h6 ml-1 text-logo">PENDAFTARAN PRA PA</span>
					</span>
					<span class="logo-sm">
						<img src="<?php echo base_url() ?>assets/images/istana_logo.png" alt="" height="24">
					</span>
				</a>

				<ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
					<li class="">
						<button class="button-menu-mobile open-left disable-btn">
							<i data-feather="menu" class="menu-icon"></i>
							<i data-feather="x" class="close-icon"></i>
						</button>
					</li>
				</ul>

				<ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">


					<li class="dropdown notification-list align-self-center profile-dropdown">
						<a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<div class="media user-profile ">
								<img src="<?php echo base_url() ?>assets/images/users/avatar-3.jpg" alt="user-image" class="rounded-circle align-self-center" />
								<div class="media-body text-left">
									<h6 class="pro-user-name ml-2 my-0">
										<span><?php echo $this->session->userdata('user_data')['nama'] ?></span>
										<span class="pro-user-desc text-muted d-block mt-1"><?php echo $this->session->userdata('user_data')['posisi'] ?> </span>
									</h6>
								</div>
								<span data-feather="chevron-down" class="ml-2 align-self-center"></span>
							</div>
						</a>
						<div class="dropdown-menu profile-dropdown-items dropdown-menu-right">

							<a href="<?php echo site_url('auth/logout') ?>" class="dropdown-item notify-item">
								<i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
								<span>Logout</span>
							</a>
						</div>
					</li>
				</ul>
			</div>

		</div>
		<!-- end Topbar -->


		<!-- ========== Left Sidebar Start ========== -->
		<div class="left-side-menu">
			<div class="media user-profile mt-2 mb-2">
				<img src="<?php echo base_url() ?>assets/images/users/avatar-11.png" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
				<img src="<?php echo base_url() ?>assets/images/users/avatar-13.png" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />

				<div class="media-body">
					<h6 class="pro-user-name mt-0 mb-0"><?php echo $this->session->userdata('user_data')['nama'] ?></h6>
					<span class="pro-user-desc"><?php echo $this->session->userdata('user_data')['posisi'] ?></span>
				</div>
				<div class="dropdown align-self-center profile-dropdown-menu">
					<a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<span data-feather="chevron-down"></span>
					</a>
					<div class="dropdown-menu profile-dropdown">

						<a href="<?php echo site_url('auth/logout') ?>" class="dropdown-item notify-item">
							<i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
							<span>Logout</span>
						</a>
					</div>
				</div>
			</div>
			<div class="sidebar-content">
				<!--- Sidemenu -->
				<div id="sidebar-menu" class="slimscroll-menu">
					<ul class="metismenu" id="menu-bar">
						<li class="menu-title">Navigation</li>

						<?php $role = $this->session->userdata('user_data')['posisi'] ?>

						<li>
							<a href="<?php echo site_url('dashboard') ?>">
								<i data-feather="home"></i>
								<span> Dashboard </span>
							</a>
						</li>

						<?php if ($role == 'Mahasiswa') { ?>
							<li>
								<a href="<?php echo site_url('rekomendasi_judul') ?>">
									<i data-feather="file"></i>
									<span> Lihat Rekomendasi Judul </span>
								</a>
							</li>

						<?php } ?>

						<?php if ($role == 'Superadmin') {
							$num_notif = $this->db->where('is_read', '0')->get('pengajuan_judul')->num_rows();

							$num_revisi = $this->db->where('is_acc_3', '1')
								->where('is_revisi_upload', '1')
								->get('pengajuan_judul')->num_rows();

							$num_berkas = $this->db->where('is_acc_2', '1')
								->where('is_acc_2_1', '-1')
								->get('pengajuan_judul')->num_rows();
						?>

							<li class="menu-title">Master Data</li>

							<li>
								<a href="<?php echo site_url('master_data/angkatan') ?>">
									<i data-feather="calendar"></i>
									<span> Angkatan </span>
								</a>
							</li>

							<!--<li>   
                                <a href="javascript: void(0);">
                                    <i data-feather="file-text"></i>
                                    <span> Kampus </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo site_url('master_data/jurusan') ?>">Jurusan</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('master_data/fakultas') ?>">Fakultas</a>
                                    </li>
                                </ul>
                            </li>-->

							<li>
								<a href="javascript: void(0);">
									<i data-feather="file-text"></i>
									<span> User </span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo site_url('master_data/dosen') ?>">Dosen</a>
									</li>

									<li>
										<a href="<?php echo site_url('master_data/mahasiswa') ?>">Mahasiswa</a>
									</li>

								</ul>
							</li>

							<li>
								<a href="<?php echo site_url('master_data/informasi') ?>">
									<i data-feather="volume-2"></i>
									<span> Informasi Tambahan </span>
								</a>
							</li>

						<?php } ?>


						<li class="menu-title">Transaksi</li>

						<?php if ($role == 'Superadmin') { ?>

							<li>
								<a href="<?php echo site_url('skpa/list') ?>">
									<i data-feather="calendar"></i>
									<span> Timeline </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/request') ?>">
									<i data-feather="calendar"></i>
									<span class="badge badge-danger float-right"><?= $num_notif ?></span>
									<span>Request Judul </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/komite') ?>">
									<i data-feather="calendar"></i>
									<span> Komite PA </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/berkas_seminar') ?>">
									<i data-feather="calendar"></i>
									<span class="badge badge-danger float-right"><?= $num_berkas ?></span>
									<span> Berkas Seminar</span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/confirmation') ?>">
									<i data-feather="calendar"></i>
									<span> Hasil Seminar </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/revisi') ?>">
									<i data-feather="calendar"></i>
									<span class="badge badge-danger float-right"><?= $num_revisi ?></span>
									<span>Revisi </span>
								</a>
							</li>

						<?php } else if ($role == 'Mahasiswa') { ?>

							<li>
								<a href="<?php echo site_url('skpa/daftar') ?>">
									<i data-feather="calendar"></i>
									<span> Pengajuan Judul </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/komite_status') ?>">
									<i data-feather="calendar"></i>
									<span> Komite PA </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/seminar') ?>">
									<i data-feather="calendar"></i>
									<span> Seminar PA </span>
								</a>
							</li>

							<li>
								<a href="<?php echo site_url('skpa/penerbitan') ?>">
									<i data-feather="calendar"></i>
									<span> Penerbitan SK PA </span>
								</a>
							</li>

						<?php } else if ($role == 'Dosen') { ?>

							<li>
								<a href="<?php echo site_url('skpa/recommendation') ?>">
									<i data-feather="calendar"></i>
									<span>Rekomendasi Judul</span>
								</a>
							</li>

						<?php } ?>

						<?php if ($role == 'Superadmin') { ?>
							<li class="menu-title">Laporan</li>
							<li>
								<a href="<?php echo site_url('laporan') ?>">
									<i data-feather="calendar"></i>
									<span>SK PA </span>
								</a>
							</li>

						<?php } ?>

					</ul>
				</div>
				<!-- End Sidebar -->

				<div class="clearfix"></div>
			</div>
			<!-- Sidebar -left -->

		</div>
		<!-- Left Sidebar End -->

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page">
			<div class="content">
				<?php echo $contents ?>
			</div> <!-- content -->



			<!-- Footer Start -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!--2019 &copy; Shreyu. All Rights Reserved. Crafted with <i class='uil uil-heart text-danger font-size-12'></i></a>-->
						</div>
					</div>
				</div>
			</footer>
			<!-- end Footer -->

		</div>

		<!-- ============================================================== -->
		<!-- End Page content -->
		<!-- ============================================================== -->


	</div>
	<!-- END wrapper -->

	<!-- Right Sidebar -->
	<div class="right-bar">
		<div class="rightbar-title">
			<a href="javascript:void(0);" class="right-bar-toggle float-right">
				<i data-feather="x-circle"></i>
			</a>
			<h5 class="m-0">Customization</h5>
		</div>

		<div class="slimscroll-menu">

			<h5 class="font-size-16 pl-3 mt-4">Choose Variation</h5>
			<div class="p-3">
				<h6>Default</h6>
				<a href="index.html"><img src="<?php echo base_url() ?>assets/images/layouts/vertical.jpg" alt="vertical" class="img-thumbnail demo-img" /></a>
			</div>
			<div class="px-3 py-1">
				<h6>Top Nav</h6>
				<a href="layouts-horizontal.html"><img src="<?php echo base_url() ?>assets/images/layouts/horizontal.jpg" alt="horizontal" class="img-thumbnail demo-img" /></a>
			</div>
			<div class="px-3 py-1">
				<h6>Dark Side Nav</h6>
				<a href="layouts-dark-sidebar.html"><img src="<?php echo base_url() ?>assets/images/layouts/vertical-dark-sidebar.jpg" alt="dark sidenav" class="img-thumbnail demo-img" /></a>
			</div>
			<div class="px-3 py-1">
				<h6>Condensed Side Nav</h6>
				<a href="layouts-dark-sidebar.html"><img src="<?php echo base_url() ?>assets/images/layouts/vertical-condensed.jpg" alt="condensed" class="img-thumbnail demo-img" /></a>
			</div>
			<div class="px-3 py-1">
				<h6>Fixed Width (Boxed)</h6>
				<a href="layouts-boxed.html"><img src="<?php echo base_url() ?>assets/images/layouts/boxed.jpg" alt="boxed" class="img-thumbnail demo-img" /></a>
			</div>
		</div> <!-- end slimscroll-menu-->
	</div>
	<!-- /Right-bar -->

	<!-- Right bar overlay-->
	<div class="rightbar-overlay"></div>

	<!-- Vendor js -->
	<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>

	<!-- optional plugins -->
	<script src="<?php echo base_url() ?>assets/libs/moment/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>

	<!-- page js -->
	<script src="<?php echo base_url() ?>assets/js/pages/dashboard.init.js"></script>

	<script src="<?php echo base_url() ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

	<!-- App js -->
	<script src="<?php echo base_url() ?>assets/js/app.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/format_rp.js"></script>
	<script src="<?php echo base_url() ?>assets/libs/summernote-0.8.18-dist/summernote.min.js"></script>

	<script type="text/javascript">
		$('.datatables').DataTable();
		$('.summernote-editor').summernote({
			height: 250,
			minHeight: null,
			maxHeight: null,
			focus: !1
		});
	</script>
</body>

</html>
