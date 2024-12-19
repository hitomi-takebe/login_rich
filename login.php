<?php
require_once('funcs.php');

//。セッションを使う前にsession_start()を呼び出さないとセッション変数が使えない
session_start();
$email = $_POST['email'];
echo($email);

$db_name = 'yoin_account';
$db_host = 'mysql3104.db.sakura.ne.jp';
$db_id = 'yoin_account';
$db_pw ='deploy_yoin';

// 1.  DB接続します
// try catch構文でデータベースの情報取得を実施
try {
  $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host,$db_id,$db_pw);
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// 指定したハッシュがパスワードにマッチしているかチェック
//$_SESSIONはログイン中のユーザー情報を一時的に保持するために使う変数
//生のパスワードがハッシュ化されたパスワードと一致するかどうかをチェック
$sql = "SELECT * FROM account WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$member = $stmt->fetch();
// //指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['password'], $member['password'])) {
//     //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $msg = 'ログインしました。';
    $link = '<a href="index.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login_form.php">戻る</a>';
    echo $_SESSION['id'];
    echo $_member['id'];
}
// ?>

// <p><?php echo h($_SESSION['name']); ?>さん、こんにちは。</p>
// <h1><?php echo $msg; ?></h1>
// <?php echo $link; ?>

