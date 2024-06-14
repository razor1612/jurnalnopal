<?php

require_once 'config.php';

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = '<span style="color: red">Please enter username</span>';
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = '<span style="color: red">Please enter your password</span>';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT username, password FROM login WHERE username = :username";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $hashed_password = $row['password'];
                        if (password_verify($password, $hashed_password)) {

                            session_start();
                            $_SESSION['username'] = $username;

                            header("location: dashboard.php");
                        } else {
                            $password_err = '<span style="color: red">Password anda salah</span>';
                        }
                    }
                } else {
                    $username_err = '<span style="color: red;">anda belum memiliki username</span>';
                }
            } else {
                echo "oops! ada yang salah. harap coba lagi";
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="sign-in/signin.php" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin text-center">
        <form action="login.php" method="post" class="w-100 mx-auto" style="max-width: 330px;">
            <div class="mb-3"></div>
            <h1 class="h5 mb-3 fw-normal">Silakan Login Terlebih Dahulu!</h1>

            <div class="mb-3 form-floating <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control"
                    id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>
                <span class="help-block">
                    <?php echo $username_err; ?>
                </span>
            </div>

            <div class="mb-3 form-floating position-relative <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" value="<?php echo $password; ?>" class="form-control"
                    id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <span class="help-block">
                    <?php echo $password_err; ?>
                </span>
                <svg onclick="togglePasswordVisibility()" id="togglePassword" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" class="bi bi-eye position-absolute"
                    style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;" viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.88 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z" />
                    <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM8 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
                </svg>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

            <div class="mb-3 mt-2">Belum memiliki akun? <a href="register.php"><b>Register</b></a></div>
        </form>
    </main>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('floatingPassword');
            var passwordFieldType = passwordField.getAttribute('type');
            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                document.getElementById('togglePassword').classList.remove('bi-eye');
                document.getElementById('togglePassword').classList.add('bi-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                document.getElementById('togglePassword').classList.remove('bi-eye-slash');
                document.getElementById('togglePassword').classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>