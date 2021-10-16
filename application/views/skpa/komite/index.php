 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Komite PA</li>
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
                        <h5 class="header-title mb-1 mt-0">Komite PA</h5>
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

                                            if($row['is_acc_2'] == '-1'){ 
												
											?>
	
                                              
												<a href="javascript:void(0)" data-toggle="tooltip" title="Terima" class="btn btn-success"
                                                            onclick="
                                                              terima(
                                                                '<?php echo $row['pengajuan_judul_id'] ?>'
                                                              )">
                                                        <i class="fa fa-check"></i>
                                                 </a>
												 &nbsp;					
												
												<a href="javascript:void(0)" data-toggle="tooltip" title="Tolak" class="btn btn-danger"
                                                            onclick="
                                                              tolak(
                                                                '<?php echo $row['pengajuan_judul_id'] ?>'
                                                              )">
                                                        <i class="fa fa-ban"></i>
                                                 </a>
												

                                            <?php }else{
                                                echo show_acc($row['is_acc_2']);
											?>
												&nbsp;
												<a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                            onclick="
                                                              edit(
                                                                '<?php echo $row['pengajuan_judul_id'] ?>',
                                                                '<?php echo $row['is_acc_2'] ?>',
																'<?php echo $row['catatan'] ?>'
                                                              )">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
												
											<?php
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

<form action="<?= site_url('Skpa/komite_approval') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Catatan</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>
			 <input type="hidden" name="id_judul" id="e_id_tolak">
			 <input type="hidden" name="status" value="deny">
             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Catatan</label>
                    <textarea class="form-control" required="" name="catatan" placeholder="Ketik Catatan..."></textarea>
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
 
 
<form action="<?= site_url('Skpa/komite_approval') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTerima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Catatan</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>
			 <input type="hidden" name="id_judul" id="e_id_terima">
			 <input type="hidden" name="status" value="approve">
             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Catatan</label>
                    <textarea class="form-control" required="" name="catatan" placeholder="Ketik Catatan..."></textarea>
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
   
   <form action="<?= site_url('Skpa/update_komite') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditCatatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i>Ubah Komite PA</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>
			 <input type="hidden" name="id_judul" id="e_id">
			<div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Status</label>
                   <select class="form-control" name="status" id="e_status" required="">
                     <option value="">Pilih</option>
                        <option value="1">Diterima</option>
						<option value="0">Ditolak</option>
                   </select>
                  </div>
                </div>
             </div>
             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Catatan</label>
                    <textarea class="form-control" required="" name="catatan" id="e_catatan"></textarea>
                  </div>
                </div>
             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-edit"></i> Ubah</button>
             </div>

           </div>
        </div>
     </div>
   </form>




<script type="text/javascript">
 function edit(id, is_acc_2,catatan){
  $('#e_id').val(id);
  $('#e_status').val(is_acc_2);
  $('#e_catatan').val(catatan);

  $('#modalEditCatatan').modal('show'); 
}

function tolak(id_tolak){
  $('#e_id_tolak').val(id_tolak);

  $('#modalTolak').modal('show'); 
}

function terima(id_terima){
  $('#e_id_terima').val(id_terima);

  $('#modalTerima').modal('show'); 
}

</script>
   

												
												
