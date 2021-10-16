 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fakultas</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Fakultas</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Fakultas</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Fakultas</button>
                                <br><br>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <th>Kode</th>
                                <th>Nama Fakultas</th>
                                <th class="text-center">Total Jurusan</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                            foreach ($list as $row) { $n++; ?>

                                              <tr>
                                                <td><?php echo $n ?></td>
                                                <td style="width: 15%"><?php echo $row['kode_fakultas'] ?></td>
                                                <td><?php echo $row['nama_fakultas'] ?></td>
                                                <td class="text-center"><?php echo $row['total_jurusan'] ?></td>

                                                <td style="width: 15%" class="text-center">
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                            onclick="
                                                              edit(
                                                                '<?php echo $row['id'] ?>',
                                                                '<?php echo $row['kode_fakultas'] ?>',
                                                                '<?php echo $row['nama_fakultas'] ?>'
                                                              )">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="<?= site_url('master_data/fakultas/detail/'.$row['id']) ?>" class="text-primary"><i class="fa fa-search"></i></a>
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


<form action="<?php echo site_url('insert_fakultas') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Fakultas</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Fakultas</label>
                   <input type="text" value="<?= $kode ?>" readonly name="kode_fakultas" id="kode" class="form-control" placeholder="Kode Fakultas" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Fakultas</label>
                   <input autocomplete="off" type="text" name="nama_fakultas" id="nama" class="form-control" placeholder="Nama Fakultas..." required/>
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

   <form action="<?php echo site_url('update_fakultas') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Fakultas</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <input type="hidden" name="id_fakultas" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Fakultas</label>
                   <input type="text" name="kode_fakultas" id="e_kode" class="form-control" placeholder="Kode Fakultas" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Fakultas</label>
                   <input autocomplete="off" type="text" name="nama_fakultas" id="e_nama" class="form-control" placeholder="Nama Fakultas..." required/>
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
 function edit(id, kode, nama, id_kategori){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#modalEditAKT').modal('show'); 
}
</script>