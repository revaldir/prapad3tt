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
                                    <div class="col-md-12 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="index.php">
                                                <!--<img src="<?php echo base_url() ?>assets/images/istana_logo.png" alt="" height="24" />-->
                                                <h3 class="d-inline align-middle ml-1 text-logo">PENDAFTARAN PRA PA</h3>
                                            </a>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8 text-left">
                                                <h6 class="h5 mb-0 mt-4">Akses Login</h6>
                                                <p class="text-muted mt-1 mb-4">
                                                    Silahkan pilih akses login sesuai akun anda.
                                                </p>
                                            </div>

                                            <div class="col-md-4 text-right">
                                                <br>
                                                <a href="<?= base_url('assets/'.$info['syarat_terbit_skpa']) ?>" class="btn btn-outline-primary"><i class="fa fa-download"></i> Download Pedoman & Form Pra PA</a>
                                            </div>
                                        </div>
                                        

                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <a href="<?= site_url('login/mahasiswa') ?>">
                                                    <div class="card" style="border:3px solid #eee">
                                                        <div class="card-body">
                                                            <center>
                                                            <img src="<?= base_url('assets/images/icon/mahasiswa.png') ?>" style="width: 50px"><br><br>
                                                            <b style="font-size: 13px">MAHASISWA</b>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="<?= site_url('login/dosen') ?>">
                                                    <div class="card" style="border:3px solid #eee">
                                                        <div class="card-body">
                                                            <center>
                                                                <img src="<?= base_url('assets/images/icon/dosen.png') ?>" style="width: 50px"><br><br>
                                                                <b style="font-size: 13px">DOSEN</b>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="<?= site_url('login/admin') ?>">
                                                    <div class="card" style="border:3px solid #eee">
                                                        <div class="card-body">
                                                            <center>
                                                                <img src="<?= base_url('assets/images/icon/dosen.png') ?>" style="width: 50px"><br><br>
                                                                <b style="font-size: 13px">DOSEN KOORDINATOR</b>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        
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
        
    </body>

</html>