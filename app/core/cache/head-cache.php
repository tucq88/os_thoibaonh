<?php

/*
 *		Minh Nhựt
 *		MinhNhut.info
 *		Tạo cache trang web PHP
 */

// Tính toán name cho file cache
$script_name = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $script_name);
$file = $break[count($break) - 1];
$cachefile = 'cached/cache-'.substr_replace($file ,"",-4).'.html';

// thời gian lưu cache tính theo giây, 7200s = 2h
$cachetime = 7200;

// Xuất file cache ra, với 2 điều kiện: có cache và chưa vượt quá cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
	echo "<!-- Cached page khởi tạo lúc ".date('H:i', filemtime($cachefile))." -->\n";
	include($cachefile);
	exit;
}
ob_start(); // Bật buffer cho output
?>