 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request SK PA</li>
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
                        <h5 class="header-title mb-1 mt-0">Request SK PA</h5>
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
                                <th style="width: 13%">NIM</th>
                                <th>Mahasiswa</th>
                                <th style="width: 13%">SK PA</th>
                                <th style="width: 43%">Judul PA</th>
                                <th style="width: 14%">Status</th>
                                <th class="text-center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $n = 0;
                                    foreach ($mahasiswa as $row) { $n++; 
                                        if($row['is_read'] == '0'){
                                            $num = "<span class='badge badge-danger' data-toggle='tooltip' title='Belum Dilihat'>".$n."</span>";
                                        }else{
                                            $num = $n;
                                        }
                              ?>

                                      <tr>
                                        <td><?php echo $num ?></td>
                                        <td><?= $row['nim'] ?><br><small><?= $row['nama_jurusan'] ?></small></td>
                                        <td>
                                            <?php echo $row['nama_mahasiswa'] ?>
                                        </td>
                                        <td>
                                            <?= $row['tahun']." - Gel. ".$row['gelombang']."<br><small>".$row['kode_skpa']."</small>" ?>
                                        </td>
                                        <td><?= $row['nama_judul'] ?></td>
                                        <td>
                                            <?php 

                                            $check = $row['is_acc_1'];
                                            $title = $class = '';

                                            if($check == '-1'){
                                                $title = '<i class="fa fa-clock-o"></i> Menunggu Acc';
                                                $class = 'badge badge-info';

                                            }else if($check == '0'){
                                                $title = '<i class="fa fa-ban"></i> Ditolak';
                                                $class = 'badge badge-danger';

                                            }else if($check == '1'){
                                                $title = '<i class="fa fa-check"></i> Diterima';
                                                $class = 'badge badge-success';
                                            }

                                            echo "<span class='".$class."'>".$title."</span>";

                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="tooltip" title="Lihat Progress" href="<?= site_url('skpa/request/detail/'.$row['pengajuan_judul_id']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-tasks"></i></a>
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
