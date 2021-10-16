 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Pelanggan</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Pelanggan</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->userdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahplg" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Pelanggan</button>
                        <br><br>

                        <div class="table-responsive">
                          <table class="table datatables">
                            <thead>
                              <tr>
                                <th style="width:5%">No</th>
                                <th>Kode</th>
                                <th>No Identitas</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php $n = 0; 
                                    foreach ($list as $row) { $n++; ?>

                                      <tr>
                                        <td><?php echo $n ?></td>
                                        <td><?php echo $row['kode_plg'] ?></td>
                                        <td><?php echo $row['no_identitas'] ?></td>
                                        <td><?php echo $row['nama_plg'] ?></td>
                                        <td><?php echo $row['jenis_kelamin'] ?></td>
                                        <td><?php echo $row['alamat'] ?></td>
                                        <td><?php echo $row['no_telp'] ?></td>
                                        <td><?php echo $row['status'] ?></td>

                                        <td class="text-center">
                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                  onclick="
                                                    edit(
                                                      '<?php echo $row['id'] ?>',
                                                      '<?php echo $row['no_identitas'] ?>',
                                                      '<?php echo $row['kode_plg'] ?>',
                                                      '<?php echo $row['nama_plg'] ?>',
                                                      '<?php echo $row['jenis_kelamin'] ?>',
                                                      '<?php echo $row['alamat'] ?>',
                                                      '<?php echo $row['no_telp']?>',
                                                      '<?= $row['status'] ?>'
                                                    )">
                                              <i class="fa fa-pencil"></i>
                                          </a>
                                          &nbsp;
                                          <a href="<?php echo site_url('delete_pelanggan/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

   <form action="<?php echo site_url('insert_pelanggan') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahplg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Pelanggan</label>
                   <input type="text" name="kode_plg" id="kode_plg" class="form-control" placeholder="Kode Pelanggan" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nomor Identitas</label>
                   <input autocomplete="off" type="text" name="no_identitas" id="nomor_identitas" class="form-control" placeholder="Nomor Identitas" required/>
                </div>

                <div class="form-group">
                   <label>Nama Pelanggan</label>
                   <input autocomplete="off" type="text" name="nama_plg" id="nama_plg" class="form-control" placeholder="Nama Pelanggan" required/>
                </div>

                <div class="form-group">
                   <label>Jenis Kelamin</label>
                   <select class="form-control" name="jenis_kelamin" id="jk">
                      <option value="">Pilih</option>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                   </select>
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required/>
                </div>

                <div class="form-group">
                   <label>No. Telp</label>
                   <input autocomplete="off" type="text" name="no_telp" id="no_telp" class="form-control" placeholder="No Telp" required/>
                </div>

                <div class="form-group">
                   <label>Status</label>
                   <input autocomplete="off" type="text" name="status" class="form-control" placeholder="Status" required/>
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

   <form action="<?php echo site_url('update_pelanggan') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditTK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Pelanggan</h4>
             </div>

             <input type="hidden" name="id_pelanggan"" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Pelanggan</label>
                   <input type="text" name="kode_plg" id="e_kode" class="form-control" placeholder="Kode Pelanggan" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nomor Identitas</label>
                   <input autocomplete="off" type="text" name="no_identitas" id="e_nomor_identitas" class="form-control" placeholder="Nomor Identitas" required/>
                </div>

                <div class="form-group">
                   <label>Nama Pelanggan</label>
                   <input autocomplete="off" type="text" name="nama_plg" id="e_nama" class="form-control" placeholder="Nama Pelanggan" required/>
                </div>

                <div class="form-group">
                   <label>Jenis Kelamin</label>
                   <select class="form-control" name="jenis_kelamin" id="e_jk">
                      <option value="">Pilih</option>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                   </select>
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="e_alamat" class="form-control" placeholder="Alamat" required/>
                </div>

                <div class="form-group">
                   <label>No. Telp</label>
                   <input autocomplete="off" type="text" name="no_telp" id="e_telp" class="form-control" placeholder="No Telp" required/>
                </div>

                <div class="form-group">
                   <label>Status</label>
                   <input autocomplete="off" type="text" name="status" class="form-control" placeholder="Status" id="e_status" required/>
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
     function edit(id, no, kode, nama, jk, alamat, no_telp, status){
      $('#e_id').val(id);
      $('#e_kode').val(kode);
      $('#e_nama').val(nama);
      $('#e_nomor_identitas').val(no);

      $('#e_jk option').removeAttr('selected');
      $('#e_jk option[value="'+jk+'"]').attr('selected','selected');

      $('#e_alamat').val(alamat);
      $('#e_telp').val(no_telp);
      $('#e_status').val(status);

      $('#modalEditTK').modal('show'); 
   }
   </script>