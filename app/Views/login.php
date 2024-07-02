<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (session()->getFlashdata('msg')) : ?>
        <div><?= session()->getFlashdata('msg') ?></div>
    <?php endif; ?>
    <form action="/auth/loginAuth" method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>

</html>