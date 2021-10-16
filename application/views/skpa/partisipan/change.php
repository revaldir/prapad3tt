 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajukan Pembimbing<li>
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
                        <h5 class="header-title mb-1 mt-0">Ajukan Pembimbing</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <?php 

                        $current = [];
                        $pbb_1 = $pbb_2 = true;
                        $tmp = [];

                          if($judul['is_acc_1'] == '0'){
                            $pbb_1 = false;
                          }

                          if($gelombang['pembimbing_2_id'] != '' && $judul['is_acc_2'] == '0'){
                            $pbb_2 = false;
                          }

                          if(!$pbb_1){
                            $tmp[] = $gelombang['pembimbing_1_id'];
                            $current[] = [
                                'id'   => $gelombang['pembimbing_1_id'],
                                'kode' => $gelombang['kode_dosen1'],
                                'nama' => $gelombang['nama_dosen1'],
                                'status' => 'Pembimbing 1',
                                'judul_id' => $judul['pengajuan_judul_id']
                            ];
                          }

                          if(!$pbb_2){
                            $tmp[] = $judul['kode_dosen2'];
                            $current[] = [
                                'id'   => $gelombang['pembimbing_2_id'],
                                'kode' => $gelombang['kode_dosen2'],
                                'nama' => $gelombang['nama_dosen2'],
                                'status' => 'Pembimbing 2',
                                'judul_id' => $judul['pengajuan_judul_id']
                            ];
                          }
                        ?>

                        <div class="table-responsive">
                          <table class="display table table-hover datatables" >
                            <thead style="background-color: #eee">
                              <tr>
                                <th>Dosen Saat Ini</th>
                                <th>Dosen Pengganti</th>
                                <th>File Pendukung</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 10%"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($change as $row){ ?>
                                    <tr>
                                         <td><?= $row['nama_dosen_prev']."<br><small>".$row['kode_dosen_prev']."</small>" ?></td>
                                         
                                         <?php if($row['kode_dosen_next'] == ''){ ?>
                                            <td colspan="4"><span class="badge badge-info"> Belum Diajukan</span></td>
                                         
                                         <?php }else{ ?>

                                            <td>
                                                 <?php echo $row['nama_dosen_next']."<br><small>".$row['kode_dosen_next']."</small>"; ?>
                                             </td>
                                             <td class="text-center"><a href="<?= base_url('assets/file/'.$row['file_pendukung']) ?>" class=""><i class="fa fa-download"></i> Download</a></td>

                                             <td><?= $row['keterangan_request'] ?></td>

                                             <td><?= show_acc($row['is_acc']) ?></td>

                                         <?php } ?>
                                         
                                         <td>
                                            <?php if(($row['dosen_next_id'] == '' && $row['is_acc'] == '-1') || ($row['dosen_next_id'] != '' && $row['is_acc'] == '0')){ ?>
                                                <button onclick="
                                                ajukan('<?= $row['change_id'] ?>', '<?= $row['kode_dosen_prev']." - ".$row['nama_dosen_prev'] ?>')
                                            " class="btn btn-primary">Ajukan</button>
                                            <?php } ?>
                                            
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


<form action="<?php echo site_url('change_dosen') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalGantiDosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Dosen
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <input type="hidden" name="change_id" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Dosen Saat Ini</label><br>
                   <span id="current_dosen"></span>
                </div>

                <div class="form-group">
                   <label>Dosen Pengganti</label>
                   <select class="form-control" required="" name="dosen_id">
                       <option value="">Pilih</option>
                       <?php foreach ($dosen as $row){ 
                           if(!in_array($row['id'], $tmp)){
                       ?>
                                <option value="<?= $row['id'] ?>"><?= $row['kode_dosen']." - ".$row['nama_dosen'] ?></option>
                       <?php
                           }
                       } ?>
                   </select>
                </div>

                <div class="form-group">
                  <label>Berkas File</label><br>
                  <input type="file" class="btn btn-light" name="file_judul" required="">
                </div>

                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" required="" name="keterangan" placeholder="Keterangan..."></textarea>
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
     function ajukan(id, dosen){
      $('#e_id').val(id);
      $('#current_dosen').text(dosen);

      $('#modalGantiDosen').modal('show'); 
    }
    </script>