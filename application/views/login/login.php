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
                                            <a href="../index.php">
                                                <!--<img src="<?php echo base_url() ?>assets/images/istana_logo.png" alt="" height="24" />-->
                                                <center>
                                                    <h3 class="d-inline align-middle ml-1 text-logo">
                                                        PENDAFTARAN PRA PA
                                                    </h3>
                                                </center>
                                            </a>
                                        </div>

                                        <h6 class="h5 mb-0 mt-4">Login</h6>
                                        <p class="text-muted mt-1 mb-4">Login untuk mengakses aplikasi</p>

                                        <div class="row">
                                          <div class="col-md-12">
                                            <?php echo $this->session->flashdata('alert_message') ?>
                                          </div>
                                        </div>

                                        <?php 
                                        $title = 'Username';
                                        if($page == 'mahasiswa'){
                                            $title = 'NIM';
                                        }else if($page == 'dosen'){
                                            $title = 'NIP';
                                        } ?>

                                        <form action="<?php echo site_url('do_login/'.$page) ?>" method="POST" class="authentication-form">
                                            <div class="form-group">
                                                <label class="form-control-label"><?= $title ?></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" required="" name="<?= strtolower($title) ?>" class="form-control" id="email" placeholder="<?= $title ?>...">
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <label class="form-control-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" required="" name="password" class="form-control" id="password"
                                                        placeholder="Password...">
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" type="submit"> Log In
                                                </button>
                                            </div>

                                            <?php if($page == 'mahasiswa'){ ?>
                                                    <div class="form-group mt-4 text-center">
                                                        <a href="<?= site_url('daftar') ?>">Daftar Disini</a>
                                                    </div>
                                            <?php } ?>
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
        
    </body>

</html>