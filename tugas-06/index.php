<?php 
error_reporting();
$json_file = 'data.json';
$txt_file = 'struk.txt';
$json = file_get_contents($json_file) or die("Unable to open data.json!");
$json = json_decode($json,true);
function land($string,$max=10)
{
	$strlen = strlen($string);
	$leftlength = $max - $strlen;
	$output = $string."";
	for ($i=0; $i < $leftlength; $i++) { 
		$output .= " ";
	}
	return $output;
}
function cetakStruk($data)
{
	global $txt_file;
	$total = 0;
	$file = fopen($txt_file, "w") or die("Unable to open file!");
	fwrite($file,"BL Store \n");
	fwrite($file,"2111600967 - Mitchell Marcel \n");
	fwrite($file,"===============================================================================\n");
	fwrite($file,"| Item       | Size       | Qty        | Price      | Disc       | Subtotal   |\n");
	fwrite($file,"===============================================================================\n");
	for ($i=0; $i < count($data); $i++) {
		$total += $data[$i]['subtotal'];
		$string = "| ".land($data[$i]['merk'])." | ".land($data[$i]['size'])." | ".land($data[$i]['qty'])." | ".land($data[$i]['price'])." | ".land($data[$i]['disc'])." | ".land($data[$i]['subtotal'])." |\n";
		fwrite($file,$string);
	}
	$pajak = (10/100) * $total;
	$bayar = $pajak + $total;
	fwrite($file,"===============================================================================\n");
	fwrite($file,"                                                         Total ".land($total)."\n");
	fwrite($file,"                                                         Pajak ".land($pajak)."\n");
	fwrite($file,"                                                         Bayar ".land($bayar)."\n");
	fwrite($file,"===============================================================================\n");
	fclose($file);
}
if (isset($_POST['submit'])) {
	$count = count($_POST['merk']);
	$data = array();
	for ($i=0; $i < $count; $i++) { 
		$data[$i]['merk'] = ucwords($_POST['merk'][$i]);
		$data[$i]['size'] = (int)$_POST['size'][$i];
		$data[$i]['qty']  = (int)$_POST['qty'][$i];
		$data[$i]['price']= (int)$json[$_POST['merk'][$i]][$_POST['size'][$i]];
		$data[$i]['disc'] = (int)$_POST['disc'][$i];
		$data[$i]['subtotal']= ($data[$i]['price'] * $data[$i]['qty']) - (($data[$i]['disc']/100) * $data[$i]['price']);
	}
	cetakStruk($data);

	//show file on new tab
	echo '<script type="text/javascript" language="Javascript">window.open("'.$txt_file.'");</script>';
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script type="text/javascript">
	function addrow() {
		html = '';
		html += '<tr>'
		+'<td>'
		+'<select class="form-control custom-select" name="merk[]">'
		+'<option value="toshiba">Toshiba</option>'
		+'<option value="samsung">Samsung</option>'
		+'<option value="seagate">Seagate</option>'
		+'</select>'
		+'</td>'
		+'<td>'
		+'<select class="form-control custom-select" name="size[]">'
		+'<option value="1TB">1TB</option>'
		+'<option value="2TB">2TB</option>'
		+'<option value="4TB">4TB</option>'
		+'</select>'
		+'</td>'
		+'<td>'
		+'<input type="number" class="form-control" name="qty[]">'
		+'</td>'
		+'<td>'
		+'<input type="number" class="form-control" name="disc[]" min="0" max="100">'
		+'</td>'
		+'</tr>'
		$('#tbody').append(html)
	}
</script>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form method="POST">
			<div class="card">
				<div class="card-header">
				</div>			
				<div class="card-body">
					<h1>BL Store <img src="img.png" width="70px"> </h1>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">Item</th>
									<th scope="col">Size</th>
									<th scope="col">Qty</th>
									<th scope="col">Disc<sup>(%)</sup></th>
								</tr>
							</thead>
							<tbody id="tbody">
								<tr>
									<td>
										<select class="form-control custom-select" name="merk[]">
											<option value="toshiba">Toshiba</option>
											<option value="samsung">Samsung</option>
											<option value="seagate">Seagate</option>
										</select>
									</td>
									<td>
										<select class="form-control custom-select" name="size[]">
											<option value="1TB">1TB</option>
											<option value="2TB">2TB</option>
											<option value="4TB">4TB</option>
										</select>
									</td>
									<td>
										<input type="number" class="form-control" name="qty[]">
									</td>
									<td>
										<input type="number" class="form-control" name="disc[]" min="0" max="100">
									</td>
								</tr>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>			
					<div class="card-footer">
						<button class="btn btn-primary" name="submit">Cetak</button>
						<a class="btn btn-link" onclick="addrow()">Tambah Baris</a>
					</div>			
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-2"></div>
</div>