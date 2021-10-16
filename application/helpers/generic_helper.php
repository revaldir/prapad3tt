<?php
	function toDatatable($data,$totalData){	
		$output = array(
			'draw' => intval($_POST['draw']),
			'recordsTotal' => $totalData,
			'recordsFiltered' => $totalData,
			'data' => $data
		);
		return $output;
	}

	function show_alert($message, $status){
		return '<div class="alert alert-'.$status.' alert-dismissible fade show" role="alert">
					'.$message.'
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>';
	}

	function generateRandom($n){ 
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString; 
	} 


	function indonesian_date($date){
		$bulan = get_monthname(date('m', strtotime($date)));
		$tanggal = date('d', strtotime($date));
		$tahun = date('Y', strtotime($date));

		return $tanggal." ".$bulan." ".$tahun;
	}

	function show_acc($lv){
		$txt = '';

		if($lv == '-1'){
			$txt = "<span class='text-info'><i class='fa fa-clock-o'></i> Menunggu</span>";
		}else if($lv == '1'){
			$txt = "<span class='text-success'><i class='fa fa-check-circle'></i> Diterima</span>";
		}else if($lv == '0'){
			$txt = "<span class='text-danger'><i class='fa fa-minus-circle'></i> Ditolak</span>";
		}

		return $txt;
	}
