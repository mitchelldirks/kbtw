<?php 
include 'koneksi.php';
include 'script.php';
$aksi = 'aksi.php';
$nilai = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM nilai where id = '".$_GET['id']."'"));
$mhs = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM mhs where nim = '".$nilai['nim']."'"));
$matkul = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM matkul where id = '".$nilai['id_matkul']."'"));
$data = array(
	'id'		=>	$nilai['id'],
	'nim'		=>	$mhs['nim'],
	'id_matkul'	=>	$matkul['id'],
	'tugas'		=>	$nilai['tugas'],
	'uas'		=>	$nilai['uas'],
	'uts'		=>	$nilai['uts'],
);
?>
<title>Update</title>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div>
			<?php 
			if (isset($_SESSION['flash'])): ?>
				<div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show"> 
					<span class="text-white">
						<i class="<?php echo $_SESSION['flash']['icon'] ?>"></i> 
						<?php echo $_SESSION['flash']['label']; ?>  
					</span>
				</div>
			<?php endif ?>
		</div>
		<div class="card">
			<form method="POST" action="<?php echo $aksi."?act=update&data=nilai" ?>">
				<div class="card-header">
					<h2>Update </h2>
				</div>
				<div class="card-body">
					<?php include 'form-nilai.php' ?>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<a href="index.php" class="btn btn-outline-primary">Back</a>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
<?php unset($_SESSION['flash']); ?>
