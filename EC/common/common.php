<?php
// namespace tamai\ec_site;

// ディレクトリ・パス //
define("PUBLIC_DIR", dirname(__FILE__). "../");
define("PRIVATE_DIR", dirname(__FILE__). "../");
define("LOG_DIR", PRIVATE_DIR. "../log/");

// すべてのエラー表示 //
error_reporting( E_ALL );
// エラー出力強制
ini_set( 'display_errors', -1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)

// セッション処理 //
session_start();
$_SESSION['token'] = session_id();

// ヘッダー出力 //
header('X-FRAME-OPTIONS: DENY');

function h($value) {
	return htmlspecialchars($value, ENT_QUOTES);
}

// DBコネクションの確立 //
function d(){
    try {
        $pdo = new PDO('mysql:dbname=shop; host=localhost; charset=utf8','root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo '接続に成功しました';
    } catch (PDOException $e) {
        // echo "DB接続エラー：", $e->getMessage;
    }
    return $pdo;
}

// log出力 関数 //
function l($val, $prefix = "debug"){
    // 配列の場合は文字列に変換 //
    $val = is_array($val) ? print_r($val, true) : $val;
    $res = "[". $prefix. "] ". date("Y/m/d H:i:s | "). $val;
    $file = $prefix. "_". date("Ymd"). ".txt";
    // echo LOG_DIR. $file."\n";
    file_put_contents(LOG_DIR. $file, $res. "\r\n", FILE_APPEND);
}
