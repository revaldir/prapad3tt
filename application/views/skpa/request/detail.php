<?php
    $val   = $skpa['is_acc_1'];
?>



<div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Request SK PA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Judul</li>
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
                        <h5 class="header-title mb-1 mt-0">Detail Pengajuan Judul</h5>
                        <p class="sub-header"></p>

                        <div class="row">
                          <div class="col-md-12">
                            <?php echo $this->session->flashdata('alert_message') ?>
                          </div>
                        </div>

                        <?php 

                            $dosen2 = '-';
                            if($skpa['nama_dosen2'] != ''){
                              $dosen2 = $skpa['nama_dosen2']."<br><small>".$skpa['kode_dosen2']."</small>";
                            }

                            $s_penguji = false;
                            $penguji = '<span class="badge badge-info">Belum Ditetapkan</span>';
                            if($skpa['nama_penguji'] != ''){
                              $penguji = $skpa['nama_penguji']."<br><small>".$skpa['kode_penguji']."</small>";
                              $s_penguji = true;
                            }

                        ?>

                        <div class="row">
                          <div class="col-md-9">
                            <div class="card">
                              <div class="card-header"><h6>Dosen</h6></div>
                              <div class="card-body">
                                <table class="table">
                                  <tr>
                                    <th>Pembimbing 1</th>
                                    <th>Pembimbing 2</th>
                                    <th>Penguji</th>
                                  </tr>

                                  <tr>
                                    <td><?= $skpa['nama_dosen1']." <br><small>".$skpa['kode_dosen1']."</small>" ?></td>
                                    <td><?= $dosen2 ?></td>
                                    <td><?= $penguji ?></td>
                                  </tr>

                                  <tr style="background-color: #eee">
                                      <td colspan="3" class="text-center">
                                        <?php if($val != '-1'){ 

                                            echo "<b>STATUS : ".show_acc($val)."</b>";
                                            if($val == '0'){
                                              echo "<br>".$skpa['ket_tolak'];
                                            }
                                            
                                         }else{ ?>
                                          <a onclick="return confirm('Apakah anda yakin untuk menerima ?')" class="btn btn-success" href="<?= site_url('set_approval/approve/'.$skpa['pengajuan_judul_id']) ?>"><i class="fa fa-check"></i> Terima</a> &emsp;
                                          
                                          <a data-toggle="modal" data-target="#modalTolak" class="btn btn-danger" href="javascript:void(0)"><i class="fa fa-check"></i> Tolak</a>
                                        <?php } ?>
                                      </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="card">
                              <div class="card-header"><h6>SK PA</h6></div>
                              <div class="card-body">
                                <table class="table">
                                  <tr>
                                    <th class="text-center"><?= $skpa['kode_skpa']." / ".$skpa['tahun'] ?></th>
                                  </tr>

                                  <tr>
                                    <td class="text-center"><?= indonesian_date($skpa['start'])." <br>s/d<br> ".indonesian_date($skpa['end']) ?></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>

                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header"><h6>Judul PA</h6></div>
                              <div class="card-body">

                                <div class="table-responsive">
                                  <table class="display table">
                                    <thead style="background-color: #eee">
                                      <tr>
                                        <th>Judul</th>
                                        <th style="width: 13%" class="text-center">File</th>
                                        <th style="width: 17%">Waktu Upload</th>
                                        <th class="text-center">Status ACC Kordinator</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>
                                        <td><?= $skpa['nama_judul'] ?></td>
                                        <td class="text-center"><a href="<?= base_url('assets/file/'.$skpa['file_judul']) ?>" class=""><i class="fa fa-download"></i> Download</a></td>

                                        <td><?= $skpa['waktu_upload'] ?></td>

                                        <td class="text-center">
                                          <?= show_acc($skpa['is_acc_1']) ?><br>
                                          <small><?= $skpa['waktu_acc_1'] ?></small>
                                        </td>

                                      </tr>
                                            
                                    </tbody>
                                  </table>
                                </div>

                                

                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


 <form action="<?= site_url('set_approval/deny/'.$skpa['pengajuan_judul_id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-plus"></i> Tolak Berkas</h4>
                <button type="button" class="close pull-right text-white" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Alasan Penolakan</label>
                    <textarea class="form-control" required="" name="ket_tolak" placeholder="Ketik Alasan..."></textarea>
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
