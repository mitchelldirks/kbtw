<?php 
// require_once 'function.php';
// $render = $_GET['render'];
$json = file_get_contents('data.json');
$json = json_decode($json,true);
function renderMerk($id=null)
{
	global $json;
	$id = $id == null ? md5(date('YmdHis')) : md5($id);
	$string = '';
	$string .= '<select id="merk_'.$id.'" data-id="'.$id.'" class="form-control custom-select merk" name="merk[]">';
	foreach ($json as $key => $value) {
		$string .= '<option value="'.$key.'">';
		$string .= ucwords($key);
		$string .= '</option>';
	}
	$string .= "</select>";
	return $string;
}
function renderSize($id=null,$merk=null)
{
	global $json;
	if ($id==null) {	
		$id = $id == null ? md5(date('YmdHis')) : md5($id);
		$string = '';
		$string .= '<select id="merk_'.$id.'" data-id="'.$id.'" class="form-control custom-select merk" name="merk[]">';
		foreach ($json as $key => $value) {
			$string .= '<option value="'.$key.'">';
			$string .= ucwords($key);
			$string .= '</option>';
		}
		$string .= "</select>";
		return $string;
	}
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
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
						</tbody>
						<tfoot>
						</tfoot>
					</table>
				</div>			
				<div class="card-footer">
					<a class="btn btn-primary">Cetak</a>
					<a class="btn btn-link">Tambah Item</a>
				</div>			
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>
<script type="text/javascript">
	function addRow() {
		<?php $id = md5(date('YmdHis').rand(0,2111600967)) ?>
		var id = '<?php echo $id ?>'
		var html = '';
		html += '<tr>'
		+ '<td>'
		+ '<?php echo renderMerk($id) ?>'
		+ '</td>'
		+ '<td>'
		+ '<?php echo renderSize($id) ?>'
		+ '</td>'
		+ '<td>'
		+ '<input class="form-control" id="price_' + id + '"  data-id="' + id + '" name="price[]">'
		+ '</td>'

		+ '<td>'
		+ '<input class="form-control" id="discount' + id + '" data-id="' + id + '" name="discount[]">'
		+ '</td>'
		+ '</tr>'
		$('#tbody').append(html);
	}
	$('.merk').on('change', function() {
		var id = $(this).data(id)
		var url = "function.php?render=merk"
		var html = '';
		html += '<?php echo renderSize($id) ?>'
		$('#tbody').append(html);
	});
	addRow()
</script>