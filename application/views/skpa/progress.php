 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SK PA</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('skpa/list') ?>">Daftar SK PA</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('skpa/detail/'.$partisipan['skpa_id']) ?>">Detail SK PA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail SK PA</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Detail Progress</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Detail Fakultas</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-2">
                            <a href="<?= site_url('skpa/detail/'.$partisipan['skpa_id']) ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> KEMBALI</a>
                          </div>

                          <div class="col-md-8">
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 15%">SK PA</th>
                                <td><?= $partisipan['kode_skpa']." / ".$partisipan['tahun'] ?></td>

                                <th style="background-color: #eee; width: 15%">Waktu</th>
                                <td><?= indonesian_date($partisipan['start'])." s/d ".indonesian_date($partisipan['end']) ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <h5>Mahasiswa</h5>
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 35%">NIM / Mahasiswa</th>
                                <td><?= $partisipan['nim']." / ".$partisipan['nama_mahasiswa'] ?></td>
                              </tr>
                              <tr>
                                <th style="background-color: #eee;">Fakultas / Jurusan</th>
                                <td><?= $partisipan['nama_jurusan']." <br><small>".$partisipan['nama_fakultas']."<small>" ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <h5>Dosen</h5>
                            <?php 

                            $dosen2 = '-';
                            if($partisipan['nama_dosen2'] != ''){
                              $dosen2 = $partisipan['nama_dosen2']."<br><small>".$partisipan['kode_dosen2']."</small>";
                            }

                            $s_penguji = false;
                            $penguji = '<span class="badge badge-info">Belum Ditetapkan</span>';

                            if($partisipan['nama_penguji'] != ''){
                              $s_penguji = true;
                              $penguji = $partisipan['nama_penguji']."<br><small>".$partisipan['kode_penguji']."</small>";
                            }

                            ?>
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 30%">Pembimbing 1</th>
                                <td><?= $partisipan['nama_dosen1']." <br><small>".$partisipan['kode_dosen1']."</small>" ?></td>
                              </tr>
                              <tr>
                                <th style="background-color: #eee;">Pembimbing 2</th>
                                <td><?= $dosen2 ?></td>
                              </tr>
                              <tr>
                                <th style="background-color: #eee;">Penguji</th>
                                <td><?= $penguji ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        
                        <br><br>

                        <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                                    href="#pills-activity" role="tab" aria-controls="pills-activity"
                                    aria-selected="true">
                                    Pengajuan Judul
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                    href="#pills-messages" role="tab" aria-controls="pills-messages"
                                    aria-selected="false">
                                    Informasi Seminar
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                aria-labelledby="pills-activity-tab">

                                <div class="table-responsive">
                                  <table class="display table table-hover datatables" >
                                    <thead style="background-color: #eee">
                                      <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Judul</th>
                                        <th style="width: 13%" class="text-center">File</th>
                                        <th style="width: 17%">Waktu Upload</th>
                                        <th class="text-center">Status ACC Kordinator</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $n = 0;
                                            foreach ($judul as $row) { $n++; ?>

                                              <tr>
                                                <td><?= $n ?></td>
                                                <td><?= $row['nama_judul'] ?></td>
                                                <td class="text-center"><a href="<?= base_url('assets/file/'.$row['file_judul']) ?>" class=""><i class="fa fa-download"></i> Download</a></td>

                                                <td><?= $row['waktu_upload'] ?></td>

                                                <td class="text-center">
                                                  <?= show_acc($row['is_acc_1']) ?><br>
                                                  <small><?= $row['waktu_acc_1'] ?></small>
                                                </td>
                                              </tr>

                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>

                            </div>

                            <!-- messages -->
                            <div class="tab-pane" id="pills-messages" role="tabpanel"
                            aria-labelledby="pills-messages-tab">

                              <div class="row">
                                <div class="col-md-8">
                                    
                                    <form method="POST" action="<?= site_url('set_seminar/'.$partisipan['skpa_gelombang_id'].'/'.$partisipan['skpa_gelombang_daftar_id']) ?>">
                                      <div class="row">
                                        <div class="form-group col-md-6">
                                          <label>Dosen Penguji</label>
                                          <select class="form-control" required="" id="penguji_id" name="penguji_id">
                                            <option value="">Pilih</option>
                                            <?php foreach ($dosen as $row){ 
                                                    if($row['id'] != $partisipan['pembimbing_1_id'] && $row['id'] != $partisipan['pembimbing_2_id']){ ?>

                                                    <option <?php if($row['id'] == $partisipan['penguji_id']){ echo "selected='selected'"; } ?> value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                                              
                                            <?php } } ?>
                                          </select>
                                        </div>

                                        <div class="col-md-3">
                                         <label>Tanggal Seminar</label>
                                         <input value="<?= $partisipan['tanggal_seminar'] ?>" type="text" id="tanggal_seminar" name="tanggal_seminar" class="form-control datepicker" placeholder="Tanggal Seminar..." autocomplete="off" required />
                                        </div>

                                        <div class="col-md-3">
                                         <label>Jam</label>
                                         <input value="<?= $partisipan['jam_seminar'] ?>" type="time" id="jam_seminar" name="jam_seminar" class="form-control" placeholder="..." autocomplete="off" required />
                                        </div>

                                        <div class="col-md-4">
                                         <label>Ruangan</label>
                                         <input value="<?= $partisipan['ruangan'] ?>" type="text" id="ruangan" name="ruangan" class="form-control" placeholder="Ruangan Seminar..." autocomplete="off" required />
                                        </div>

                                        <div class="col-md-4">
                                          <br>
                                          <button style="margin-top: 7px" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                                        </div>
                                      </div>

                                    </form>

                                </div>

                                <div class="col-md-4">
                                  <table class="table">
                                    <tr>
                                      <th colspan="2" class="text-center">STATUS</th>
                                    </tr>
                                    <tr>
                                      <th>Komite PA</th>
                                      <td>
                                        <?php if($last_judul['is_acc_2'] == '-1'){ ?>
                                                <span class="text-info"><i class="fa fa-clock-o"></i> Menunggu...</span>
                                        <?php }else{
                                          echo show_acc($last_judul['is_acc_2']);
                                        } ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>SK PA</th>
                                      <td>
                                        <?php if($last_judul['is_acc_3'] == '0'){
                                          echo show_acc($last_judul['is_acc_3']);
                                        }else{
                                          if($last_judul['is_revisi'] == '1'){
                                            if($last_judul['is_revisi_acc'] == '1'){
                                              echo show_acc('1');
                                            }else {
                                              echo "<span class='badge badge-warning'>Revisi</span>";
                                            }
                                          }
                                        } ?>
                                      </td>
                                    </tr>
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

  function edit(id, judul_s, judul_e, sidang_s, sidang_e, sidang_h, seminar_s, seminar_e, seminar_h, terbit, gelombang){
      $('#e_id').val(id);
      $('#judul_s').val(judul_s);
      $('#judul_e').val(judul_e);
      $('#sidang_s').val(sidang_s);
      $('#sidang_e').val(sidang_e);
      $('#sidang_h').val(sidang_h);
      $('#seminar_s').val(seminar_s);
      $('#seminar_e').val(seminar_e);
      $('#seminar_h').val(seminar_h);
      $('#terbit').val(terbit);
      $('#e_gelombang').text(gelombang);

      $('#modalEdit').modal('show')
     }
</script>

<script type="text/javascript">
    $('.datepicker').datepicker({
      dateFormat : "yy-mm-dd"
     });
</script>