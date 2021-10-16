
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <div class="container-fluid">
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Laporan SK PA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Detail SK PA</h4>
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
                          <div class="col-md-2">
                            <a href="<?= site_url('skpa/list') ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> KEMBALI</a>
                          </div>

                          <div class="col-md-8">
                            <table class="table">
                              <tr>
                                <th style="background-color: #eee; width: 15%">SK PA</th>
                                <td><?= $skpa['kode_skpa']." / ".$skpa['tahun'] ?></td>

                                <th style="background-color: #eee; width: 15%">Waktu</th>
                                <td><?= indonesian_date($skpa['start'])." s/d ".indonesian_date($skpa['end']) ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <br>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Jumlah Gelombang</span>
                                                <h2 class="mb-0"><?= count($gelombang) ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i data-feather="activity" class="align-self-center icon-dual icon-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Mahasiswa Terdaftar</span>
                                                <h2 class="mb-0"><?= $mhs ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">LULUS</span>
                                                <h2 class="mb-0"><?= $lulus ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i data-feather="check-circle" class="align-self-center icon-dual icon-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">PERSENTASE KELULUSAN</span>
                                                <h2 class="mb-0"><?= round(($lulus / $mhs) * 100, 2) ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i data-feather="percent" class="align-self-center icon-dual icon-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>

                        <hr>

                        <div class="row">
                          <div class="col-md-12">
                            <table class="table datatables">
                              <thead style="background-color: #eee">
                                <tr>
                                  <th>Gelombang</th>
                                  <th>Mahasiswa Terdaftar</th>
                                  <th>Lulus</th>
                                  <th>Persentase</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($per_gelombang as $row){ ?>
                                  <tr>
                                    <td><?= $row['gelombang'] ?></td>
                                    <td><?= $row['num_mhs'] ?></td>
                                    <td><?= $row['num_lulus'] ?></td>
                                    <td>
                                      <?= round(($row['num_lulus'] / $row['num_mhs']) * 100, 2) ?> %
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

</div>