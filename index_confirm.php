<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
// 入力データの取得
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];

 // 入力データを整形してCSV用の配列にする
$data = [
    'name' => $name,
    'email' => $email,
    'pass' => $pass,
    'submitted_at' => date('Y-m-d H:i:s'), // データが送信された日時を記録
];

// CSVファイルのパスを指定
$filePath = 'data/data.csv';

// データをCSVファイルに追記する
$file = fopen($filePath, 'a'); // 追記モードで開く
fputcsv($file, $data);
fclose($file);

// フォーム送信後のメッセージ
$message = "登録が完了しました！";

?>

<head>
    <meta charset="utf-8">
    <title>POST（受信）</title>
</head>

<body>
    <div class="card">
        <span class="card__title">ユーザー登録</span>
        <p class="card__content">完了しました。</p>
        <div class="card__form">
            <p class="name">ユーザー名:<?= $name ?></P>
            <p class="email">メールアドレス:<?= $email ?></P>
            <p class="password">パスワード:<?= $pass ?></P>
            <p><a href="index.php">戻る</a></p>
        </div>
        <p class="link"><a href="login.php">ログイン画面</a></p>
    </div>

</body>
</html>

