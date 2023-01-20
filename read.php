<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE id_buku = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $isbn = $row["isbn"];
                $judul = $row["judul"];
                $name = $row["name"];
                $penerbit = $row["penerbit"];
                $genre = $row["genre"];
                $address = $row["address"];
                $halaman = $row["halaman"];
                $price = $row["price"];
                $tahun_terbit = $row["tahun_terbit"];
                $stok = $row["stok"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="source/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        /* .wrapper{
            width: 500px;
            margin: 0 auto;
        } */
        .form-group#inline{
            display: inline-block;
        }
        .form-group{
            margin-bottom: 0px;
            margin-right: 5px;
        }
        .page-header{
            margin: 0px auto;
        }
        .container_box{
            display: flex;
            margin: 10px 0px;
        }
    </style>
</head>
<body>
    <div class="wrapper_read">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>

                    <!-- <div class="form-group">
                        </div> -->
                        
                        <div class="container_box">
                            <div class="form-group" id='inline' style="width: 35%">
                                <label>ISBN Buku</label>
                                <p class="form-control-static"><?php echo $row["isbn"]; ?></p>
                            </div>
                            
                            <div class="form-group" id='inline' style="width: 70%">
                                <label>Judul Buku</label>
                                <p class="form-control-static"><?php echo $row["judul"]; ?></p>
                            </div>
                        </div>
                        
                        
                    <div class="container_box">
                        <div class="form-group" id='inline' style="width: 35%">
                            <label>Nama Pengarang</label>
                            <p class="form-control-static"><?php echo $row["name"]; ?></p>
                        </div>
                        <div class="form-group" id='inline' style="width: 70%">
                            <label>Penerbit Buku</label>
                            <p class="form-control-static"><?php echo $row["penerbit"]; ?></p>
                        </div>
                    </div>
                        
                    <div class="container_box">
                        <div class="form-group" id='inline' style="width: 35%">
                            <label>Genre Buku</label>
                            <p class="form-control-static"><?php echo $row["genre"]; ?></p>
                        </div>
                        <div class="form-group" id='inline' style="width: 39%">
                            <label>Total Halaman buku</label>
                            <p class="form-control-static"><?php echo $row["halaman"]; ?></p>
                        </div>
                        <div class="form-group" id='inline' style="width: 30%">
                            <label>Tahun Terbit</label>
                            <p class="form-control-static"><?php echo $row["tahun_terbit"]; ?></p>
                        </div>
                    </div>

                    <div>
                        <div class="form-group" id='inline' style="width: 100%">
                            <label>Alamat</label>
                            <p class="form-control-static"><?php echo $row["address"]; ?></p>
                        </div>
                    </div>

                    <div class="container_box">
                        <div class="form-group" id='inline' style="width: 35%">
                            <label>Price</label>
                            <p class="form-control-static"><?php echo $row["price"]; ?></p>
                        </div>
                        <div class="form-group" id='inline' style="width: 50%">
                            <label>Stok</label>
                            <p class="form-control-static"><?php echo $row["stok"]; ?></p>
                        </div>
                    </div>
                    <a href="index.php" class="btn btn-default pull-left">Back</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>