
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pendaftaran SK PA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Pendaftaran SK PA</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Pendaftaran SK PA</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Periode Pendaftaran</button>
                                <br><br>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th style="width: 5%">No</th>
                                <!--<th>Kode</th>-->
                                <th>Tahun Ajaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                            foreach ($list as $row) { $n++; ?>

                                              <tr>
                                                <td><?php echo $n ?></td>
                                                <!--<td style="width: 15%"><?php echo $row['kode_skpa'] ?></td>-->
                                                <td><?php echo $row['tahun'] ?></td>
                                                <td><?= indonesian_date($row['start']) ?></td>
                                                <td><?= indonesian_date($row['end']) ?></td>

                                                <td style="width: 15%" class="text-center">
                                                    <a href="<?= site_url('skpa/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Ubah" class="text-primary">
                                                        <i class="fa fa-search"></i>
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


<form action="<?php echo site_url('insert_skpa') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pendaftaran SK PA</h4>
                <button type="button" class="close text-white pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-6">
                   <label>Kode SK PA</label>
                   <input type="text" value="<?= $kode ?>" readonly name="kode_skpa" id="kode" class="form-control" placeholder="Kode Angkatan" autocomplete="off" required />
                </div>

                <!--<div class="form-group col-md-6">
                   <label>Tahun</label>
                   <select class="form-control" name="tahun" required="">
                    <option value="">Pilih</option>
                     <?php /**for ($i=2020; $i <= (date('Y') + 1) ; $i++) { ?>
                       <option value="<?= $i ?>"><?= $i ?></option>
                     <?php } */?>
                   </select>
                </div>-->
				
				<div class="form-group col-md-6">
                   <label>Tahun Ajaran</label>
				   <input type="text" name="tahun"  class="form-control" placeholder="Tahun Ajaran" autocomplete="off" required />
                </div>

                <div class="form-group col-md-6">
                   <label>Tanggal Mulai</label>
                   <input type="text" name="start" class="form-control datepicker" placeholder="Tanggal Mulai" autocomplete="off" required />
                </div>

                <div class="form-group col-md-6">
                   <label>Tanggal Selesai</label>
                   <input type="text" name="end" class="form-control datepicker" placeholder="Tanggal Selesai" autocomplete="off" required />
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
     $('.datepicker').datepicker({
      dateFormat : "yy-mm-dd"
     });
</script>

<script type="text/javascript">

 function edit(id, kode, nama, id_kategori){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#modalEditAKT').modal('show'); 
}
</script>
