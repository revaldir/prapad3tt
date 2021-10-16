 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('master_data/mahasiswa') ?>">Fakultas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Mahasiswa</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Detail Mahasiswa</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Detail Mahasiswa</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-4">
                            <a href="<?= site_url('master_data/fakultas') ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> KEMBALI</a>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-lg-4">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="text-center mt-3">
                                          <!--<img src="assets/images/users/avatar-7.jpg" alt=""
                                              class="avatar-lg rounded-circle" />-->
                                          <h5 class="mt-2 mb-0"><?= $mahasiswa['nama_mahasiswa'] ?></h5>
                                          <h6 class="text-muted font-weight-normal mt-2 mb-0">
                                            <?= $mahasiswa['nama_jurusan'] ?>
                                          </h6>
                                          <h6 class="text-muted font-weight-normal mt-1 mb-4">
                                            <?= $mahasiswa['nama_fakultas'] ?>
                                          </h6>
                                      </div>

                                      <div class="mt-3 pt-2 border-top">
                                          <h4 class="mb-3 font-size-15">Informasi Kontak</h4>
                                          <div class="table-responsive">
                                              <table class="table table-borderless mb-0 text-muted">
                                                  <tbody>
                                                      <tr>
                                                          <th scope="row">NIM</th>
                                                          <td><?= $mahasiswa['nim'] ?></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">No. Telp</th>
                                                          <td><?= $mahasiswa['no_telp'] ?></td>
                                                      </tr>
                                                      <tr>
                                                          <th scope="row">Email</th>
                                                          <td><?= $mahasiswa['email'] ?></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- end card -->

                          </div>

                          <div class="col-lg-8">
                              <div class="card">
                                  <div class="card-body">
                                      <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                                          <li class="nav-item">
                                              <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                                                  href="#pills-activity" role="tab" aria-controls="pills-activity"
                                                  aria-selected="true">
                                                  Pembimbing
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                                  href="#pills-messages" role="tab" aria-controls="pills-messages"
                                                  aria-selected="false">
                                                  Penguji
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" id="pills-projects-tab" data-toggle="pill"
                                                  href="#pills-projects" role="tab" aria-controls="pills-projects"
                                                  aria-selected="false">
                                                  Progress SKPA
                                              </a>
                                          </li>
                                      </ul>

                                      <div class="tab-content" id="pills-tabContent">
                                          <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                              aria-labelledby="pills-activity-tab">
                                              <table class="table">
                                                <tr>
                                                  <th style="width: 30%">Pembimbing 1</th>
                                                  <th>
                                                    <select class="form-control" required="" id="pbb1" name="pbb1_id">
                                                      <option value="">Pilih</option>
                                                      <?php foreach ($dosen as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                                                      <?php } ?>
                                                    </select>
                                                  </th>
                                                </tr>

                                                <tr>
                                                  <th>Pembimbing 2 <br><small>*Optional</small></th>
                                                  <th>
                                                    <select class="form-control" disabled="" id="pbb2" name="pbb2_id">
                                                      <option value="">Harap Pilih Pembimbing 1</option>
                                                      <?php foreach ($dosen as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                                                      <?php } ?>
                                                    </select>
                                                  </th>
                                                </tr>

                                                <tr>
                                                  <th></th>
                                                  <th class="text-right">
                                                    <button class="btn btn-success">Simpan</button>
                                                  </th>
                                                </tr>
                                              </table>
                                          </div>

                                          <!-- messages -->
                                          <div class="tab-pane" id="pills-messages" role="tabpanel"
                                          aria-labelledby="pills-messages-tab">
                                              
                                          </div>

                                          <div class="tab-pane fade" id="pills-projects" role="tabpanel"
                                              aria-labelledby="pills-projects-tab">

                                          </div>

                                      </div>

                                  </div>
                              </div>
                              <!-- end card -->
                          </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
  $(document).on('change', '#pbb1', function(){
    if($(this).val() != ''){
      reset();

    }else{
      $('#pbb2').attr('disabled', 'disabled')
      $('#pbb2 option').removeAttr('selected');
      $('#pbb2 option[value=""]').attr('selected', 'selected').text('Harap Pilih Pembimbing 1');
    }
  });

  $(document).on('change', '#pbb2', function(){
    var pbb1 = $('#pbb1').val();
    if($(this).val() != pbb1){

    }else{
      alert('Pembimbing 2 tidak boleh sama dengan pembimbing 1');
      reset();
    }
  });

  function reset(){
    $('#pbb2').removeAttr('disabled', 'disabled');
    $('#pbb2 option').removeAttr('selected');
    $('#pbb2 option[value=""]').attr('selected', 'selected').text('Tidak Ada');
  }
</script>
