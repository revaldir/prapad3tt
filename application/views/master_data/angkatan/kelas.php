 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Angkatan</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Angkatan</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Kelas</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <a href="<?= site_url('master_data/angkatan') ?>" class='btn btn-light'><i class="fa fa-chevron-left"></i> Kembali</a>

                            <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Kelas</button>
                          </div>

                          <div class="col-md-8">
                            <table class="table">
                              <tr>
                                <th style="width: 20%; background-color: #eee">Angkatan</th>
                                <td><?= $angkatan['kode_angkatan']." / ".$angkatan['nama_angkatan'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Kelas</th>
                                <th class="text-center" style="width: 10%"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                            foreach ($list as $row) { $n++; ?>

                                              <tr>
                                                <td><?php echo $n ?></td>
                                                <td><?= $row['nama_kelas'] ?></td>
                                                <td style="width: 15%" class="text-center">

                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                            onclick="
                                                              edit(
                                                                '<?php echo $row['id'] ?>',
                                                                '<?php echo $row['nama_kelas'] ?>'
                                                              )">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    &nbsp;

                                                    <a onclick="return confirm('Apakah anda yakin ?')" data-toggle="tooltip" title="Hapus" class="text-danger" href="<?= site_url('delete_kelas/'.$angkatan['id'].'/'.$row['id']) ?>"><i class="fa fa-trash"></i></a>
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


<form action="<?php echo site_url('insert_kelas/'.$angkatan['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Kelas</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">

                <div class="form-group">
                   <label>Nama Kelas</label>
                   <input autocomplete="off" type="text" name="nama_kelas" id="nama" class="form-control" placeholder="Nama Kelas..." required/>
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

   <form action="<?php echo site_url('update_kelas/'.$angkatan['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Kelas</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <input type="hidden" name="id_kelas" id="e_id">

             <div class="modal-body">

                <div class="form-group">
                   <label>Nama Kelas</label>
                   <input autocomplete="off" type="text" name="nama_kelas" id="e_nama" class="form-control" placeholder="Nama Kelas..." required/>
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
  $('#e_nama').val(nama);

  $('#modalEditAKT').modal('show'); 
}
</script>