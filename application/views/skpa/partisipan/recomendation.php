 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rekomendasi Judul PA</li>
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
                        <h5 class="header-title mb-1 mt-0">Rekomendasi Judul PA</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahplg" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Rekomendasi</button>
                        <br><br>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <th>Rekomendasi Judul PA</th>
                                <th class="text-center" style="width: 15%">Sudah diambil</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                    foreach ($list as $row) { $n++; 
                              ?>

                                      <tr>
                                        <td><?php echo $n ?></td>
                                        <td><?= $row['nama_rekomendasi'] ?></td>
                                        <td class="text-center">
                                          <a title="Ganti Status" data-toggle="tooltip" onclick="return confirm('Apakah anda yakin ?')" href="<?= site_url('change_rekomendasi/'.$row['id']) ?>">
                                            <?php if($row['is_lock'] == '1'){ ?>
                                              <i data-feather="check-circle" class="text-success"></i>
                                            <?php }else{ ?>
                                              <i data-feather="x-circle" class="text-danger"></i>
                                            <?php } ?>
                                          </a>
                                        </td>
                                        <td class="text-center">

                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                  onclick="
                                                    edit(
                                                      '<?php echo $row['id'] ?>',
                                                      '<?php echo $row['nama_rekomendasi'] ?>'
                                                    )">
                                              <i class="fa fa-pencil"></i>
                                          </a>
                                          &nbsp;

                                          <a onclick="return confirm('Apakah anda yakin ?')" href="<?php echo site_url('delete_rekomendasi/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                          </a>

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


<form action="<?php echo site_url('insert_rekomendasi') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahplg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Rekomendasi Judul Proyek Akhir</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
              <div class="row">

                <div class="form-group col-md-12">
                   <label>Nama Judul Rekomendasi</label>
                   <input type="text" name="nama_rekomendasi" class="form-control" placeholder="Nama Judul" autocomplete="off" required />
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

   <form action="<?php echo site_url('update_rekomendasi') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditTK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Rekomendasi Judul Proyek Akhir</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_rekomendasi" id="e_id">

             <div class="modal-body">
                <div class="row">
                  
                  <div class="form-group col-md-12">
                     <label>Nama Judul Rekomendasi</label>
                     <input type="text" name="nama_rekomendasi" id="e_rekomendasi" class="form-control" placeholder="Nama Judul" autocomplete="off" required />
                  </div>

                </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i> Ubah</button>
             </div>

           </div>
        </div>
     </div>
   </form>

   <script type="text/javascript">
     function edit(id, nama){
      $('#e_id').val(id);
      $('#e_rekomendasi').val(nama);

      $('#modalEditTK').modal('show'); 
   }

   </script>