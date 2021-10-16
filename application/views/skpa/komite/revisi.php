 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Revisi SKPA</li>
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
                        <h5 class="header-title mb-1 mt-0">Revisi SK PA</h5>
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
                                          <?php if($row['is_revisi_acc'] == '0'){ echo "<br><small>Ket : ".$row['ket_tolak']."</small>"; } ?>
                                        </td>
                                        <td class="text-center">
                                          <?php if($row['file_revisi'] != ''){ ?>
                                            <a href="<?= base_url('assets/file/revisi/'.$row['file_revisi']) ?>" class='btn btn-outline-info btn-sm'><i class='fa fa-file'></i></a>
                                          <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                              if($row['is_revisi_acc'] == '-1'){ 
                                                    if($row['is_revisi_upload'] == '0'){
                                                      echo "<span class='badge badge-primary'>Menunggu Berkas</span>";
                                                    
                                                    }else{ ?>

                                                      <a data-toggle="tooltip" title="Terima" href="<?= site_url('set_approval_revisi/approve/'.$row['pengajuan_judul_id']) ?>" class="btn btn-success btn-sm" oncli><i class="fa fa-check"></i></a> &nbsp;

                                                      <a title="Tolak" href="javascript:void(0)" onclick="approval('<?= $row['pengajuan_judul_id'] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>

                                            <?php
                                                    } 
                                              
                                              }else{
                                                echo show_acc($row['is_revisi_acc']);
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


 <form id="form_judul" action="<?= site_url('set_approval_revisi/deny/') ?>" method="post" enctype="multipart/form-data">
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
        var site_url = "<?= site_url('set_approval_revisi/deny/') ?>";
        $('#form_judul').attr('action', site_url + judul_id);
        $('#modalTolak').modal('show');
    }
</script>