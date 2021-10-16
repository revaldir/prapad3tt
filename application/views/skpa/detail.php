 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">SK PA</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('skpa/list') ?>">Daftar SK PA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail SK PA</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Detail SKPA</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Detail SK PA</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-2">
                            <a href="<?= site_url('skpa/list') ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> KEMBALI</a>
                          </div>

                          <div class="col-md-8">
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 15%">SK PA</th>
                                <td><?= $skpa['kode_skpa']." / ".$skpa['tahun'] ?></td>

                                <th style="background-color: #eee; width: 15%">Waktu</th>
                                <td><?= indonesian_date($skpa['start'])." s/d ".indonesian_date($skpa['end']) ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <br><br>

                        <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                                    href="#pills-activity" role="tab" aria-controls="pills-activity"
                                    aria-selected="true">
                                    Gelombang
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                                    href="#pills-messages" role="tab" aria-controls="pills-messages"
                                    aria-selected="false">
                                    Mahasiswa
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                aria-labelledby="pills-activity-tab">
                                <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Gelombang</button>
                                <br><br>

                                <div class="table-responsive">
                                  <table class="display table table-hover datatables" >
                                    <thead style="background-color: #eee">
                                      <tr>
                                        <th>Gelombang</th>
                                        <th style="width: 25%">Penentuan Judul</th>
                                        <th style="width: 25%">Sidang Komite</th>
                                        <th style="width: 25%">Seminar</th>
                                        <th>Penerbitan SK PA</th>
                                        <th style="width: 10%" class="text-center"><i class="fa fa-cog"></i></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $n = 0;
                                            foreach ($gelombang as $row) { $n++; ?>

                                              <tr>
                                                <td><?php echo $row['gelombang'] ?></td>
                                                <td>
                                                  <?php echo indonesian_date($row['tanggal_judul_start'])." s/d ".indonesian_date($row['tanggal_judul_end']) ?>
                                                </td>

                                                <td>
                                                  <?php echo indonesian_date($row['tanggal_sidang_start'])." s/d ".indonesian_date($row['tanggal_sidang_end']) ?>
                                                  <br>
                                                  <small>
                                                    <?php echo "Pemberitahuan : ".indonesian_date($row['tanggal_hasil_sidang']) ?>
                                                  </small>

                                                  <?php if($row['notif_to_seminar'] == '0'){ ?>
                                                    <a onclick="return confirm('Apakah anda yakin mengaktifkan pemberitahuan jadwal sidang ?')" href="<?= site_url('set_notif/to/active/'.$row['id']) ?>" class="badge badge-success"><i class="fa fa-bell"></i> Aktifkan Pemberitahuan</a>

                                                  <?php }else{ ?>
                                                    <a href="<?= site_url('set_notif/to/nonactive/'.$row['id']) ?>" class="badge badge-danger"><i class="fa fa-bell"></i> Non-aktifkan Pemberitahuan</a>
                                                  <?php } ?> 

                                                </td>

                                                <td>
                                                  <?php echo indonesian_date($row['tanggal_seminar_start'])." s/d ".indonesian_date($row['tanggal_seminar_end']) ?>
                                                  <br>
                                                  <small>
                                                    <?php echo "Pemberitahuan : ".indonesian_date($row['tanggal_hasil_seminar']) ?>
                                                  </small>

                                                  <?php if($row['notif_result_seminar'] == '0'){ ?>
                                                    <a onclick="return confirm('Apakah anda yakin mengaktifkan pemberitahuan jadwal sidang ?')" href="<?= site_url('set_notif/result/active/'.$row['id']) ?>" class="badge badge-success"><i class="fa fa-bell"></i> Aktifkan Pemberitahuan</a>
                                                  <?php }else{ ?>
                                                    <a href="<?= site_url('set_notif/result/nonactive/'.$row['id']) ?>" class="badge badge-danger"><i class="fa fa-bell"></i> Non-aktifkan Pemberitahuan</a>
                                                  <?php } ?> 

                                                </td>

                                                <td>
                                                  <?php echo indonesian_date($row['tanggal_terbit_skpa']) ?>
                                                </td>

                                                <td class="text-center">
                                                  <?php if($row['is_active'] == '1'){ ?>

                                                    <a data-toggle="tooltip" title="Non-aktifkan Gelombang" onclick="return confirm('Apakah anda yakin menonaktifkan gelombang ini ?')" href="<?= site_url('set_gelombang/deny/'.$skpa['id'].'/'.$row['id']) ?>" class="text-success"><i class="fa fa-check-circle"></i></a>

                                                  <?php }else{ ?>

                                                    <a data-toggle="tooltip" title="Aktifkan Gelombang" onclick="return confirm('Apakah anda yakin mengaktifkan gelombang ini ?')" href="<?= site_url('set_gelombang/approve/'.$skpa['id'].'/'.$row['id']) ?>" class="text-danger"><i class="fa fa-ban"></i></a>

                                                  <?php } ?>
                                                    &nbsp;

                                                    <a data-toggle="tooltip" title="Daftar Kelulusan" href="<?= site_url('get_file/'.$row['id']) ?>" class="text-primary"><i class="fa fa-file"></i></i></a>

                                                    &nbsp;
                                                    <a onclick="edit(
                                                      '<?= $row['id'] ?>',
                                                      '<?= $row['tanggal_judul_start'] ?>',
                                                      '<?= $row['tanggal_judul_end'] ?>',
                                                      '<?= $row['tanggal_sidang_start'] ?>',
                                                      '<?= $row['tanggal_sidang_end'] ?>',
                                                      '<?= $row['tanggal_hasil_sidang'] ?>',
                                                      '<?= $row['tanggal_seminar_start'] ?>',
                                                      '<?= $row['tanggal_seminar_end'] ?>',
                                                      '<?= $row['tanggal_hasil_seminar'] ?>',
                                                      '<?= $row['tanggal_terbit_skpa'] ?>',
                                                      '<?= $row['gelombang'] ?>'
                                                    )" data-toggle="tooltip" title="Ubah" href="javascript:void(0)" class="text-warning"><i class="fa fa-pencil"></i></a>
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

                              <button data-toggle="modal" data-target="#modalTambahMhs" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Pendaftar</button>
                              <br><br>

                              <div class="table-responsive">
                                <table class="display table table-hover datatables" style="width: 100%">
                                  <thead style="background-color: #eee">
                                    <tr>
                                      <th rowspan="2" style="width: 5%">No</th>
                                      <th rowspan="2">Mahasiswa</th>
                                      <th rowspan="2" class="text-center" style="width: 10%">Gelombang</th>
                                      <th colspan="2" class="text-center">Pembimbing</th>
                                      <th rowspan="2" class="text-center" style="width: 20%">Penguji</th>
                                      <th style="width: 5%" rowspan="2" class="text-center"><i class="fa fa-cog"></i></th>
                                    </tr>

                                    <tr>
                                      <th style="width: 20%" class="text-center">1</th>
                                      <th style="width: 20%" class="text-center">2</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $n = 0;
                                      foreach ($skpa_mhs as $row){ $n++; 
                                        $dosen2 = '<center>-</center>';
                                        if($row['nama_dosen2'] != ''){
                                          $dosen2 = $row['nama_dosen2']."<br><small>".$row['kode_dosen2']."</small>";
                                        }

                                        $penguji = '<center><span class="badge badge-info">Belum Ditetapkan</span></center>';
                                        if($row['nama_penguji'] != ''){
                                          $penguji = $row['nama_penguji']."<br><small>".$row['kode_penguji']."</small>";
                                        }
                                    ?>
                                      <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $row['nama_mahasiswa']."<br><small>".$row['nim']."</small>" ?></td>
                                        <td class="text-center"><?= $row['gelombang'] ?></td>
                                        <td><?= $row['nama_dosen1']."<br><small>".$row['kode_dosen1']."</small>" ?></td>
                                        <td><?= $dosen2 ?></td>
                                        <td><?= $penguji ?></td>
                                        <td class="text-center">
                                          <a data-toggle="tooltio" title="Lihat Progress" class="text-primary" href="<?= site_url('skpa/detail/'.$row['skpa_gelombang_id'].'/progress/'.$row['skpa_gelombang_daftar_id']) ?>"><i class="fa fa-eye"></i></a>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
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


<form action="<?php echo site_url('insert_gelombang/'.$skpa['id']) ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="skpa_id" value="<?= $skpa['id'] ?>">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Gelombang</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
               <div class="row">
                <div class="form-group col-md-6">
                   <label>Nama</label><br>
                   <?= $skpa['kode_skpa']." / ".$skpa['tahun'] ?>
                </div>

                <div class="form-group col-md-6">
                   <label>Gelombang</label><br>
                   <?= $next ?>
                   <input type="hidden" name="gelombang" value="<?= $next ?>">
                </div>

                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Penentuan Judul</label>
                   <div class="row">
                     <div class="col-md-6">
                       <label>Mulai</label>
                       <input type="text" name="tanggal_judul_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-6">
                       <label>Selesai</label>
                       <input type="text" name="tanggal_judul_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>

                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Sidang Komite</label>
                   <div class="row">
                     <div class="col-md-4">
                       <label>Mulai</label>
                       <input type="text" name="tanggal_sidang_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Selesai</label>
                       <input type="text" name="tanggal_sidang_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Pemberitahuan</label>
                       <input type="text" name="tanggal_hasil_sidang" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>


                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Seminar</label>
                   <div class="row">
                     <div class="col-md-4">
                       <label>Mulai</label>
                       <input type="text" name="tanggal_seminar_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Selesai</label>
                       <input type="text" name="tanggal_seminar_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Pemberitahuan</label>
                       <input type="text" name="tanggal_hasil_seminar" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>

                <div class="form-group col-md-12">
                   <label>Tanggal Penerbitan SK PA</label>
                   <input type="text" name="tanggal_terbit_skpa" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                </div>

               </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
             </div>

           </div>
        </div>
     </div>
   </form>


<form action="<?php echo site_url('update_gelombang/'.$skpa['id']) ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="skpa_id" value="<?= $skpa['id'] ?>">
    <input type="hidden" id="e_id" name="skpa_gelombang_id">
     <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Gelombang</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
               <div class="row">
                <div class="form-group col-md-6">
                   <label>Nama</label><br>
                   <?= $skpa['kode_skpa']." / ".$skpa['tahun'] ?>
                </div>

                <div class="form-group col-md-6">
                   <label>Gelombang</label><br>
                   <span id="e_gelombang"></span>
                </div>

                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Penentuan Judul</label>
                   <div class="row">
                     <div class="col-md-6">
                       <label>Mulai</label>
                       <input type="text" id="judul_s" name="tanggal_judul_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-6">
                       <label>Selesai</label>
                       <input type="text" id="judul_e" name="tanggal_judul_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>

                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Sidang Komite</label>
                   <div class="row">
                     <div class="col-md-4">
                       <label>Mulai</label>
                       <input type="text" id="sidang_s" name="tanggal_sidang_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Selesai</label>
                       <input type="text" id="sidang_e" name="tanggal_sidang_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Pemberitahuan</label>
                       <input type="text" id="sidang_h" name="tanggal_hasil_sidang" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>


                <div class="form-group col-md-12">
                   <label class="badge badge-light" style="background-color: #eee">Tanggal Seminar</label>
                   <div class="row">
                     <div class="col-md-4">
                       <label>Mulai</label>
                       <input type="text" id="seminar_s" name="tanggal_seminar_start" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Selesai</label>
                       <input type="text" id="seminar_e" name="tanggal_seminar_end" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                     <div class="col-md-4">
                       <label>Pemberitahuan</label>
                       <input type="text" id="seminar_h" name="tanggal_hasil_seminar" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                     </div>
                   </div>
                </div>

                <div class="form-group col-md-12">
                   <label>Tanggal Penerbitan SK PA</label>
                   <input type="text" id="terbit" name="tanggal_terbit_skpa" class="form-control datepicker" placeholder="..." autocomplete="off" required />
                </div>

               </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
             </div>

           </div>
        </div>
     </div>
   </form>


   <form action="<?php echo site_url('insert_partisipan/'.$skpa['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahMhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pendaftar</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
               
                <div class="row">
                  <div class="form-group col-md-4">
                    <label>Gelombang</label>
                    <select class="form-control" required="" name="skpa_gelombang_id">
                      <option value="">Pilih</option>
                      <?php foreach ($gelombang as $row){ ?>
                        <option value="<?= $row['id'] ?>"><?= $row['gelombang'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-8">
                    <label>Mahasiswa</label>
                    <select class="form-control" required="" name="mahasiswa_id">
                      <option value="">Pilih</option>
                      <?php foreach ($mahasiswa as $row){ ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nim'].' / '.$row['nama_mahasiswa'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Pembimbing 1</label>
                    <select class="form-control" required="" id="pbb1" name="pembimbing_1_id">
                      <option value="">Pilih</option>
                      <?php foreach ($dosen as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Pembimbing 2</label>
                    <select class="form-control" disabled="" id="pbb2" name="pembimbing_2_id">
                      <option value="">Harap Pilih Pembimbing 1</option>
                      <?php foreach ($dosen as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
             </div>

           </div>
        </div>
     </div>
   </form>

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