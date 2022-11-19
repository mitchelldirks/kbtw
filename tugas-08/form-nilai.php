<input type="hidden" name="id" value="<?php echo @$data['id'] ?>">
<div class="form-group">
	<label>Mahasiswa</label>
	<select class="form-control" name="nim" required>
		<?php 
		$query = mysqli_query($conn,"SELECT * FROM mhs");
		foreach ($query as $row):
			$selected = @$data['nim'] == $row['nim'] ? " selected ":"";
			?>
			<option value="<?php echo $row['nim'] ?>" <?php echo $selected ?>><?php echo $row['nim']." - ".ucwords($row['nama']) ?></option>
		<?php endforeach; ?>
	</select>
</div>
<div class="form-group">
	<label>Mata Kuliah</label>
	<select class="form-control" name="id_matkul" required>
		<?php 
		$query = mysqli_query($conn,"SELECT * FROM matkul");
		foreach ($query as $row):
			$selected = @$data['id_matkul'] == $row['id'] ? " selected ":"";
			?>
			<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['kode']." - ".$row['nama'] ?></option>
		<?php endforeach; ?>
	</select>
</div>
<div class="form-group">
	<label>Tugas</label>
	<input type="number" class="form-control" name="tugas" required value="<?php echo @$data['tugas'] ?>">
</div>
<div class="form-group">
	<label>UTS</label>
	<input type="number" class="form-control" name="uts" required value="<?php echo @$data['uts'] ?>">
</div>
<div class="form-group">
	<label>UAS</label>
	<input type="number" class="form-control" name="uas" required value="<?php echo @$data['uas'] ?>">
</div>