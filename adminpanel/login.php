<?php
    session_start();
    require "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<style>
    .main {
        height: 100vh;
    }

    .login-box {
        width: 400px;
        padding: 20px;

        border-radius: 8px;
        background-color: #fff;
    }
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box shadow p-5">
            <h2 class="text-center">Login</h2>
            <form action="" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>
                <div class="mt-5">
                <button type="submit" class="btn btn-primary w-100" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div class="mt-3" style="width: 400px">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                    
                    if($countdata>0){
                        if(password_verify($password, $data['password'])){
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: index.php');
                        
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                            Tidak ada akun!
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Tidak ada akun!
                        </div>
                        <?php
                    }
                }

            ?>
        </div>

    </div>

</body>
</html>