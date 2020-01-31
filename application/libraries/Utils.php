<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

use Khill\Duration\Duration;

class Utils
{

	public function formatLimit($limit)
	{
		$w = explode('w', $limit);
		if (count($w) > 1) {
			$week = 7 * $w[0];
			$d = explode('d', $w[1]);
			$time = $week + $d[0] . 'd' . $d[1];
		} else {
			$time = $w[0];
		}
		$duration = new Duration($time);
		$explode = explode(':', $duration->formatted());
		return $explode[0];
	}

	function formatDTM($dtm)
	{
		if (substr($dtm, 1, 1) == "d" || substr($dtm, 2, 1) == "d") {
			$day = explode("d", $dtm)[0] . "d";
			$day = str_replace("d", "d ", str_replace("w", "w ", $day));
			$dtm = explode("d", $dtm)[1];
		} elseif (substr($dtm, 1, 1) == "w" && substr($dtm, 3, 1) == "d" || substr($dtm, 2, 1) == "w" && substr($dtm, 4, 1) == "d") {
			$day = explode("d", $dtm)[0] . "d";
			$day = str_replace("d", "d ", str_replace("w", "w ", $day));
			$dtm = explode("d", $dtm)[1];
		} elseif (substr($dtm, 1, 1) == "w" || substr($dtm, 2, 1) == "w") {
			$day = explode("w", $dtm)[0] . "w";
			$day = str_replace("d", "d ", str_replace("w", "w ", $day));
			$dtm = explode("w", $dtm)[1];
		}

		// secs
		if (strlen($dtm) == "2" && substr($dtm, -1) == "s") {
			$format = $day . " 00:00:0" . substr($dtm, 0, -1);
		} elseif (strlen($dtm) == "3" && substr($dtm, -1) == "s") {
			$format = $day . " 00:00:" . substr($dtm, 0, -1);
			//minutes
		} elseif (strlen($dtm) == "2" && substr($dtm, -1) == "m") {
			$format = $day . " 00:0" . substr($dtm, 0, -1) . ":00";
		} elseif (strlen($dtm) == "3" && substr($dtm, -1) == "m") {
			$format = $day . " 00:" . substr($dtm, 0, -1) . ":00";
			//hours
		} elseif (strlen($dtm) == "2" && substr($dtm, -1) == "h") {
			$format = $day . " 0" . substr($dtm, 0, -1) . ":00:00";
		} elseif (strlen($dtm) == "3" && substr($dtm, -1) == "h") {
			$format = $day . " " . substr($dtm, 0, -1) . ":00:00";

			//minutes -secs
		} elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "m") {
			$format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1);
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "m") {
			$format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1);
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "m") {
			$format = $day . " " . "00:" . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1);
		} elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "m") {
			$format = $day . " " . "00:" . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1);

			//hours -secs
		} elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":00:0" . substr($dtm, 2, -1);
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":00:" . substr($dtm, 2, -1);
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":00:0" . substr($dtm, 3, -1);
		} elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":00:" . substr($dtm, 3, -1);

			//hours -secs
		} elseif (strlen($dtm) == "4" && substr($dtm, -1) == "m" && substr($dtm, 1, -2) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1) . ":00";
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 1, -3) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1) . ":00";
		} elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 2, -2) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1) . ":00";
		} elseif (strlen($dtm) == "6" && substr($dtm, -1) == "m" && substr($dtm, 2, -3) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1) . ":00";

			//hours minutes secs
		} elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 3, -2) == "m" && substr($dtm, 1, -4) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -3) . ":0" . substr($dtm, 4, -1);
		} elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 3, -3) == "m" && substr($dtm, 1, -5) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -4) . ":" . substr($dtm, 4, -1);
		} elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 1, -5) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -3) . ":0" . substr($dtm, 5, -1);
		} elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 1, -6) == "h") {
			$format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -4) . ":" . substr($dtm, 5, -1);
		} elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 2, -4) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -3) . ":0" . substr($dtm, 5, -1);
		} elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 2, -5) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -4) . ":" . substr($dtm, 5, -1);
		} elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 5, -2) == "m" && substr($dtm, 2, -5) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -3) . ":0" . substr($dtm, 6, -1);
		} elseif (strlen($dtm) == "9" && substr($dtm, -1) == "s" && substr($dtm, 5, -3) == "m" && substr($dtm, 2, -6) == "h") {
			$format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -4) . ":" . substr($dtm, 6, -1);
		} else {
			$format = $dtm;
		}
		return $format;
	}

	function formatBytes($size, $decimals = 0)
	{
		$unit = array(
			'0' => 'Byte',
			'1' => 'KiB',
			'2' => 'MiB',
			'3' => 'GiB',
			'4' => 'TiB',
			'5' => 'PiB',
			'6' => 'EiB',
			'7' => 'ZiB',
			'8' => 'YiB'
		);

		for ($i = 0; $size >= 1024 && $i <= count($unit); $i++) {
			$size = $size / 1024;
		}

		return round($size, $decimals) . ' ' . $unit[$i];
	}

	// function  format bytes2
	function formatBytes2($size, $decimals = 0)
	{
		$unit = array(
			'0' => 'Byte',
			'1' => 'KB',
			'2' => 'MB',
			'3' => 'GB',
			'4' => 'TB',
			'5' => 'PB',
			'6' => 'EB',
			'7' => 'ZB',
			'8' => 'YB'
		);

		for ($i = 0; $size >= 1000 && $i <= count($unit); $i++) {
			$size = $size / 1000;
		}

		return round($size, $decimals) . '' . $unit[$i];
	}


	// function  format bites
	function formatBites($size, $decimals = 0)
	{
		$unit = array(
			'0' => 'bps',
			'1' => 'kbps',
			'2' => 'Mbps',
			'3' => 'Gbps',
			'4' => 'Tbps',
			'5' => 'Pbps',
			'6' => 'Ebps',
			'7' => 'Zbps',
			'8' => 'Ybps'
		);

		for ($i = 0; $size >= 1000 && $i <= count($unit); $i++) {
			$size = $size / 1000;
		}

		return round($size, $decimals) . ' ' . $unit[$i];
	}

	function getTime($waktu_mt, $satuan = 'm')
	{
		//..reset isi.begin
		$i = 0;

		$s = 0;
		$m = 0;
		$h = 0;
		$d = 0;
		$w = 0;

		$rs = "";
		$rm = "";
		$rh = "";
		$rd = "";
		$rw = "";

		$awal = "";
		//..reset isi.end
		$result = 0;
		$awal = $waktu_mt;
		//..pisah waktu.begin
		$pow = strpos($awal, 'w');
		$pod = strpos($awal, 'd');
		$poh = strpos($awal, 'h');
		$pom = strpos($awal, 'm');
		$pos = strpos($awal, 's');

		//.ambil minggu
		if ($pow > 0) {
			$aw = preg_match('/(.*?)w/', $awal, $row);
			$w = $row[1];
			if ($w == "") {
				$w = 0;
			}
		}

		//.ambil hari
		if ($pod > 0) {
			if ($pow > 0) {
				$ad = preg_match('/w(.*?)d/', $awal, $row);
				$d = $row[1];
			} else {
				$ad = preg_match('/(.*?)d/', $awal, $row);
				$d = $row[1];
			}
		}

		//.ambil jam
		if ($poh > 0) {
			if ($pod > 0) {
				$ah = preg_match('/d(.*?)h/', $awal, $row);
				$h = $row[1];
			} else if ($pow > 0) {
				$ah = preg_match('/w(.*?)h/', $awal, $row);
				$h = $row[1];
			} else {
				$ah = preg_match('/(.*?)h/', $awal, $row);
				$h = $row[1];
			}
		}

		//.ambil menit
		if ($pom > 0) {
			if ($poh > 0) {
				$am = preg_match('/h(.*?)m/', $awal, $row);
				$m = $row[1];
			} else if ($pod > 0) {
				$am = preg_match('/d(.*?)m/', $awal, $row);
				$m = $row[1];
			} else if ($pow > 0) {
				$am = preg_match('/w(.*?)m/', $awal, $row);
				$m = $row[1];
			} else {
				$am = preg_match('/(.*?)m/', $awal, $row);
				$m = $row[1];
			}
		}

		//.ambil detik
		if ($pos > 0) {
			if ($pom > 0) {
				$as = preg_match('/m(.*?)s/', $awal, $row);
				$s = $row[1];
			} else if ($poh > 0) {
				$as = preg_match('/h(.*?)s/', $awal, $row);
				$s = $row[1];
			} else if ($pod > 0) {
				$as = preg_match('/d(.*?)s/', $awal, $row);
				$s = $row[1];
			} else if ($pow > 0) {
				$as = preg_match('/w(.*?)s/', $awal, $row);
				$s = $row[1];
			} else {
				$as = preg_match('/(.*?)s/', $awal, $row);
				$s = $row[1];
			}
		}

		//..jadikan semuanya menit.begin
		$tw = 0;
		if ($w > 0) {
			$tw = $w; //ambil minggu
		}

		$td = 0;
		if ($tw > 0) {
			$td = $d + ($tw * 7); //1 minggu 7 hari
		} else {
			$td = $d;
		}

		$th = 0;
		if ($td > 0) {
			$th = $h + ($td * 24); //1 hari 24 jam
		} else {
			$th = $h;
		}

		$tm = 0;
		if ($th > 0) {
			$tm = $m + ($th * 60); //1 jam 60 menit
		} else {
			$tm = $m;
		}

		$ts = 0;
		if ($tm > 0) {
			$ts = $s + ($tm * 60); //1 jam 60 menit
		} else {
			$ts = $s;
		}
		//..jadikan semuanya menit.end
		/*
				  //.logika keterlibatan (show/hide).begin
				  $rw = "";
				  if($w > 0){
				  $rw = $w."w";
				  }
		
				  $rd = "";
				  if($d > 0){
				  $rd = $d."d";
				  }
		
				  $rh = "";
				  if($h > 0){
				  $rh = $h."h";
				  }
		
				  $rm = "";
				  if($m > 0){
				  $rm = $m."m";
				  }
		
				  $rs = "";
				  if($s > 0){
				  $rs = $s."s";
				  }
				  //.logika keterlibatan (show/hide).end
		
				  $result = $rw.$rd.$rh.$rm.$rs;
				  $result .= "|";
				 */
		$result = $tm;
		if ($satuan == 'w') {
			$result = $tw;
		} else if ($satuan == 'd') {
			$result = $td;
		} else if ($satuan == 'h') {
			$result = $th;
		} else if ($satuan == 'm') {
			$result = $tm;
		} else if ($satuan == 's') {
			$result = $ts;
		}
		return $result;
		//..pisah waktu.end
	}
}
