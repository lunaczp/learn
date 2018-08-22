<?php
require_once __DIR__ .'/aip/AipOcr.php';

$app_info = require "/Users/nuc/tmpDoc/baidupass.php";

// 你的 APPID AK SK
$app_id = $app_info['app_id'];
$app_key = $app_info['app_key'];
$secret_key = $app_info['secret_key'];

$client = new AipOcr($app_id, $app_key, $secret_key);

if (empty($argv[1])) {
	exit("usage: $argv[0] filePath");
}
if (!is_file($argv[1])) {
	exit("$argv[1] is not a file");
}
$image = file_get_contents($argv[1]);

// 如果有可选参数
$options = array();
//$options["language_type"] = "CHN_ENG";
$options["detect_direction"] = "true";
$options["detect_language"] = "true";
$options["probability"] = "true";

// 带参数调用通用文字识别, 图片参数为本地图片
$r = $client->basicGeneral($image, $options);
var_export($r);
