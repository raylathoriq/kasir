<?php
    require 'function.php';

    if(isset($_POST['kirim'])){
        if(tambahMenu($_POST)){
            echo"
            <script>
            alert('Menu berhasil ditambahkan');
            document.location.href = 'tambah_menu.php'
            </script>            
            ";
        }
    }

    $menu = mysqli_query($conn,"SELECT * FROM menu");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="index.php">kembali</a>
            <h3 class="text-center mt-5 mb-5">Daftar Menu</h3>
            <div class="col-md-6 ">
                <h5 class="mb-5">Tambah Menu</h5>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="makanan mb-3">
                        <label for="" class="form-label mb-3">Nama Makanan</label>
                        <input type="text" class="form-control w-50" name="makanan">
                    </div>
                    <div class="harga mb-3">
                        <label for="" class="form-label mb-3">Harga</label>
                        <input type="number" class="form-control w-50" name="harga">
                    </div>
                    <div class="foto mb-3">
                        <label for="" class="form-label mb-3">Foto Makanan</label>
                        <input type="file" class="form-control w-50" name="foto">
                    </div>
                    <button type="submit" name="kirim" class="btn btn-primary w-50">Buat Menu</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Makanan</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach($menu as $m):?>
                        <tr>
                            <td><?= $i++?></td>
                            <td><?= $m['nama_makanan']?></td>
                            <td><?= $m['harga']?></td>
                            <td><a href="hapusmenu.php?id_menu=<?=$m['id_menu']?>" onclick="return confirm('ingin hapus?')" class="badge bg-danger">X</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>