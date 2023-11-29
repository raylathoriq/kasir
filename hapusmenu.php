<?php 
$id_menu = $_GET['id_menu'];

require 'function.php';

    if(hapusMenu($id_menu)){
        echo"
            <script>
            alert('Menu berhasil dihapus');
            document.location.href = 'tambah_menu.php'
            </script>            
            ";
    }

?>