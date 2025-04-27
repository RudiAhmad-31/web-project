<?php

include('koneksi.php');
$data = mysqli_query($koneksi, "SELECT * FROM produk");
$username = "";
$password = "";
$sukses = "";
$error = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $result = mysqli_query($koneksi, "SELECT username FROM akun WHERE username = '$username'");
        if (mysqli_fetch_array($result)) {
            header("location:register.php?pesan=gagal");
        } else {
            $sql1 = "INSERT INTO akun(username,password)
        values ('$username','$password')";
            $q1   = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses   = "Berhasil Registrasi Akun";
                header("location:login.php?pesan=berhasil");
            } else {
                $tidakdisimpan    = "Akun tidak tersimpan";
            }
        }
    } else {
        $error  = "Silakan isi semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="loginBox">
        <h3>Register</h3>
        <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan']  == "gagal") {
            ?> <div class="alert alert-danger" role="alert">
                        <?php echo "Username sudah terpakai"; ?>
                    </div> <?php
                        }
                    }
            ?>
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div> <?php
                        } ?>
        <form action="" method="POST">
            <div class="inputBox"> 
                <input id="username" type="text" name="username" placeholder="Username" value="<?= $username?>"> 
                <input id="pass" type="password" name="password" placeholder="Password" value="<?= $password?>"> 
            </div> 
                <input type="submit" name="submit" value="Register">
        </form>
    </div>
</body>

</html>