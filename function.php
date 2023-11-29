<?php
    session_start();
    include 'config/config.php';
    

    

    function tambahMenu($data){
        global $conn;

        $makanan = htmlspecialchars($data['makanan']);
        $harga = htmlspecialchars($data['harga']);
        $foto = upload();

        mysqli_query($conn,"INSERT INTO menu VALUES ('','$makanan','$harga','$foto')");
        return mysqli_affected_rows($conn);
    }
    function upload(){
        $name = $_FILES['foto']['name'];
        $size = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmp_name = $_FILES['foto']['tmp_name'];

        $validExtension = ['png','jpg','jpeg'];
        $fileExtension = pathinfo($name, PATHINFO_EXTENSION);

        if($error === 4){
            echo"
            <script>
            alert('Wajib Upload Foto');
            </script>
            ";
            return false;
        }elseif(!in_array($fileExtension,$validExtension)){
            echo"
            <script>
            alert('Masukkan File Berupa png,jpg,jpeg');
            </script>
            ";
            return false;
        }elseif($size > 100000000){
            echo"<script>
            alert('Maximal File berukuran 10Mb');
            </script>
            ";
            return false;
        }

        $filename = pathinfo($name, PATHINFO_FILENAME) . '_' .uniqid() . '.' . $fileExtension;
        move_uploaded_file($tmp_name,'asset/img_menu/'. $filename);

        return $filename;
    }

    function hapusMenu($id){
        global $conn;

        mysqli_query($conn,"DELETE FROM menu WHERE id_menu = '$id'");
        return mysqli_affected_rows($conn);
    }

    function keranjang($data){
        global $conn;
        
        $id_user = $_SESSION['id'];
        $id = $data['id_menu'];
        // $metode = $data['metode'];
        $harga = $data['harga'];
        $qty = htmlspecialchars($data['qty']);
        $subtotal = $qty * $harga ;


        mysqli_query($conn,"INSERT INTO keranjang VALUES ('','$id','1','$qty','$subtotal','','pesanan')");
        mysqli_query($conn,"INSERT INTO detail VALUES('','$id','$qty','$subtotal','','$id_user','pesanan')");
        return mysqli_affected_rows($conn);
    }

    function hapusKeranjang($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM keranjang WHERE id_keranjang = '$id'");
        return mysqli_affected_rows($conn);
    }

    function bayar($data){
        global $conn;

        $metode = $data['metode'];


        mysqli_query($conn,"INSERT INTO pembayaran VALUES ('','$metode',now())");

        mysqli_query($conn,"DELETE FROM keranjang WHERE status = 'dibayar'");
        
        mysqli_query($conn,"UPDATE keranjang SET status = 'dibayar' WHERE status = 'pesanan'");

    return mysqli_affected_rows($conn);
    }
?>