<?php
$render = $_GET['render'];
$json = file_get_contents('data.json');
$json = json_decode($json,true);
function renderMerk($id=null)
{
	global $json;
	$id = $id == null ? md5(date('YmdHis')) : md5($id);
	$string = '';
	$string .= '<select id="'.$id.'" class="form-control custom-select merk" name="merk[]">';
	foreach ($json as $key => $value) {
		$string .= '<option value="'.$key.'">';
		$string .= ucwords($key);
		$string .= '</option>';
	}
	$string .= "</select>";
	return $string;
}
function renderSize($merk)
{
	global $json;
	echo $json;
}
if ($render == 'merk') {
	echo renderMerk();
}
?>