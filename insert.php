<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password= $_POST['password'];
echo $name;
echo $email;
echo $password;

try {
//   //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}
$stmt = $pdo->prepare("INSERT
                            INTO
                        gs_an_table(id, name, email, password, date)
                        VALUES(NULL, :name, :email, :password, now())"
                    );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);//PARAM_STRは文字列を指定
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

// 3. 実行
$status = $stmt->execute();

// //４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.phpへリダイレクト
    header('Location: index.php');
}
?>