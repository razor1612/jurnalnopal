<?php
require_once 'config.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username']))) {
        $username_err = '<span style="color: red">Masukkan Username</span>';
    } else {
        $sql = "SELECT id FROM login WHERE username = :username";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST['username']);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = '<span style="color: red">Username Ini Telah Diisi</span>';
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Oops! Ada yang salah. Harap coba kembali";
            }
        }
        unset($stmt);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = '<span style="color: red">Masukkan Password</span>';
    } else if (strlen(trim($_POST['password'])) < 4) {
        $password_err = '<span style="color: red">Password Minimal 4 Karakter</span>';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = '<span style="color: red">Konfirmasi Password</span>';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = '<span style="color: red">Password Tidak Cocok</span>';
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO login (username, password) VALUES (:username, :password)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if ($stmt->execute()) {
                header("location: login.php");
            } else {
                echo "Ada yang salah. Harap coba lagi nanti";
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="w-100 mx-auto"
            style="max-width: 330px;">
            <h1 class="h4 mb-3 fw-normal">Silakan Daftar</h1>

            <div class="mb-3 form-floating <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control"
                    placeholder="Username">
                <label>Username</label>
                <span class="help-block">
                    <?php echo $username_err; ?>
                </span>
            </div>

            <div class="mb-3 form-floating <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"
                    placeholder="Password">
                <label>Password</label>
                <span class="help-block">
                    <?php echo $password_err; ?>
                </span>
            </div>

            <div class="mb-3 form-floating <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" class="form-control"
                    value="<?php echo $confirm_password; ?>" placeholder="Konfirmasi Password">
                <label>Konfirmasi Password</label>
                <span class="help-block">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar</button>
        </form>
    </main>
</body>

</html>