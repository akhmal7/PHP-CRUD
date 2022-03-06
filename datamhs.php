<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "mhs";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak Dapat Terkoneksi");
}

$nim = "";
$nama = "";
$alamat = "";
$fakultas = "";
$sukses_input = "";
$error_input = "";
                                                    //simpan Data
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat =   $_POST['alamat'];
    $fakultas = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        $data = "INSERT INTO daftar (nim,nama,alamat,fakultas) VALUES('$nim', '$nama', '$alamat', '$fakultas')";
        $data_input = mysqli_query($koneksi, $data);

        if ($data_input) {
            $sukses_input = "Berhasil menambahkan data ";
        } else {
            $error_input = "";
        }
    } else {
        $error_input = "Silahkan masukkan semua data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .mx-auto {
            width: 800px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="datamhs.php">Data Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="mx-auto">

        <!------MENAMPILKAN DATA------->
        <div class="card" style="margin-top: 30px;">
            <div class="card-header text-white bg-secondary">
                Data Mhs
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> NO </th>
                            <th scope="col"> NIM </th>
                            <th scope="col"> NAMA </th>
                            <th scope="col"> ALAMAT </th>
                            <th scope="col"> FAKULTAS </th>
                            
                        </tr>
                    <tbody>
                        <?php

                        $data_mhs = "SELECT *FROM daftar ORDER BY id";
                        $data_query = mysqli_query($koneksi, $data_mhs);
                        $no = 1;
                        while ($jumlah_query = mysqli_fetch_array($data_query)) {

                            $id         = $jumlah_query['id'];
                            $nim        = $jumlah_query['nim'];
                            $nama       = $jumlah_query['nama'];
                            $alamat     = $jumlah_query['alamat'];
                            $fakultas   = $jumlah_query['fakultas'];

                        ?>
                            <tr>
                                <th scope="row"> <?php echo $no++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                
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