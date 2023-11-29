<?php
    $id_pesanan = $_GET['id_pesanan'];

    require 'function.php';

    if(hapusKeranjang($id_pesanan)){
        echo"
        <script>
            document.location.href = 'index.php'
            </script>            
            ";
        
    }
?>