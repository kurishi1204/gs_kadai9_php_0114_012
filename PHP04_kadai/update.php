<?php
session_start();
require_once('funcs.php');
loginCheck();

//1. POSTデータ取得
$bookname   = $_POST['bookname'];
$content = $_POST['content'];
$id     = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE content SET bookname=:bookname,content=:content WHERE id=:id;');
$stmt->bindValue(':bookname',   $bookname,   PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
