 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('master_data/fakultas') ?>">Fakultas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Fakultas</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Detail Fakultas</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Detail Fakultas</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-4">
                            <a href="<?= site_url('master_data/fakultas') ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> KEMBALI</a>
                            &nbsp;
                            <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Jurusan</button>
                          </div>

                          <div class="col-md-8">
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 15%">Fakultas</th>
                                <td><?= $fakultas['kode_fakultas']." / ".$fakultas['nama_fakultas'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <br><br>

                        <h5>Daftar Jurusan</h5>
                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <th>Kode</th>
                                <th>Nama Jurusan</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                            foreach ($list_jurusan as $row) { $n++; ?>

                                              <tr>
                                                <td><?php echo $n ?></td>
                                                <td style="width: 15%"><?php echo $row['kode_jurusan'] ?></td>
                                                <td><?php echo $row['nama_jurusan'] ?></td>

                                                <td style="width: 15%" class="text-center">
                                                    <a onclick="return confirm('Apakah anda yakin ?')" href="<?= site_url('delete_fakultas_jurusan/'.$fakultas['id'].'/'.$row['id']) ?>" class="text-danger"><i class="fa fa-times"></i></a>
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


<form action="<?php echo site_url('insert_fakultas_jurusan') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="fakultas_id" value="<?= $fakultas['id'] ?>">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header ">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Jurusan</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
              <div class="form-group">
                   <label>Fakultas</label><br>
                   <?= $fakultas['kode_fakultas']." / ".$fakultas['nama_fakultas'] ?>
                </div>

                <div class="form-group">
                   <label>Jurusan</label>
                   <select required="" name="jurusan_id" class="form-control">
                     <option value="">Pilih</option>
                     <?php foreach ($jurusan as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_jurusan']." / ".$row['nama_jurusan'] ?></option>
                     <?php } ?>
                   </select>
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
