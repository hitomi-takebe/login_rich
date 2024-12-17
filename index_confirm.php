<body>
<?php
// 入力データの取得
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

?>
    <div class="card">
        <span class="card__title">ユーザー登録</span>
        <p class="card__content">完了しました。</p>
        <div class="card__form">
            <p>ユーザー名:<?= $name ?></P>
            <p>メールアドレス:<?= $email ?></P>
            <p>パスワード:<?= $password ?></P>
        </div>
        <!-- hiddenで隠してformを作成し、formの内容はvalueで入力する -->
            <form action="insert.php" method="post">
                <input type="hidden" name="name" value="<?= $name ?>">
                <input type="hidden"  name="email" value="<?= $email ?>">
                <input type="hidden"  name="password" value="<?= $password ?>">
                <input type="submit" value="送信">
            </form>
        <p><a href="index.php">修正する</a></p>
    </div>

</body>
</html>
