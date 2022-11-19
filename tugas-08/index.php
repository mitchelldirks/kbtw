<?php 
include 'koneksi.php';
include 'function.php';
include 'script.php';
$aksi = 'aksi.php';
?>
<title>List Nilai</title>
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
			<div class="card-header">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalNilai">
					Input Nilai
				</button>
				<div class="modal fade" id="exampleModalNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalNilaiTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form method="POST" action="<?php echo $aksi."?act=save&data=nilai" ?>">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalNilaiTitle">Input Nilai</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php include 'form-nilai.php'; ?>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModalMhs">
					Input Mahasiswa
				</button>

				<div class="modal fade" id="exampleModalMhs" tabindex="-1" role="dialog" aria-labelledby="exampleModalMhsTitle" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form method="POST" action="<?php echo $aksi."?act=save&data=mhs" ?>">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalMhsTitle">Input Mahasiswa</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php include 'form-mhs.php'; ?>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<span class="float-right">
					<button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModalSearch">
						Cetak Laporan
					</button>

					<div class="modal fade" id="exampleModalSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalSearchTitle" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form method="GET" action="cetak.php">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalSearchTitle">Cetak Laporan Nilai</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Mata Kuliah</label>
											<select class="form-control" name="id" required>
												<?php 
												$query = mysqli_query($conn,"SELECT * FROM matkul");
												foreach ($query as $row):
													?>
													<option value="<?php echo $row['id'] ?>"><?php echo $row['kode']." - ".$row['nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Find</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</span>
			</div>
			<div class="card-body">
				<h2>List Mahasiswa</h2>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">NIM</th>
								<th scope="col">Nama</th>
								<th scope="col">Kode Matkul</th>
								<th scope="col">Nama Matkul</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							$query = mysqli_query($conn,"SELECT * from nilai");
							foreach ($query as $row):  
								$mhs = mysqli_fetch_array(mysqli_query($conn,"SELECT * from mhs where nim = '".$row['nim']."'"));
								$matkul = mysqli_fetch_array(mysqli_query($conn,"SELECT * from matkul where id = '".$row['id_matkul']."'"));
								$no++;
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $mhs['nim'] ?></td>
									<td><?php echo $mhs['nama'] ?></td>
									<td><?php echo $matkul['kode'] ?></td>
									<td><?php echo $matkul['nama'] ?></td>
									<td>
										<a class="btn btn-info" href="update.php?id=<?php echo $row['id'] ?>">Update</a>
										<a class="btn btn-outline-danger" href="<?php echo $aksi ?>?act=delete&data=nilai&id=<?php echo $row['id'] ?>" onclick="return confirm('Hapus Data Ini?')">Delete</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
<?php unset($_SESSION['flash']); ?>