<?php 
$conn = mysqli_connect('localhost','root','','ektp');
//inquiry
$tag = $_GET['tag'];
if (strlen($tag) > 0) {
	$data_to_post = array(
		'tag'=>$tag,
	);
	$url = 'url.disdukcapil.org';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_to_post));
    // curl_setopt($ch, CURLOPT_HEADER, true);     //we want headers
    // curl_setopt($ch, CURLOPT_NOBODY, true);     //we don't need body
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$output = curl_exec($ch);
	curl_close($ch);
	if ($output) {
		echo json_encode(array(
			'response'  => 200,
			'class'     => 'success',
			'title'     => 'SCAN SUKSES',
			'text'      => 'Sukses scan dan anda sudah terdaftar',
			'data'		=> json_decode($output,true),

		));
	}else{
		$sql = "SELECT * from data_warga where tag_rfid = '".$tag."'";
		$query = mysqli_query($conn,$sql);
		$data = mysqli_fetch_array($query);
		if (!empty($data)) {
			$json = json_decode($data['data'],true);
			$cek = mysqli_query($conn,"SELECT * from entrance where tag_rfid = '".$tag."'");
			if (mysqli_num_rows($cek) > 0) {
				$entrance = mysqli_fetch_array($cek);
				echo json_encode(array(
					'response'  => 200,
					'class'     => 'question',
					'title'     => 'Anda telah scan',
					'text'      => 'Waktu tercatat pada '.$entrance['timestamp'].'
					<br> <b>Sukses scan dan anda sudah terdaftar</b> 
					<br> Nama : '.$json['Nama'].'
					<br> NIK : '.$json['NIK'].'
					<br> alamat : '.$json['Alamat'].'
					',
					'data'		=> json_decode($data['data']),
				));
			}else{	
				mysqli_query($conn,"INSERT INTO entrance set 
					timestamp = '".date('Y-m-d H:i:s')."',
					nik = '".$data['nik']."',
					tag_rfid = '".$data['tag_rfid']."'
					");
				echo json_encode(array(
					'response'  => 200,
					'class'     => 'success',
					'title'     => 'SCAN SUKSES',
					'text'      => '
					<b>Sukses scan dan anda sudah terdaftar</b> 
					<br> Nama : '.$json['Nama'].'
					<br> NIK : '.$json['NIK'].'
					<br> alamat : '.$json['Alamat'].'
					',
					'data'		=> json_decode($data['data']),
				));
			}
		}else{
			echo json_encode(array(
				'response'  => 500,
				'class'     => 'error',
				'title'     => 'SCAN GAGAL',
				'text'      => 'Data tidak tersedia atau kendala teknis, silakan scan ulang',
			));
		}
	}
}else{
	echo json_encode(array(
		'response'  => 500,
		'class'     => 'error',
		'title'     => 'SCAN GAGAL',
		'text'      => 'Data tidak tersedia atau kendala teknis, silakan scan ulang',
	));
}
exit;
?>