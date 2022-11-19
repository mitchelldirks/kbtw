<?php 
include 'koneksi.php';
include 'function.php';
$act = $_GET['act'];
$table = $_GET['data'];

if ($act == 'save') {
	if ($table == 'mhs') {
		$sql = "INSERT INTO ".$table." set 
		nim = '".$_POST['nim']."',
		nama = '".$_POST['nama']."'
		";
	}elseif ($table == 'nilai') {
		$akhir = getNilaiAkhir($_POST['tugas'],$_POST['uts'],$_POST['uas']);
		$grade = getGrade($akhir);
		$sql   = "INSERT INTO ".$table." set 
		nim    = '".$_POST['nim']."',
		id_matkul = '".$_POST['id_matkul']."',
		tugas  = '".$_POST['tugas']."',
		uts    = '".$_POST['uts']."',
		uas    = '".$_POST['uas']."',
		akhir  = '".$akhir."',
		grade  = '".$grade."'
		";
	}
	$query = mysqli_query($conn,$sql);
	$_SESSION['flash']['class']='alert alert-success';
	$_SESSION['flash']['label']='Penambahan Berhasil';
	$_SESSION['flash']['icon']='fa fa-check';
	header('Location: index.php');
}
if ($act == 'update') {
	if ($table == 'nilai') {
		$akhir = getNilaiAkhir($_POST['tugas'],$_POST['uts'],$_POST['uas']);
		$grade = getGrade($akhir);
		$sql 	= "UPDATE ".$table." set 
		nim 	= '".$_POST['nim']."',
		id_matkul = '".$_POST['id_matkul']."',
		tugas 	= '".$_POST['tugas']."',
		uts 	= '".$_POST['uts']."',
		uas 	= '".$_POST['uas']."',
		akhir 	= '".$akhir."',
		grade 	= '".$grade."'
		where id= '".$_POST['id']."'
		";
		$query = mysqli_query($conn,$sql);
		$_SESSION['flash']['class']='alert alert-success';
		$_SESSION['flash']['label']='Pengubahan Berhasil';
		$_SESSION['flash']['icon']='fa fa-check';
		header('Location: update.php?id='.$_POST['id']);
	}
}

if ($act == 'delete') {
	if ($table == 'nilai') {
		$sql 	= "DELETE FROM ".$table."
		where id = '".$_GET['id']."'
		";
		$query = mysqli_query($conn,$sql);
		$_SESSION['flash']['class']='alert alert-danger';
		$_SESSION['flash']['label']='Penghapusan Berhasil';
		$_SESSION['flash']['icon']='fa fa-check';
		header('Location: index.php');
	}
}
?>