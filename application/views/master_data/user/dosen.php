 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dosen</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Dosen</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Dosen</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->userdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahplg" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Dosen</button>
                        <br><br>

                        <div class="table-responsive">
                          <table class="table datatables">
                            <thead>
                              <tr>
                                <th style="width:5%">No</th>
                                <th style="width: 15%">NIP</th>
                                <th style="width: 15%">Kode Dosen</th>
                                <th>Nama</th>
                                <th>Bidang Keahlian</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php $n = 0; 
                                    foreach ($list as $row) { $n++; ?>

                                      <tr>
                                        <td><?php echo $n ?></td>
                                        <td><?php echo $row['nip'] ?></td>
                                        <td><?php echo $row['kode_dosen']?></td>
                                        <td><?php echo $row['nama_dosen']?></td>
                                        <td><?php echo $row['bid_keahlian']?></td>

                                        <td class="text-center">
                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                  onclick="
                                                    edit(
                                                      '<?php echo $row['id'] ?>',
                                                      '<?php echo $row['kode_dosen'] ?>',
                                                      '<?php echo $row['nip'] ?>',
                                                      '<?php echo $row['nama_dosen'] ?>',
                                                      '<?php echo $row['bid_keahlian'] ?>',
                                                      '<?php echo $row['password'] ?>'
                                                    )">
                                              <i class="fa fa-pencil"></i>
                                          </a>
                                          &nbsp;
                                          <a onclick="return confirm('Apakah anda yakin ?')" href="<?php echo site_url('delete_dosen/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

   <form action="<?php echo site_url('insert_dosen') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahplg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Dosen</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-4">
                   <label>Kode Dosen</label>
                   <input type="text" name="kode_dosen" class="form-control" placeholder="Kode Dosen" autocomplete="off" required />
                </div>

                <div class="form-group col-md-8">
                   <label>NIP</label>
                   <input type="text" name="nip" class="form-control" placeholder="NIP" autocomplete="off" required />
                </div>

                <div class="form-group col-md-12">
                   <label>Nama Dosen</label>
                   <input autocomplete="off" type="text" name="nama_dosen" id="nama_plg" class="form-control" placeholder="Nama Dosen" required/>
                </div>

                <div class="form-group col-md-12">
                   <label>Bidang Keahlian</label>
                   <input autocomplete="off" type="text" name="bid_keahlian" class="form-control" placeholder="Bidang Keahlian" required/>
                </div>

                <div class="form-group col-md-12">
                   <label>Password</label>
                   <input autocomplete="off" type="text" name="password" class="form-control" placeholder="Password" required/>
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

   <form action="<?php echo site_url('update_dosen') ?>" method="post" enctype="multipart/form-data">
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
                  <div class="form-group col-md-4">
                     <label>Kode Dosen</label>
                     <input type="text" name="kode_dosen" id="e_kode" class="form-control" placeholder="Kode Dosen" autocomplete="off" required />
                  </div>

                  <div class="form-group col-md-8">
                     <label>NIP</label>
                     <input type="text" name="nip" id="e_nip" class="form-control" placeholder="NIP" autocomplete="off" required />
                  </div>

                  <div class="form-group col-md-12">
                     <label>Nama Dosen</label>
                     <input autocomplete="off" type="text" name="nama_dosen" id="e_nama" class="form-control" placeholder="Nama Dosen" required/>
                  </div>

                  <div class="form-group col-md-12">
                     <label>Bidang Keahlian</label>
                     <input autocomplete="off" type="text" name="bid_keahlian" id="e_keahlian" class="form-control" placeholder="Bidang Keahlian" required/>
                  </div>

                  <div class="form-group col-md-12">
                     <label>Password</label>
                     <input autocomplete="off" type="text" name="password" id="e_pass" class="form-control" placeholder="Password" required/>
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
     function edit(id, kode, nip, nama, bid, pass){
      $('#e_id').val(id);
      $('#e_kode').val(kode);
      $('#e_nip').val(nip);
      $('#e_nama').val(nama);
      $('#e_keahlian').val(bid);
      $('#e_pass').val(pass);

      $('#modalEditTK').modal('show'); 
   }

   </script>