<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
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
                        <h3>Jurnal</h3>
                        <div class="d-inline-flex px-2 btn btn-primary">
                            <a href="tambah.php" class="d-inline-flex px-2 btn btn-primary">
                                Tambah
                            </a>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0">Table Jurnal</h3>
                            <form action="" method="post" class="form-inline">
                                <div class="input-group">
                                    <input name="cari" type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button name="search" class="btn btn-danger" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>

                        <div class="col-md-12 table-responsive">
                            <?php
                            require_once 'config.php';

                            if (isset($_POST['search'])) {
                                $cari = $_POST['cari'];
                                $sql = "SELECT * FROM users WHERE tanggal LIKE '%$cari%'";
                            } else {
                                $sql = "SELECT * FROM users ORDER BY tanggal DESC, id ASC";
                            }

                            $distinctTanggalQuery = "SELECT DISTINCT tanggal FROM users";
                            $distinctTanggalResult = $pdo->query($distinctTanggalQuery);
                            $tanggalButtons = [];

                            while ($distinctTanggalRow = $distinctTanggalResult->fetch(PDO::FETCH_ASSOC)) {
                                $tanggalButtons[$distinctTanggalRow['tanggal']] = true;
                            }

                            $nourut = 0;

                            $nourut++;

                            if ($result = $pdo->query($sql)) {
                                if ($result->rowCount() > 0) {

                                    echo "<table class='table table-bordered table-striped table-hover'>";

                                    echo "<thead class=thead-dark>";
                                    echo "<tr class='able-info'>";
                                    echo "<th>#</th>";
                                    echo "<th>Tanggal</th>";
                                    echo "<th>Jam</th>";
                                    echo "<th>Kategori</th>";
                                    echo "<th>Instruksi</th>";
                                    echo "<th>Deskripsi</th>";
                                    echo "<th>Target</th>";
                                    echo "<th>Status</th>";
                                    echo "<th>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    $currentTanggal = null;

                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        if ($currentTanggal != $row['tanggal']) {
                                            echo "<tr><td colspan='10' class='font-weight-bold'>$row[tanggal]</td></tr>";
                                            $currentTanggal = $row['tanggal'];
                                        }

                                        echo "<tr>";
                                        echo "<td>" . $nourut++ . "</td>";
                                        echo "<td>" . $row['tanggal'] . "</td>";
                                        echo "<td>" . date('H:i:s', strtotime($row['create_at'])) . "</td>";
                                        echo "<td>" . $row['kategori'] . "</td>";
                                        echo "<td>" . $row['instruksi'] . "</td>";
                                        echo "<td>" . $row['deskripsi'] . "</td>";
                                        echo "<td>" . $row['target'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>";

                                        echo "<div class='d-flex'>";
                                        echo "<form action='update.php' method='get'>";
                                        echo "  <input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<button type='submit' class='btn btn-primary mr-1' title='Update Record'>";
                                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>";
                                        echo "<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>";
                                        echo "<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>";
                                        echo "</svg>";
                                        echo "</button>";
                                        echo "</form>";

                                        echo "<form action='delete.php' method='get'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<button type='submit' class='btn btn-danger' title='Delete Record'>";
                                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>";
                                        echo "<path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>";
                                        echo "</svg>";
                                        echo "</button>";
                                        echo "</form>";

                                        echo "</td>";
                                        echo "</tr>";
                                    }

                                    echo "</tbody>";
                                    echo "</table>";

                                    unset($result);
                                } else {
                                    echo "<p class='lead'>Masih belum ada jurnal</p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $sql";
                                print_r($pdo->errorInfo());
                            }

                            unset($pdo);
                            ?>
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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin Mau Keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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