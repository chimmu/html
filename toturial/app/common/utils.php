<?php

function curlpost($curl_url, $params, $enc = false) {
	$ch = curl_init();

	//    echo $curl_url . "\n";

	curl_setopt($ch, CURLOPT_URL, $curl_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'X-ptype: like me'
	));
	if (is_array($params)) {
		// 		$data = $enc == false ? $params: myenc($params);
		$postdata = $enc == false ? json_encode($params): myenc(json_encode($params));
	} else {
		$postdata = $enc == false ? $params: myenc($params);
		// 		$postdata = $params;
	}

	//    echo $postdata . "\n";

	if ($enc) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	} else {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	}

	$curl_result = curl_exec($ch);

	//    $date_time = date("Y-m-d-H");
	//    file_put_contents("/data/log/testdispatched.$date_time.log", $curl_result."\n", FILE_APPEND);
	$result = $enc == false ? $curl_result: mydec($curl_result);
	curl_close($ch);
	//    print_r($curl_result);
	return $result;
}
function http_post($url, $params, &$ret, $enc = false) {
	$data = $enc == false ? $params: myenc($params);
	$res = curlpost ( $url, $params, $enc);
	if (!empty($res)) {
		// 		$decstr = $enc == false ? $res : mydec($res);
		$ret = json_decode($res, true);
		return $ret['status'] == 0;
		// 		if ($ret['status'] != 0)
		// 			return false;
		// 		return true;
	}
	return false;
}

function curlget($url, $params) {
	$ch = curl_init();

	$url = $url . "?" . http_build_query($params);

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$output = curl_exec($ch);

	//trace("curl get : " . $output . "params : " . json_encode($params));

	curl_close($ch);

	return $output;
}
