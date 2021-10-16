 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Mahaiswa</h4>
        </div>
    </div>
    
    <!-- alerts -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5 class="header-title mb-1 mt-0">Daftar Mahasiswa</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->userdata('alert_message') ?>
                          </div>
                        </div>

                        <button data-toggle="modal" data-target="#modalTambahplg" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Mahasiswa</button>
                        <br><br>

                        <div class="table-responsive">
                          <table class="table datatables">
                            <thead>
                              <tr>
                                <th style="width:5%">No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan / Fakultas</th>
                                <th>Angkatan / Kelas</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php $n = 0; 
                                    foreach ($list as $row) { $n++; ?>

                                      <tr>
                                        <td><?php echo $n ?></td>
                                        <td><?php echo $row['nim']?></td>
                                        <td><?php echo $row['nama_mahasiswa']?></td>
                                        <td><?php echo $row['nama_jurusan']." <br><small> ".$row['nama_fakultas']."</small>"; ?></td>
                                        <td><?= $row['nama_angkatan']." / ".$row['nama_kelas'] ?></td>

                                        <td class="text-center">
                                          <!--<a href="<?= site_url('master_data/mahasiswa/detail/'.$row['id']) ?>" class="text-primary"><i class="fa fa-search"></i></a> -->
                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                  onclick="
                                                    edit(
                                                      '<?php echo $row['id'] ?>',
                                                      '<?php echo $row['nim'] ?>',
                                                      '<?php echo $row['nama_mahasiswa'] ?>',
                                                      '<?php echo $row['jurusan_id']?>',
                                                      '<?php echo $row['angkatan_id']?>',
                                                      '<?php echo $row['kelas_id']?>',
                                                      '<?php echo $row['nama_kelas'] ?>',
                                                      '<?php echo $row['password'] ?>'
                                                    )">
                                              <i class="fa fa-pencil"></i>
                                          </a>
                                          &nbsp;
                                          <a onclick="return confirm('Apakah anda yakin ?')" href="<?php echo site_url('delete_mahasiswa/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

   <form action="<?php echo site_url('insert_mahasiswa') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahplg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tambah mahasiswa</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-12">
                   <label>NIM</label>
                   <input type="text" name="nim" class="form-control" placeholder="NIM" autocomplete="off" required />
                </div>

                <div class="form-group col-md-12">
                   <label>Nama Mahasiswa</label>
                   <input autocomplete="off" type="text" name="nama_mahasiswa" id="nama_plg" class="form-control" placeholder="Nama Mahasiswa" required/>
                </div>

                <div class="form-group col-md-6">
                   <label>Angkatan</label>
                   <select class="form-control" name="angkatan_id" id="angkatan" required="">
                     <option value="">Pilih</option>
                     <?php foreach($angkatan as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_angkatan']." / ".$row['nama_angkatan'] ?></option>
                     <?php } ?>
                   </select>
                </div>

                <div class="form-group col-md-6">
                   <label>Kelas</label>
                   <select class="form-control" name="kelas_id" id="kelas" required="">
                     <option value="">Pilih</option>
                   </select>
                   <small id="ket"></small>
                </div>

                <div class="form-group col-md-12">
                   <label>Jurusan</label>
                   <select class="form-control" readonly="" name="jurusan_id" required="">
                     <?php foreach($jurusan as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_jurusan']." / ".$row['nama_jurusan'] ?></option>
                     <?php } ?>
                   </select>
                </div>

                <div class="form-group col-md-12">
                   <label>Password</label>
                   <input autocomplete="off" type="text" name="password" id="password" class="form-control" placeholder="Password" required/>
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

   <form action="<?php echo site_url('update_mahasiswa') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditTK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Mahasiswa</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_mahasiswa" id="e_id">

             <div class="modal-body">
                  <div class="row">
                <div class="form-group col-md-12">
                   <label>NIM</label>
                   <input type="text" name="nim" class="form-control" placeholder="NIM" id="e_nim" autocomplete="off" required />
                </div>

                <div class="form-group col-md-12">
                   <label>Nama mahasiswa</label>
                   <input autocomplete="off" type="text" name="nama_mahasiswa" id="e_nama" class="form-control" placeholder="Nama Karyawan" required/>
                </div>

                <div class="form-group col-md-6">
                   <label>Angkatan</label>
                   <select class="form-control" name="angkatan_id" id="e_angkatan" required="">
                     <option value="">Pilih</option>
                     <?php foreach($angkatan as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_angkatan']." / ".$row['nama_angkatan'] ?></option>
                     <?php } ?>
                   </select>
                </div>

                <div class="form-group col-md-6">
                   <label>Kelas</label>
                   <select class="form-control" name="kelas_id" id="e_kelas" required="">
                     <option value="">Pilih</option>
                   </select>
                   <small id="e_ket"></small>
                </div>

                <div class="form-group col-md-12">
                   <label>Jurusan</label>
                   <select class="form-control" id="e_jurusan" readonly="" name="jurusan_id" required="">
                     <?php foreach($jurusan as $row) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['kode_jurusan']." / ".$row['nama_jurusan'] ?></option>
                     <?php } ?>
                   </select>
                </div>

                <div class="form-group col-md-12">
                   <label>Password</label>
                   <input autocomplete="off" id="e_pass" type="text" name="password" id="password" class="form-control" placeholder="Password" required/>
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
     function edit(id, nim, nama, jurusan_id, angkatan_id, kelas_id, nama_kelas, pass){
      $('#e_id').val(id);
      $('#e_nim').val(nim);
      $('#e_nama').val(nama);
      $('#e_pass').val(pass);

      $('#e_jurusan option').removeAttr('selected');
      $('#e_jurusan option[value="'+ jurusan_id +'"]').attr('selected', 'selected');

      $('#e_angkatan option').removeAttr('selected');
      $('#e_angkatan option[value="'+ angkatan_id +'"]').attr('selected', 'selected');

      $('#e_kelas').html("<option value='"+ kelas_id +"'>"+ nama_kelas +"</option>");

      $('#modalEditTK').modal('show'); 
   }

   </script>

   <script type="text/javascript">
    $(document).on('change', '#angkatan', function(){
        if($(this).val() == ''){
            $('#kelas').html('<option value="">Pilih Kelas</option>');
        }else{
            $.ajax({
                method : "POST",
                url    : "<?= site_url('get_kelas') ?>",
                dataType : "json",
                data : { angkatan_id : $(this).val() },
                beforeSend : function(){
                    $('#ket').html('<i class="fa fa-spinner fa-spin"></i> Mengambil Data');
                },
                success : function(res){
                    if(res.status){
                        $('#ket').html('');
                        var txt = '<option value="">Pilih Kelas</option>';
                        $.each(res.data, function(index, val){
                            txt += "<option value='"+ val.id +"'>"+ val.nama_kelas +"</option>";
                        });
                        $('#kelas').html(txt);
                    }
                }
            });
        }
    });

    $(document).on('change', '#e_angkatan', function(){
        if($(this).val() == ''){
            $('#kelas').html('<option value="">Pilih Kelas</option>');
        }else{
            $.ajax({
                method : "POST",
                url    : "<?= site_url('get_kelas') ?>",
                dataType : "json",
                data : { angkatan_id : $(this).val() },
                beforeSend : function(){
                    $('#ket').html('<i class="fa fa-spinner fa-spin"></i> Mengambil Data');
                },
                success : function(res){
                    if(res.status){
                        $('#e_ket').html('');
                        var txt = '<option value="">Pilih Kelas</option>';
                        $.each(res.data, function(index, val){
                            txt += "<option value='"+ val.id +"'>"+ val.nama_kelas +"</option>";
                        });
                        $('#e_kelas').html(txt);
                    }
                }
            });
        }
    });
</script>