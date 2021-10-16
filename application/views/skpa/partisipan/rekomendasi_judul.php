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

                        <form method="GET">
                          <div class="row">
                            <div class="col-md-8">
                              <b>Dosen</b>
                              <select class="form-control" name="dosen_id" required="">
                                <option value="">Pilih</option>
                                <?php foreach ($dosen as $row) { ?>
                                  <option <?php if($row['id'] == $this->input->get('dosen_id')){ echo "selected='selected'"; } ?> value="<?= $row['id'] ?>"><?= $row['kode_dosen']." / ".$row['nama_dosen']." - ".$row['bid_keahlian'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <br><button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </form>

                        <?php if($this->input->get('dosen_id')){ ?>

                          <br>
                          <div class="table-responsive">
                            <table class="display table table-hover datatables" >
                              <thead style="background-color: #eee">
                                <tr>
                                  <th style="width: 5%">No</th>
                                  <th>Rekomendasi Judul PA</th>
                                  <th class="text-center" style="width: 15%">Sudah diambil</th>
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
                                              <?php if($row['is_lock'] == '1'){ ?>
                                                <i data-feather="check-circle" class="text-success"></i>
                                              <?php }else{ ?>
                                                <i data-feather="x-circle" class="text-danger"></i>
                                              <?php } ?>
                                          </td>

                                        </tr>

                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        <?php } ?>

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
                
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Dosen</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_dosen" id="e_id">

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