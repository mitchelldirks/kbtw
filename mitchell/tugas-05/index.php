<?php 
function getNilaiAkhir($tugas, $uts, $uas) {
	return (0.3*$tugas) + (0.3*$uts) + (0.4*$uas);
}
function getGrade($nilaiAkhir){
	if($nilaiAkhir >= 90) {
		return "A";
	} else if($nilaiAkhir >= 85 && $nilaiAkhir < 90) {
		return "A-";
	} else if($nilaiAkhir >= 80 && $nilaiAkhir < 85) {
		return "B+";
	} else if($nilaiAkhir >= 75 && $nilaiAkhir < 80) {
		return "B";
	} else if($nilaiAkhir >= 70 && $nilaiAkhir < 75) {
		return "B-";
	} else if($nilaiAkhir >= 65 && $nilaiAkhir < 70) {
		return "C+";
	} else if($nilaiAkhir >= 60 && $nilaiAkhir < 65) {
		return "C";
	} else if($nilaiAkhir >= 50 && $nilaiAkhir < 60) {
		return "C-";
	} else if($nilaiAkhir >= 40 && $nilaiAkhir < 50) {
		return "D";
	} else if($nilaiAkhir >= 0 && $nilaiAkhir < 40) {
		return "T";
	} else {
		return "N/A";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nilai Web Programming</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<form method="POST">
				<input type="hidden" id="count_row" value="1">
				<div class="card mt-4 mb-4">
					<div class="card-header">

						<h3><?php echo isset($_POST['submit']) ? 'Nilai Web Programming' : 'Entry Nilai Web Programming' ?></h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<?php if (isset($_POST['submit'])){ ?>
										<th>No.</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Tugas</th>
										<th>UTS</th>
										<th>UAS</th>
										<th>Akhir</th>
										<th>Grade</th>
									<?php }else{ ?>
										<th>No.</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Tugas</th>
										<th>UTS</th>
										<th>UAS</th>
									<?php } ?>
								</thead>
								<tbody id="tbody">
									<?php if (isset($_POST['submit'])){ 
										$total = 0;
										for ($i=0; $i < count($_POST['nim']); $i++) { 
											$akhir = getNilaiAkhir($_POST['tugas'][$i], $_POST['uts'][$i], $_POST['uas'][$i]);
											$grade = getGrade($akhir);
											$total += $akhir;
											?>
											<tr>
												<td><?php echo ($i+1) ?></td>
												<td><?php echo $_POST['nim'][$i] ?></td>
												<td><?php echo $_POST['nama'][$i] ?></td>
												<td><?php echo $_POST['tugas'][$i] ?></td>
												<td><?php echo $_POST['uts'][$i] ?></td>
												<td><?php echo $_POST['uas'][$i] ?></td>
												<td><?php echo $akhir ?></td>
												<td><?php echo $grade ?></td>
											</tr>
										<?php } ?>
									<?php }else{ ?>
										<tr>
											<td>1</td>
											<td><input type="text" class="form-control" name="nim[]"></td>
											<td><input type="text" class="form-control" name="nama[]"></td>
											<td><input type="number" class="form-control" name="tugas[]"></td>
											<td><input type="number" class="form-control" name="uts[]"></td>
											<td><input type="number" class="form-control" name="uas[]"></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<?php if (isset($_POST['submit'])){ ?>
							<span class="float-right">
								<table border="0">
									<tr>
										<td class="p-1"><h6>Total Nilai Akhir</h6></td>
										<td class="p-1"><h6><b><?php echo $total ?></b></h6></td>
									</tr>
									<tr>
										<td class="p-1"><h6>Rerata Nilai Kelas</h6></td>
										<td class="p-1"><h6><b><?php echo round($total / $i,2) ?></b></h6></td>
									</tr>
								</table>
							</span>
							<a class="btn btn-secondary d-print-none" href="index.php"><i class="fa fa-arrow-left"></i> Kembali</a>
						<?php }else{ ?>
							<span class="float-right">
								<a class="btn btn-link" onclick="addrow()"><i class="fa fa-plus"></i> Tambah data</a>
							</span>
							<span>
								<button type="submit" class="btn btn-primary" name="submit" value="true"><i class="fa fa-print"></i> Cetak</button>
							</span>
						<?php } ?>
					</div>
				</form>
			</div>		
		</div>
		<div class="col-lg-2"></div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function addrow() {
			var count_row = parseInt($('#count_row').val())
			var next = (count_row + 1);
			var html = ''
			html += '<tr>'
			+ '<td>' + next + '</td>'
			+ '<td>' + '<input type="text" class="form-control" name="nim[]">' + '</td>'
			+ '<td>' + '<input type="text" class="form-control" name="nama[]">' + '</td>'
			+ '<td>' + '<input type="number" class="form-control" name="tugas[]">' + '</td>'
			+ '<td>' + '<input type="number" class="form-control" name="uts[]">' + '</td>'
			+ '<td>' + '<input type="number" class="form-control" name="uas[]">' + '</td>'
			+ '</tr>'
			$('#count_row').val(next)
			$('#tbody').append(html)
		}
		<?php if (isset($_POST['submit'])){ ?>
			window.print()
		<?php } ?>
	</script>
</body>
</html>
