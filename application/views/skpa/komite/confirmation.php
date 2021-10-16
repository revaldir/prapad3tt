 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">SK PA</li>
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
                        <h5 class="header-title mb-1 mt-0">SK PA</h5>
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
                                        <td><?= $row['nama_judul'] ?></td>
                                        <td class="text-center">
                                            <?php 

                                            if($row['is_acc_3'] == '-1'){ ?>

                                                <a href="javascript:void(0)" data-toggle="tooltip" title="Terima" 
                                                 onclick="approval('<?= $row['pengajuan_judul_id'] ?>')"
                                                 class="btn btn-success"><i class="fa fa-check"></i></a> &nbsp;

                                                <a data-toggle="tooltip" title="Tolak" href="<?= site_url('set_approval_confirmation/deny/'.$row['pengajuan_judul_id']) ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger"><i class="fa fa-ban"></i></a>

                                            <?php }else{
                                                if($row['is_revisi'] == '1'){
                                                    echo "<span class='badge badge-warning'>Revisi</span>";
                                                }else{
                                                    echo show_acc($row['is_acc_3']);
                                                }
                                                
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


<form id="form_judul" action="<?= site_url('set_approval_confirmation/approve') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Persetujuan SKPA</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Revisi</label><br>
                    <input type="checkbox" name="is_revisi" value="1"> Persetujuan dengan Revisi
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
        var site_url = "<?= site_url('set_approval_confirmation/approve/') ?>";
        $('#form_judul').attr('action', site_url + judul_id);
        $('#modalKonfirmasi').modal('show');
    }
</script>