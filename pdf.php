<?php
require 'function.php';

$keranjang = mysqli_query($conn,"SELECT * FROM keranjang JOIN menu USING(id_menu) WHERE status = 'dibayar'");
$subtotal = mysqli_query($conn,"SELECT SUM(subtotal) as total FROM keranjang WHERE status = 'dibayar'");
$total = mysqli_fetch_array($subtotal);

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
        <h4 class="mt-5 mb-5 text-center">Invoice</h4>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                <?php foreach($keranjang as $k):?>
                <tr>
                    <td><?= $i++?></td>
                    <td><?= $k['nama_makanan']?></td>
                    <td><?= $k['qty']?></td>
                    <td><?= $k['subtotal']?></td>
                </tr>
                <?php endforeach;?>
                <tr class="fw-bold fs-5 border-top  border-dark">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td><?= $total['total']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="fs-5 fw-bold">Kasir</td>
                    <td class="fs-5 fw-bold"><?= $_SESSION['nama']?></td>
                </tr>
                
            </tbody>
        </table>

    </div>
    <script>window.print()</script>
</body>
</html>