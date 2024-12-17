<?php
// require_once('funcs.php');

// session_start();
$email = $_POST['email'];

$username = "xxx";
$password = $_POST['password'];

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $dbh->prepare("SELECT * FROM account WHERE email = :email");
$stmt->bindValue(':email', $email);
$member = $stmt->fetch();




// 指定したハッシュがパスワードにマッチしているかチェック
// if (password_verify($_POST['password'], $member['password'])) {
//     //DBのユーザー情報をセッションに保存
//     echo("ログイン");
//     // $_SESSION['id'] = $member['id'];
//     // $_SESSION['name'] = $member['name'];
//     // $msg = 'ログインしました。';
//     // $link = '<a href="index.php">ホーム</a>';
// } else {
//     echo("不明");
//     // $msg = 'メールアドレスもしくはパスワードが間違っています。';
//     // $link = '<a href="login.php">戻る</a>';
// }
?>

