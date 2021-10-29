<div class="container-fluid">
	<div class="row page-title">
		<div class="col-md-12">
			<h4 class="mb-1 mt-0">Backup</h4>
		</div>
	</div>

	<!-- alerts -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div>
						<h5 class="header-title mb-1 mt-0">Backup Berkas</h5>
						<p class="sub-header"></p>

						<div class="row">
							<div class="col-md-12">
								<?php echo $this->session->flashdata('alert_message') ?>
							</div>
						</div>

						<form action="<?php echo site_url('backup_berkas') ?>" method="post" enctype="multipart/form-data" id="form-backup-berkas" onSubmit="return confirm('Apakah anda yakin?')">
							<div class="row">
								<div class="form-group col-md-6">
									<label>Periode SKPA</label>
									<select class="form-control" name="skpa_id" id="skpa" required="">
										<option value="">Pilih</option>
										<?php foreach ($list as $row) { ?>
											<option value="<?= $row['id'] ?>"><?= $row['kode_skpa'] . " (" . $row['tahun'] . ")" ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group col-md-6">
									<label>Gelombang</label>
									<select class="form-control" name="gelombang" id="gelombang" required="">
										<option value="">Pilih</option>
									</select>
									<small id="ket"></small>
								</div>
							</div>
							<div id="help"></div>
							<button type="submit" id="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-cloud-download"></i> Backup</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).on('change', '#skpa', function() {
		if ($(this).val() == '') {
			$('#gelombang').html('<option value="">Pilih Gelombang</option>');
		} else {
			$.ajax({
				method: "POST",
				url: "<?= site_url('get_gelombang') ?>",
				dataType: "json",
				data: {
					angkatan_id: $(this).val()
				},
				beforeSend: function() {
					$('#ket').html('<i class="fa fa-spinner fa-spin"></i> Mengambil Data');
				},
				success: function(res) {
					if (res.status) {
						$('#ket').html('');
						var txt = '<option value="">Pilih Gelombang</option>';
						$.each(res.data, function(index, val) {
							txt += "<option value='" + val.id + "' data-backup='" + val.is_backed_up + "'>" + val.gelombang + "</option>";
						});
						$('#gelombang').html(txt);
					}
				}
			});
		}
	});

	$(document).on('change', '#gelombang', function() {
		if ($(this).children(':selected').data('backup')) {
			$('#help').html("<div class='alert alert-warning' role='alert'> Berkas pada gelombang ini telah di-backup! </div>")
			$('#submit').attr('disabled', true)
		} else {
			$('#help').html('')
			$('#submit').attr('disabled', false)
		}
	})
</script>
