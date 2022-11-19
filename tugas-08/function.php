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