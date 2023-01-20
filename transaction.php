<?php 
// Include config file
require_once "config.php";
session_start();

$judul = $judul_err = "";
// $id_user = $id_user_err = "";
?>

<html>
<head>
    <title>Transaction</title>
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
        .table-container#container-scroll {
            overflow-x:scroll;
            height: 60vh;
        }
    </style>
</head>
<body>
    <div class="wrapper_transaction">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Add Transaction</h2>
                        <div class="menu_header">
                        <a href="profile.php" class="btn btn-profile" id="btn-profile">My Profile</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="index.php" class="btn btn-warning" id="btn_menu">Dashboard</a>
                            <p style="margin: 0px 10px 0px 5px;">.</p>
                            <a href="view-search_transaction.php" class="btn btn-info" id="btn_transaction">View Transaction</a>
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

                        <div class="table-container" id="container-scroll">
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
                                            echo "<th>price</th>";
                                            echo "<th>Tahun Terbit</th>";
                                            echo "<th>Stok</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
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
                                                echo "<td>" . $row['price'] . "</td>";
                                                echo "<td>" . $row['tahun_terbit'] . "</td>";
                                                echo "<td>" . $row['stok'] . "</td>";
                                            echo "</tr>";
                                        }
                                    echo "</tbody>";
                                    echo "</table>";
                                    mysqli_free_result($result);
                            ?>
                        </div>


                    <div class = "form-pengeluaran">
                        <h3>Form Pengeluaran Barang</h3>
                        <form action="transaction.php" method="GET">
                                    <label>Pilih Barang</label>
                                        <?php
                                        $selBar = mysqli_query($link, "SELECT * FROM books ORDER BY judul ASC");        
                                        echo '<select name="id_buku" class="form-control" id="pengeluaran" required>';    
                                        echo '<option value="">...</option>';    
                                        while ($rowbar = mysqli_fetch_array($selBar)) {    
                                        echo '<option value="'.$rowbar['id_buku'].'">'.$rowbar['isbn'].'_'.$rowbar['judul'].'</option>';    
                                        }    
                                        echo '</select>';
                                        ?>
                                <div class="form-group" style="margin-top: 10px;">
                                    <label>Nama Pembeli</label>
                                    <input type="text" name="nama_pembeli" class="form-control" id="pengeluaran" maxlength="100" style="margin-top: 0px;" required />

                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" id="pengeluaran" maxlength="11" style="margin-top: 0px;" required />

                                </div>
                                
                                <div style="margin-top: 35px;">
                                    <input type="submit" name="Submit" class="btn btn-primary" value="Submit">
                                    <!-- <input type="submit" name="Submit" value="Submit"/> -->
                                    <input type="reset" class="btn btn-light" value="Reset"/>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_GET['Submit'])) {
    $id_user = $_SESSION["id_user"];
    // tinggal id user di halaman transaction
    $id_buku        =$_GET['id_buku'];
    $nama_pembeli   =$_GET['nama_pembeli'];
    // $id_trx        =$_GET['id_trx'];
    $jumlah        =$_GET['jumlah'];
    
    // include "koneksi.php";    
    $selSto = mysqli_query($link, "SELECT * FROM books WHERE id_buku='$id_buku'");
    $sto    = mysqli_fetch_array($selSto);
    $stok    = $sto['stok'];
    //menghitung sisa stok
    $sisa    = $stok - $jumlah;
    
    if ($stok < $jumlah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
            document.location='./transaction.php';
        </script>
        <?php
    }
    //proses    
    else{
        $insert = mysqli_query($link, "INSERT INTO transaction (id_buku, id_user, name_customer, jumlah) VALUES ('$id_buku', '$id_user', '$nama_pembeli', '$jumlah')");
            if($insert){
                //update stok
                $upstok= mysqli_query($link, "UPDATE books SET stok='$sisa' WHERE id_buku='$id_buku'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='./view-search_transaction.php';
                </script>
                <?php
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    }
    }
?>