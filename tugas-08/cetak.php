<?php 
include 'koneksi.php';
include 'function.php';
include 'script.php';
$aksi = 'aksi.php';
?>
<title>Laporan Nilai </title>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="card">
			<div class="card-header">
				<span class="float-right">
					<a class="btn btn-info" onclick="printDiv('print')"><i class="fa fa-print"></i> Print</a>
				</span>
				<h2>Laporan Nilai</h2>
			</div>
			<div class="card-body">
				<div class="table-responsive" id="print">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">NIM</th>
								<th scope="col">Nama</th>
								<th scope="col">Kode Matkul</th>
								<th scope="col">Nama Matkul</th>
								<th scope="col">Tugas</th>
								<th scope="col">UTS</th>
								<th scope="col">UAS</th>
								<th scope="col">Akhir</th>
								<th scope="col">Grade</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							$query = mysqli_query($conn,"SELECT * from nilai where id_matkul = '".$_GET['id']."'");
							foreach ($query as $row):  
								$mhs = mysqli_fetch_array(mysqli_query($conn,"SELECT * from mhs where nim = '".$row['nim']."'"));
								$matkul = mysqli_fetch_array(mysqli_query($conn,"SELECT * from matkul where id = '".$row['id_matkul']."'"));
								$akhir = getNilaiAkhir($row['tugas'], $row['uts'],$row['uas']);
								$grade = getGrade($akhir);
								$no++;
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $mhs['nim'] ?></td>
									<td><?php echo $mhs['nama'] ?></td>
									<td><?php echo $matkul['kode'] ?></td>
									<td><?php echo $matkul['nama'] ?></td>
									<td><?php echo $row['tugas'] ?></td>
									<td><?php echo $row['uts'] ?></td>
									<td><?php echo $row['uas'] ?></td>
									<td><?php echo $akhir ?></td>
									<td><?php echo $grade ?></td>
									
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer">
				<a href="index.php" class="btn btn-outline-primary">Back</a>
			</div>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
<script type="text/javascript">
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>
<?php unset($_SESSION['flash']); ?>
