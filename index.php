<?php
session_start();
if(empty($_SESSION['username'])){
    header("location:login.php?pesan=belum_login");
}

include('koneksi.php');
$data = mysqli_query($koneksi, "SELECT * FROM produk");

$nama = "";
$jenis_prod = "";
$produsen = "";
$tgl_prod = "";
$tgl_exp = "";
$sukses = "";
$error = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
    $op = "";
}

if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "DELETE FROM produk WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Data berhasil dihapus";
    } else{
        $error = "Data gagal dihapus";
    }
}

if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM produk WHERE id = $id";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    $jenis_prod = $r1['jenis_prod'];
    $produsen = $r1['produsen'];
    $tgl_prod = $r1['tgl_prod'];
    $tgl_exp = $r1['tgl_exp'];

    if($nama == ''){
        $error = "Data tidak ditemukan";
    }
}

// Untuk Create
if(isset($_POST['simpan'])){ 
    $nama = $_POST['nama'];
    $jenis_prod = $_POST['jenis_prod'];
    $produsen = $_POST['produsen'];
    $tgl_prod = $_POST['tgl_prod'];
    $tgl_exp = $_POST['tgl_exp'];

    if($nama && $jenis_prod && $produsen && $tgl_prod && $tgl_exp){
        if($op == 'edit'){ // untuk update
            $sql1 = "UPDATE produk SET nama = '$nama', jenis_prod = '$jenis_prod', produsen = '$produsen', tgl_prod = '$tgl_prod', tgl_exp = '$tgl_exp' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if($q1){
                $sukses = "Berhasil mengubah data";
            } else {
                $error = "Gagal mengubah data";
            }
        } else {
            $sql1 = "INSERT INTO produk(nama,jenis_prod,produsen,tgl_prod,tgl_exp) values ('$nama','$jenis_prod','$produsen','$tgl_prod','$tgl_exp')";
            $q1 = mysqli_query($koneksi, $sql1);
            if($q1){ // untuk insert
                $sukses = "Berhasil memasukan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
        
    } else {
        $error = "Semua field harus diisi";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Supermarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="index.css">
    </head>

<body>
<div class="container">
<nav>
  <div class="navbar">
    <div class="logo">
      <span class="fas fa-shopping-basket" aria-hidden="true"></span>
      <li class="nama">Halo<?=$_SESSION['username']?></li>
    </div>
    <ul>
      <li><a href="logout.php" class="logout">
        <span class="fas fa-sign-out-alt"></span>
      </a></li>
    </ul>
  </div>
</nav>
    <div class="mx-auto">
        <!-- Untuk Memasukkan Data -->
        <div class="card">
            <h5 class="card-header">Create / Edit Data</h5>
            <div class="card-body">
                <!-- info error -->
                <?php
                if($error){
                    ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error?>
                </div>
                <?php
                    header("refresh:3;url=index.php");
                }
                ?>
                <!-- info sukses -->
                <?php
                if($sukses){
                    ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $sukses?>
                </div>
                <?php
                    header("refresh:3;url=index.php");
                }
                ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_prod" class="col-sm-2 col-form-label">Jenis Produk</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_prod" id="jenis_prod">
                                <option value="">- Pilih Jenis Produk -</option>
                                <option value="makanan" <?php if($jenis_prod == "makanan") echo "selected"?>>Makanan
                                </option>
                                <option value="minuman" <?php if($jenis_prod == "minuman") echo "selected"?>>Minuman
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="produsen" class="col-sm-2 col-form-label">Produsen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="produsen" name="produsen"
                                value="<?php echo $produsen?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_prod" class="col-sm-2 col-form-label">Tanggal Produksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tgl_prod" name="tgl_prod"
                                value="<?php echo $tgl_prod?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_exp" class="col-sm-2 col-form-label">Tanggal Kadaluarsa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tgl_exp" name="tgl_exp"
                                value="<?php echo $tgl_exp?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- Untuk Mengeluarkan Data -->
        <div class="card">
            <h5 class="card-header text-white-bg-secondary">Data Produk Supermarket</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Produk</th>
                            <th scope="col">Produsen</th>
                            <th scope="col">Tanggal Produksi</th>
                            <th scope="col">Tanggal Kadaluarsa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                            $sql2 = "SELECT * FROM produk ORDER BY id desc";
                            $q2 = mysqli_query($koneksi,$sql2);
                            $urut = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id = $r2['id'];
                                $nama = $r2['nama'];
                                $jenis_prod = $r2['jenis_prod'];
                                $tgl_prod = $r2['tgl_prod'];
                                $tgl_exp = $r2['tgl_exp'];

                                ?>
                        <tr>
                            <th scope="row"><?php echo $urut++?></th>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $jenis_prod ?></td>
                            <td scope="row"><?php echo $produsen ?></td>
                            <td scope="row"><?php echo $tgl_prod ?></td>
                            <td scope="row"><?php echo $tgl_exp ?></td>
                            <td scope="row">
                                <a href="index.php?op=edit&id=<?php echo $id?>">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <a href="index.php?op=delete&id=<?php echo $id?>" onclick ="return confirm('Apakah anda yakin untuk delete data?')">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                                
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>