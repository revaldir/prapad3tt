  
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berkas Seminar</li>
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
                        <h5 class="header-title mb-1 mt-0">Berkas Seminar</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 13%">NIM</th>
                                <th>Mahasiswa</th>
                                <th style="width: 13%">SK PA</th>
                                <th style="width: 43%">Judul PA</th>
                                <th class="text-center">File</th>
                                <th style="width: 14%">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                    foreach ($list as $row) { $n++; 
                              ?>

                                      <tr>
                                        <td><?php echo $n ?></td>
                                        <td><?= $row['nim'] ?><br><small><?= $row['nama_jurusan'] ?></small></td>
                                        <td>
                                            <?php echo $row['nama_mahasiswa'] ?>
                                        </td>
                                        <td>
                                            <?= $row['tahun']." - Gel. ".$row['gelombang']."<br><small>".$row['kode_skpa']."</small>" ?>
                                        </td>
                                        <td><?= $row['nama_judul'] ?>
                                          <?php if($row['is_acc_2_1'] == '0'){ echo "<br><small>Ket : ".$row['ket_tolak']."</small>"; } ?>
                                        </td>
                                        <td class="text-center">
                                          <?php if($row['file_seminar'] != ''){ ?>
                                            <a href="<?= base_url('assets/file/seminar/'.$row['file_seminar']) ?>" class='btn btn-outline-info btn-sm'><i class='fa fa-file'></i></a>
                                          <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                              if($row['is_acc_2_1'] == '-1'){ 
                                                    if($row['is_berkas_seminar_upload'] == '0'){
                                                      echo "<span class='badge badge-primary'>Menunggu Berkas</span>";
                                                    
                                                    }else{ ?>

                                                      <a data-toggle="tooltip" title="Terima" 
                                                      onclick="konfirmasi(
                                                            '<?= $row['pengajuan_judul_id'] ?>',
                                                            '<?= $row['pembimbing_1_id'] ?>',
                                                            '<?= $row['pembimbing_2_id'] ?>'
                                                          )"
                                                      href="javascript:void(0)" class="btn btn-success btn-sm" oncli><i class="fa fa-check"></i></a> &nbsp;

                                                      <a title="Tolak" href="javascript:void(0)" onclick="approval('<?= $row['pengajuan_judul_id'] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>

                                            <?php
                                                    } 
                                              
                                              }else{
                                                echo show_acc($row['is_acc_2_1']);
                                              }

                                            ?>
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

  <form id="form_konfirmasi" action="<?= site_url('set_approval_berkas_seminar/approve/') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Konfirmasi Berkas</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Dosen Penguji</label>
                    <select class="form-control" required="" id="penguji_id" name="penguji_id">
                      <option value="">Pilih</option>
                      <?php foreach ($dosen as $row){ ?>

                              <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen'] ?></option>
                        
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-md-3">
                   <label>Tanggal Seminar</label>
                   <input type="text" id="tanggal_seminar" name="tanggal_seminar" class="form-control datepicker" placeholder="Tanggal Seminar..." autocomplete="off" required />
                  </div>

                  <div class="col-md-3">
                   <label>Jam</label>
                   <input type="time" id="jam_seminar" name="jam_seminar" class="form-control" placeholder="..." autocomplete="off" required />
                  </div>

                  <div class="col-md-6">
                   <label>Ruangan</label>
                   <input type="text" id="ruangan" name="ruangan" class="form-control" placeholder="Ruangan Seminar..." autocomplete="off" required />
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



 <form id="form_judul" action="<?= site_url('set_approval_berkas_seminar/deny/') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tolak Berkas</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Alasan Penolakan</label>
                    <textarea class="form-control" required="" name="ket_tolak" placeholder="Ketik Alasan..."></textarea>
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
    function approval(judul_id){
        var site_url = "<?= site_url('set_approval_berkas_seminar/deny/') ?>";
        $('#form_judul').attr('action', site_url + judul_id);
        $('#modalTolak').modal('show');
    }

    function konfirmasi(judul_id, dosen1, dosen2){
        var site_url = "<?= site_url('set_approval_berkas_seminar/approve/') ?>";
        $('#form_konfirmasi').attr('action', site_url + judul_id);
        $('#penguji_id').attr('data-dosen-1', dosen1);
        $('#penguji_id').attr('data-dosen-2', dosen2);

        $('#penguji_id option').removeAttr('disabled');
        $('#penguji_id option[value="'+ dosen1 +'"]').attr('disabled', 'disabled');
        $('#penguji_id option[value="'+ dosen2 +'"]').attr('disabled', 'disabled');

        $('#modalKonfirmasi').modal('show');
    }
</script>

<script type="text/javascript">
    $('.datepicker').datepicker({
      dateFormat : "yy-mm-dd",
      minDate : 0
     });
</script>