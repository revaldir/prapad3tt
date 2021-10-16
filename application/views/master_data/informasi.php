 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Tambahan</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Informasi</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Detail Informasi dan Pemberitahuan</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-8">
                            <form method="POST" enctype="multipart/form-data" action="<?= site_url('insert_info') ?>">
                                <label>Informasi dan Pemberitahuan</label>
                                <div class="col-md-12">
                                  <textarea class="form-control summernote-editor" name="info_tambahan"><?= $info['info_tambahan'] ?></textarea>

                                  <br>

                                  <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                                </div>
                            </form>
                          </div>

                          <div class="col-md-4">
                            <form action="<?= site_url('insert_syarat') ?>" method="POST" enctype="multipart/form-data">
                              <div class="col-md-12">
                                <label>Berkas Persyaratan Penerbitan SK PA</label>
                                <input type="file" required="" name="file_syarat" class="btn btn-light">
                                
                                <hr>

                                <button class="btn btn-warning"><i class="fa fa-check"></i> Upload</button>

                                <a class="pull-right btn btn-outline-primary btn-sm" href="<?= base_url('assets/'.$info['syarat_terbit_skpa']) ?>">Lihat Berkas</a>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
