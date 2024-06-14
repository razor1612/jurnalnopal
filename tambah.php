<?php

require_once 'config.php';
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$tanggal = $kategori = $instruksi = $deskripsi = $target = $status = "";
$tanggal_err = $kategori_err = $instruksi_err = $deskripsi_err = $target_err = $status_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $input_tanggal = trim($_POST["tanggal"]);
    if (empty($input_tanggal)) {
        $tanggal_err = '<span style="color: red;">Silakan masukkan tanggal</span>';
    } else {
        $tanggal = $input_tanggal;
    }

    $input_kategori = trim($_POST["kategori"]);
    if (empty($input_kategori)) {
        $kategori_err = '<span style="color: red;">Silakan masukkan kategori</span>';
    } else {
        $kategori = $input_kategori;
    }

    $input_instruksi = trim($_POST["instruksi"]);
    if (empty($input_instruksi)) {
        $instruksi_err = '<span style="color: red;">Silakan masukkan instruksi</span>';
    } else {
        $instruksi = $input_instruksi;
    }

    $input_deskripsi = trim($_POST["deskripsi"]);
    if (empty($input_deskripsi)) {
        $deskripsi_err = '<span style="color: red;">Silakan masukkan deskripsi</span>';
    } else {
        $deskripsi = $input_deskripsi;
    }

    $input_target = trim($_POST["target"]);
    if (empty($input_target)) {
        $target_err = '<span style="color: red;">Silakan masukkan target</span>';
    } else {
        $target = $input_target;
    }

    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
        $status_err = '<span style="color: red;">Silakan masukkan status</span>';
    } else {
        $status = $input_status;
    }

    if (empty($tanggal_err) && empty($kategori_err) && empty($instruksi_err) && empty($deskripsi_err) && empty($target_err) && empty($status_err)) {
        $sql = "INSERT INTO users (tanggal, kategori, instruksi, deskripsi, target, status) VALUES (:tanggal, :kategori, :instruksi, :deskripsi, :target, :status)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':tanggal', $param_tanggal);
            $stmt->bindParam(':kategori', $param_kategori);
            $stmt->bindParam(':instruksi', $param_instruksi);
            $stmt->bindParam(':deskripsi', $param_deskripsi);
            $stmt->bindParam(':target', $param_target);
            $stmt->bindParam(':status', $param_status);

            $param_tanggal = $tanggal;
            $param_kategori = $kategori;
            $param_instruksi = $instruksi;
            $param_deskripsi = $deskripsi;
            $param_target = $target;
            $param_status = $status;

            if ($stmt->execute()) {
                header("location: dashboard.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later";
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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MYJOURNAL</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .expanded-input {
            width: 50%;
            height: 50px;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8" />
                    <path
                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                    <path
                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                </svg>
                <div class="sidebar-brand-text mx-3">MYJOURNAL</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    <div class="container">
                        <h3>Tambah</h3>
                        <div class="card shadow mb-4 p-5">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Tanggal</b></label><br>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="<?php echo $tanggal; ?>">
                                    <span class="help-block"><?php echo $tanggal_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Kategori</b></label><br>
                                    <select class="form-control" type="text" name="kategori">
                                        <option> </option>
                                        <option>Webinar</option>
                                        <option>Penilaian</option>
                                        <option>Website</option>
                                    </select>
                                </div>

                                <div class="form-group <?php echo (!empty($instruksi_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Instruksi</b></label><br>
                                    <input type="text" name="instruksi" class="form-control"
                                        value="<?php echo $instruksi; ?>">
                                    <span class="help-block"><?php echo $instruksi_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($deskripsi_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Deskripsi</b></label><br>
                                    <input type="text" name="deskripsi" class="form-control"
                                        value="<?php echo $deskripsi; ?>">
                                    <span class="help-block"><?php echo $deskripsi_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($target_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Target</b></label><br>
                                    <input type="text" name="target" class="form-control"
                                        value="<?php echo $target; ?>">
                                    <span class="help-block"><?php echo $target_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                                    <label><b>Status</b></label><br>
                                    <select class="form-control" type="text" name="status">
                                        <option> </option>
                                        <option>Tercapai</option>
                                        <option>Tidak Tercapai</option>
                                    </select>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>