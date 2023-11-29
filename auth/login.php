<?php
session_start();
include '../config/config.php';

    if(isset($_POST['login'])){

        $nama = $_POST['nama'];
        $password = $_POST['password'];


        $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$nama'");

        if(mysqli_num_rows($result) ===1){
            $row = mysqli_fetch_assoc($result);
            if($password == $row['password']){

                $_SESSION['login'] = 'true';
                $_SESSION['nama'] = $row['username'];
                $_SESSION['id'] = $row['id_user'];

                header('location:../index.php');
            }else{
                echo"
                <script>
                alert('password salah')
                document.location.href = 'login.php';
                </script>
                ";
            }
        }else{
            echo"
                <script>
                alert('akun tidak tersedia')
                document.location.href = 'login.php';
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
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid  bg-success vh-100 w-100 d-flex justify-content-center align-items-center">
        <div class="wrapper bg-white rounded p-4" style="width:23rem;">
            <h3 class="text-center mb-5">Login Aplikasi Kasir</h3>
            
                <form action="" method="post">
                    <label for="" class="form label mb-3">Username :</label>
                    <input type="text" class="form-control border border-1 border-dark mb-3" name="nama">
                    <label for="" class="form label mb-3">Password :</label>
                    <input type="password" class="form-control border border-1 border-dark mb-3" name="password">

                    <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
                </form>
            
        </div>
    </div>
</body>
</html>