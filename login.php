<?php
require_once('funcs.php');

//。セッションを使う前にsession_start()を呼び出さないとセッション変数が使えない
session_start();
$email = $_POST['email'];


//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    $msg = $e->getMessage();
}


// 指定したハッシュがパスワードにマッチしているかチェック
//$_SESSIONはログイン中のユーザー情報を一時的に保持するために使う変数
//生のパスワードがハッシュ化されたパスワードと一致するかどうかをチェック
$sql = "SELECT * FROM account WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$member = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['password'], $member['password'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $msg = 'ログインしました。';
    $link = '<a href="index.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login_form.php">戻る</a>';
}
?>

<p><?php echo $_SESSION['name']; ?>さん、こんにちは。</p>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>

