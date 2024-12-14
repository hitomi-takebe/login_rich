<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
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
    <div class="card">
        <span class="card__title">ログイン</span>
        <div class="card__form">
            <form action="login.php" method="post">
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" class="email" name="email" placeholder="Your Email" required>
                <label for="password">パスワード:</label>
                <input type="password" id="password" class="password" name="password" placeholder="Your Password" required>
                <input type="submit" id="submit" class="submit" value="ログイン">
            </form>
            <?php if (!empty($errorMessage)): ?>
                <p class="error"><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
        </div>
        <p class="link"><a href="index.php">新規登録はこちら</a></p>
    </div>
</body>
</html>

<?php
// login.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $errorMessage = '';

    // CSVファイルのパスを指定
    $filePath = 'data/data.csv';

    if (!file_exists($filePath)) {
        $errorMessage = 'データファイルが見つかりません。';
    } else {
        $file = fopen($filePath, 'r');
        $isAuthenticated = false;

        while (($data = fgetcsv($file)) !== false) {
            $csvName = $data[0] ?? '';
            $csvEmail = $data[1] ?? '';
            $csvPass = $data[2] ?? '';

            if ($email === $csvEmail && $password === $csvPass) {
                $isAuthenticated = true;
                break;
            }
        }

        fclose($file);

        if ($isAuthenticated) {
            header('Location: welcome.php'); // ログイン成功後のリダイレクト先
            exit;
        } else {
            $errorMessage = 'メールアドレスまたはパスワードが違います。';
        }
    }
}
?>
