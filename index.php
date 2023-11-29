<?php
    include 'function.php';

    $metode = mysqli_query($conn,"SELECT * FROM metode"); 
    $menu = mysqli_query($conn,"SELECT * FROM menu");
    $keranjang = mysqli_query($conn,"SELECT * FROM keranjang JOIN menu USING(id_menu) WHERE status = 'pesanan'");
    $total = mysqli_query($conn,"SELECT  SUM(subtotal) as total FROM keranjang WHERE status = 'pesanan '");
    $subtotal = mysqli_fetch_array($total);


    if(isset($_POST['tambah'])){
        if(keranjang($_POST)){
            echo"
            <script>
            document.location.href = 'index.php';
            </script>
            ";
        }else{
            echo"
            <script>
            alert('gaggal')
            </script>
            ";
        }
    }

    if(isset($_POST['bayar'])){
        if(bayar($_POST)){
            echo"
            <script>
            document.location.href = 'pdf.php';
            </script>
            ";
        }
    }

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
        <div class="row vh-100">
            <div class="col-md-6  border-end border-3 border-dark ">
                <a href="auth/logout.php">Keluar</a>
                <p class="mt-5 fs-3 fw-bold mb-3 ">Menu</p>

                <a href="tambah_menu.php" class="btn btn-primary mb-5">+ Tambah Menu</a>
                <div class="row">
                    <?php foreach($menu as $m):?>
                        <div class="col-md-4">
                                <form action="" method="post">
                                <div class="card border-0 text-center">
                                    <img class="card-img-top" src="asset/img_menu/<?=$m['foto']?>" alt="Title">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $m['nama_makanan']?></h4>
                                        <p class="card-text fs-5">Rp. <?=$m['harga']?></p>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="hidden" name="id_menu" value="<?= $m['id_menu']?>">
                                    <input type="hidden" name = "harga" value="<?= $m['harga']?>">
                                    <input type="number" min = 1 class="form-control" name="qty" placeholder="qty">
                                    <button type="submit" class="btn btn-primary" name="tambah">+</button>
                                </div>
                            </form>
                            </div>
                            <?php endforeach;?>
                        </div>
            </div>
            <div class="col-md-6">
                <p class="mt-5 fs-3 fw-bold">Pesanan</p>
                <table class="table table-borderless ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =1;?>
                        <?php foreach($keranjang as $k):?>
                        <tr class="border-bottom border-dark">
                            <td><?= $i++?></td>
                            <td><?= $k['nama_makanan']?></td>
                            <td><?= $k['qty']?></td>
                            <td>Rp. <?= $k['subtotal']?> <span ><a href="deletepesanan.php?id_pesanan=<?=$k['id_keranjang']?>" class="badge bg-danger ms-3 ">X</a></span></td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td class="fw-bold fs-5">Total</td>
                            <td></td>
                            <td></td>
                            <td class="fw-bold fs-5">Rp.<?=$subtotal['total']?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mt-5 fw-bold fs-3">Pembayaran</p>
                        <div class="metode">
                            <p class="fw-bold">Pilih Metode Pembayaran</p>
                            <form action="" method="post">
                                <?php foreach($metode as $method):?>
                                <input type="radio" class="btn-check" name="metode" id="tunai" value="<?= $method['id_metode']?>  required">
                                <label for="tunai" class="btn 
                                <?= $method['nama_metode'] == 'Tunai' ? 'btn-light':''?>
                                <?= $method['nama_metode'] == 'Gopay' ? 'btn-success':''?>
                                <?= $method['nama_metode'] == 'Dana' ? 'btn-info':''?>
                                <?= $method['nama_metode'] == 'Qris' ? 'btn-danger':''?>"><?= $method['nama_metode']?></label>
                                <?php endforeach;?>
                                <div class="bayar mt-5  ">
                                    
                                    <button class="btn btn-primary" name="bayar" type="submit">Bayar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>