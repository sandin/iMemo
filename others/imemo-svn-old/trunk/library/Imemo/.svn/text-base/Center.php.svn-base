<?php

/*
 * imemo_Center
 *
 * @encoding   UTF-8
 * @author     lds <lds2012@gmail.com>
 * @copyright  Copyright (c) 2010 , lds
 * @license    default
 *
 */

/**
 * Description of Center
 *
 * @author lds
 */
class Imemo_Center {

	public function __construct($some) {

	}

	/**
	 * 非正常原因退出程序
	 * 退出后重定向到指定URL
	 *
	 * @param <type> $msg 死亡原因
	 * @param <type> $redirectUrl 重定向URL
	 * @param <type> $secend 倒计时
	 */
	public static function im_die($msg = '', $redirectUrl = '/', $secend = 5) {
		//Imemo_Center::redirectTo($redirectUrl, $msg);
		header("HTTP/1.0 403");
		header('Content-Type: text/html; charset=utf-8');
		echo "<h2>网站出现内部错误，暂时无法访问</h2>";
		echo "<p>$msg</p>";
	}

	public static function redirectTo($url, $msg) {
		header("location: /error.php?msg=$msg");
	}

}
?>
