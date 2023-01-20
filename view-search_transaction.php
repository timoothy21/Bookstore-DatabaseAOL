<?php 
// Include config file
require_once "config.php";
session_start();

$id_trx = $id_trx_err = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="source/style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        /* .wrapper_search{
            width: 650px;
            margin: 0 auto;
        } */
        .page-header h2{
            margin-top: 0;
        }
        .col-md-12 h1{
            font-size: 24px;
            margin-bottom: 20px;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        textarea.form-control{
            height: 35px;
            width: 500px;
            display: inline-block;
        }
        label{
            display: block;
        }
        input{
            margin-top: -28px;
        }
        th#none{
            /* display: none; */
        }
        .table-container {
            overflow-x:scroll;
            height: 60vh;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper_search">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Search Transaction</h2>
                        <div class="menu_header">
                        <a href="profile.php" class="btn btn-profile" id="btn-profile">My Profile</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="index.php" class="btn btn-warning" id="btn_menu">Dashboard</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="transaction.php" class="btn btn-primary" id="btn_transaction">Add Transaction</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="search.php" class="btn btn-info" id="btn_search">Search Buku</a>
                            <a href="create.php" class="btn btn-success">Tambah Buku Baru</a>
                        </div>
                    </div>
                    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Selamat Datang.</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($id_trx_err)) ? 'has-error' : ''; ?>">
                            <label>Search by ID Trx, ID Staff, ID Buku, Nama Pembeli</label>
                            <textarea name="id_trx" class="form-control"><?php echo $id_trx; ?></textarea>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <!-- <input type="submit" class="btn btn-primary" value="Reset"> -->
                    </form>

                    <div class="table-container">
                        <?php
                            if(isset($_POST["id_trx"])) {
                                $id_trx = $_POST["id_trx"];
                                $query = $query = "SELECT * FROM transaction WHERE id_trx like '%".$id_trx."%' OR id_user like '%".$id_trx."%' OR id_buku like '%".$id_trx."%' OR name_customer like '%".$id_trx."%' ORDER BY id_trx ASC";
                            } else {
                                //jika tidak ada pencarian, default yang dijalankan query ini
                                $query = "SELECT * FROM transaction ORDER BY id_trx ASC";
                            }

                            $result = mysqli_query($link, $query);
            
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th colspan='2'>#</th>";
                                        // echo "<th>ID</th>";
                                        echo "<th>ID Transaksi</th>";
                                        echo "<th>ID Staff</th>";
                                        echo "<th>ID Buku</th>";
                                        echo "<th>Jumlah Buku</th>";
                                        echo "<th>Nama Pembeli</th>";
                                        echo "<th>Tanggal Transaksi</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                $counter = 1;
                                while($row = mysqli_fetch_array($result)){
                                    // echo "<tr>";
                                    // echo "</tr>";
                                    echo "<tr>";
                                        echo "<td> $counter <td>";
                                        $counter++;
                                        // echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['id_trx'] . "</td>";
                                        echo "<td>" . $row['id_user'] . "</td>";
                                        echo "<td>" . $row['id_buku'] . "</td>";
                                        echo "<td>" . $row['jumlah'] . "</td>";
                                        echo "<td>" . $row['name_customer'] . "</td>";
                                        echo "<td>" . $row['date_trx'] . "</td>";
                                    echo "</tr>";
                                }
                        mysqli_close($link);
                        ?>
                    </div>
                </div>
                <!-- <a href="index.php" class="btn btn-warning">Menu</a> -->
            </div>
        </div>
    </div>
</body>
</html>