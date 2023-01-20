<?php 
// Include config file
require_once "config.php";
session_start();

$judul = $judul_err = "";
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
                        <h2 class="pull-left">Search Buku</h2>
                        <div class="menu_header">
                            <a href="profile.php" class="btn btn-profile" id="btn-profile">My Profile</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="index.php" class="btn btn-warning" id="btn_menu">Dashboard</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="view-search_transaction.php" class="btn btn-info" id="btn_transaction">View Transaction</a>
                            <a href="transaction.php" class="btn btn-primary" id="btn_transaction">Add Transaction</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="search.php" class="btn btn-info" id="btn_search">Search Buku</a>
                            <a href="create.php" class="btn btn-success">Tambah Buku Baru</a>
                        </div>
                    </div>
                    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Selamat Datang.</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                            <label>Judul Buku</label>
                            <textarea name="judul" class="form-control"><?php echo $judul; ?></textarea>
                            <!-- <span class="help-block"><?php echo $judul_err;?></span> -->
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <!-- <input type="submit" class="btn btn-primary" value="Reset"> -->
                    </form>

                    <div class="table-container">
                        <?php
                            if(isset($_POST["judul"])) {
                                $judul = $_POST["judul"];
                                $query = $query = "SELECT * FROM books WHERE judul like '%".$judul."%' OR isbn like '%".$judul."%' OR penerbit like '%".$judul."%' OR genre like '%".$judul."%' OR tahun_terbit like '%".$judul."%' OR name like '%".$judul."%' ORDER BY judul ASC";
                            } else {
                                //jika tidak ada pencarian, default yang dijalankan query ini
                                $query = "SELECT * FROM books ORDER BY judul ASC";
                            }

                            $result = mysqli_query($link, $query);
            
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th colspan='2'>#</th>";
                                        // echo "<th>ID</th>";
                                        echo "<th>ISBN</th>";
                                        echo "<th>Judul Buku</th>";
                                        echo "<th>Nama Pengarang</th>";
                                        echo "<th>Penerbit</th>";
                                        echo "<th>Genre</th>";
                                        echo "<th>Alamat</th>";
                                        echo "<th>Halaman</th>";
                                        echo "<th>price</th>";
                                        echo "<th>Tahun Terbit</th>";
                                        echo "<th>Stok</th>";
                                        echo "<th>Pengaturan</th>";
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
                                        echo "<td>" . $row['isbn'] . "</td>";
                                        echo "<td>" . $row['judul'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['penerbit'] . "</td>";
                                        echo "<td>" . $row['genre'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['halaman'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['tahun_terbit'] . "</td>";
                                        echo "<td>" . $row['stok'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id_buku'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id_buku'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id_buku'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
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