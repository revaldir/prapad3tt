
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
                        <h5 class="header-title mb-1 mt-0">Laporan SK PA</h5>
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
                                <th>Kode</th>
                                <th>Tahun</th>
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
                                                <td style="width: 15%"><?php echo $row['kode_skpa'] ?></td>
                                                <td><?php echo $row['tahun'] ?></td>
                                                <td><?= indonesian_date($row['start']) ?></td>
                                                <td><?= indonesian_date($row['end']) ?></td>

                                                <td style="width: 15%" class="text-center">
                                                    <a href="<?= site_url('laporan/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Ubah" class="text-primary">
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