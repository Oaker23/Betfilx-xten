<?php
error_reporting(0);
 require_once 'config/config.php';
 require_once 'config/config_data.php';

function genTextQR($amount,$ref2)
{
	global $aid, $billerid, $ref1, $currency, $country, $terminalid, $addlenght;

	if (empty($amount) || $ref2 === "UNDEFINED") {
		exit;
	}

	if (strlen(strlen($ref2)) == 1) {
		$ref_count = "0" . strlen($ref2);
	} else {
		$ref_count = strlen($ref2);
	}

	if (strlen(strlen($amount)) == 1) {
		$amount_count = "0" . strlen($amount);
	} else {
		$amount_count = strlen($amount);
	}

	if (strlen(strlen($country)) == 1) {
		$country_count = "0" . strlen($country);
	} else {
		$country_count = strlen($country);
	}

	if (strlen(strlen($currency)) == 1) {
		$currency_count = "0" . strlen($currency);
	} else {
		$currency_count = strlen($currency);
	}

	$text = "00020101021230";
	$referer = "00" . strlen($aid) . $aid . "01" . strlen($billerid) . $billerid . "02" . strlen($ref1) . $ref1 . "03" . $ref_count . strtoupper($ref2);
	$text .= strlen($referer) . $referer;
	$text .= "58" . $country_count . $country . "54" . $amount_count . $amount . "53" . $currency_count . $currency . "62" . $addlenght . "07" . strlen($terminalid) . $terminalid . "6304";
	$text .= crcChecksum($text);
	return $text;
}

function crcChecksum($str)
{
	function charCodeAt($str, $i)
	{
		return ord(substr($str, $i, 1));
	}

	$crc = 0xFFFF;
	$strlen = strlen($str);
	for ($c = 0; $c < $strlen; $c++) {
		$crc ^= charCodeAt($str, $c) << 8;
		for ($i = 0; $i < 8; $i++) {
			if ($crc & 0x8000) {
				$crc = ($crc << 1) ^ 0x1021;
			} else {
				$crc = $crc << 1;
			}
		}
	}
	$hex = $crc & 0xFFFF;
	$hex = dechex($hex);
	$hex = strtoupper($hex);

	return $hex;
}

function GenQR($text)
{
	return 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . $text . '&choe=UTF-8';
}

// echo genTextQR('5.00','yai002');