<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="loginBox">
        <h3>Login</h3>
        <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan']  == "gagal") {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= "Login gagal! username atau password salah!" ?>
        </div> 
        <?php
            } else if ($_GET['pesan'] == "logout") {
             ?>
        <div class="alert alert-success" role="alert">
            <?= "Anda telah berhasil logout" ?>
        </div> 
        <?php
            } else if ($_GET['pesan'] == "berhasil") {
             ?>
        <div class="alert alert-success" role="alert">
            <?= "Akun telah tersimpan" ?>
        </div> 
            <?php
            } else if ($_GET['pesan'] == "belum_login") {
             ?>
        <?php
            }
        } ?>
        <form action="session.php" method="post">
            <div class="inputBox"> 
                <input id="username" type="text" name="username" placeholder="Username"> 
                <input id="pass" type="password" name="password" placeholder="Password"> 
            </div> 
            <input type="submit" name="" value="Login">
        </form>
        <div class="text-center">
            <a href="register.php" style="color: #59238F;">Sign-Up</a>
        </div>

    </div>
</body>

</html>