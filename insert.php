<?php
$name = $_POST['name'];
$email = $_POST['email'];
$content = $_POST['password'];
echo $content;

try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}
$stmt = $pdo->prepare("INSERT
                            INTO
                        account(id, name, email,password, date)
                        VALUES(NULL, :name, :email, :content, now())"
                    );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);//PARAM_STRは文字列を指定
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  // ５．index.phpへリダイレクト
    header('Location: index.php');
}
?>