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
        $sukses_delete = "";
        $sukses_edit ="";


        if (isset($_GET['op'])) {
            $op = $_GET['op'];
        } else {
            $op = '';
        }

        //edit data
        if ($op == 'edit') {
            $id = $_GET['id'];
            $data_edit = " SELECT *FROM daftar WHERE id= '$id'";
            $query = mysqli_query($koneksi, $data_edit);
            $query_edit = mysqli_fetch_array($query);

            $nim = $query_edit['nim'];
            $nama = $query_edit['nama'];
            $alamat = $query_edit['alamat'];
            $fakultas = $query_edit['fakultas'];

            if ($nim == '') {
                $error_input = 'Data Tidak ditemukan';
            }
        }

        //delete data 
        if ($op == 'delete') {
            $id = $_GET['id'];
            $delete_data = "DELETE FROM daftar WHERE id = $id";
            $query_delete = mysqli_query($koneksi, $delete_data);

            if ($query_delete) {
                $sukses_delete = 'Berhasil Menghapus data';
                echo '<script>window.location="index.php"</script>';

            } else {
                $error_input = 'Gagal menghapus Data';
            }
        }

        //create data 
        if (isset($_POST['simpan'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $alamat =   $_POST['alamat'];
            $fakultas = $_POST['fakultas'];

            if ($nim && $nama && $alamat && $fakultas) {

                if ($op == 'edit') {
                    $edit_data = "UPDATE daftar SET nim = '$nim', nama = '$nama', alamat= '$alamat', fakultas='$fakultas' WHERE id = '$id' ";
                    $query_update = mysqli_query($koneksi, $edit_data);
                    if ($query_update) {
                        echo '<script>window.alert("Data Berhasil di Edit")</script>';
                        echo '<script>window.location="index.php"</script>';
                    } else {
                        $error_input = "Gagal Edit data";
                    }
                }
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
                </div>
            </nav>

            <div class="mx-auto">

                <!-------INPUT DATA------->

                <div class="card" style="margin-top: 50px;">
                    <div class="card-header">
                        Create / Edit Data
                    </div>
                    <div class="card-body">
                        <?php

                        if ($error_input) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                Isi Semua Data Terlebih Dulu!
                            </div>
                        <?php
                        }
                        ?>

                        <?php

                        if ($sukses_input) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                Berhasil Menambahkan Data.
                            </div>
                        <?php
                        }
                        ?>
                        <?php

                        if ($sukses_delete) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                Berhasil Menghapus Data.
                            </div>
                        <?php
                           
                        }
                        ?>
                        <?php

                        if ($sukses_edit) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                Data Berhasil di Edit.
                            </div>
                        <?php
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <select id="fakultas" name="fakultas" class="form-control">
                                        <option value="">--Pilih Fakultas--</option>
                                        <option value="saintek" <?php if ($fakultas == "saintek") echo "selected" ?>>Saintek</option>
                                        <option value="soshum" <?php if ($fakultas == "soshum") echo "selected" ?>>SosHum</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                            </div>

                        </form>
                    </div>
                </div>

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
                                    <th scope="col"> PILIHAN </th>
                                </tr>
                            <tbody>
                                <?php


                                //Menampilkan data
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
                                        <td scope="row" style="width: 50px;"><?php echo $fakultas ?></td>
                                        <td scope="row">

                                            <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning" name="edit">Edit</button></a>
                                            <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin Akan Menghapus')"><button type="button" class="btn btn-primary" name="hapus">Hapus</button></a>


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