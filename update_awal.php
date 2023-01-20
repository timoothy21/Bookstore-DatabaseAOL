<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$isbn = $judul = $name = $penerbit = $genre = $address = $halaman = $price = $tahun_terbit = $stok = "";
$isbn_err = $judul_err = $name_err = $penerbit_err = $genre_err = $address_err = $halaman_err = $price_err = $tahun_terbit_err = $stok_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    //Validate isbn
    $input_isbn = trim($_POST["isbn"]);
    if(empty($input_isbn)){
        $isbn_err = "Please enter a isbn.";
    } elseif(!filter_var($input_isbn, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9\s]+$/")))){
        $isbn_err = "Please enter a valid isbn.";
    } else{
        $isbn = $input_isbn;
    }

    // Validate judul
    $input_judul = trim($_POST["judul"]);
    if(empty($input_judul)){
        $judul_err = "Please enter a name.";
    } elseif(!filter_var($input_judul, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z.:\s]+$/")))){
        $judul_err = "Please enter a valid name.";
    } else{
        $judul = $input_judul;
    }

    // Validate name pengarang
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z.\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }

    // Validate penerbit
    $input_penerbit = trim($_POST["penerbit"]);
    if(empty($input_penerbit)){
        $penerbit_err = "Please enter a name.";
    } elseif(!filter_var($input_penerbit, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $penerbit_err = "Please enter a valid name.";
    } else{
        $penerbit = $input_penerbit;
    }

    // Validate genre
    $input_genre = trim($_POST["genre"]);
    if(empty($input_genre)){
        $genre_err = "Please enter a type of genre.";
    } else{
        $genre = $input_genre;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }

    // Validate halaman
    $input_halaman = trim($_POST["halaman"]);
    if(empty($input_halaman)){
        $halaman_err = "Please enter the halaman amount.";
    } elseif(!ctype_digit($input_halaman)){
        $halaman_err = "Please enter a positive integer value.";
    } else{
        $halaman = $input_halaman;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

    // Validate tahun_terbit
    $input_tahun_terbit = trim($_POST["tahun_terbit"]);
    if(empty($input_tahun_terbit)){
        $tahun_terbit_err = "Please pick a valid date.";
    } else{
        $tahun_terbit = $input_tahun_terbit;
    }

    // Validate stok
    $input_stok = trim($_POST["stok"]);
    if(empty($input_stok)){
        $stok_err = "Please enter the stok amount.";
    } else{
        $stok = $input_stok;
    }
    
    // Check input errors before inserting in database
    if(empty($isbn_err) && empty($judul_err) && empty($name_err) && empty($penerbit_err) && empty($genre_err) && empty($address_err) && empty($halaman_err) && empty($price_err) && empty($tahun_terbit_err) && empty($stok_err)){
    // if(empty($isbn_err) && empty($judul_err) && empty($name_err) && empty($penerbit_err) && empty($genre_err) && empty($address_err) && empty($halaman_err) && empty($price_err) && empty($tahun_terbit_err) && empty($stok_err)){
        // Prepare an update statement
        $sql = "UPDATE books SET isbn=?, judul=?, name=?, penerbit=?, genre=?, address=?, halaman=?, price=?, tahun_terbit=?, stok=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // mysqli_stmt_bind_param($stmt, "ssssi", $param_judul, $param_name, $param_address, $param_price, $param_id);
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $param_isbn, $param_judul, $param_name, $param_penerbit, $param_genre, $param_address, $param_halaman, $param_price, $param_tahun_terbit, $param_stok, $param_id);
            // Set parameters
            $param_isbn = $isbn;
            $param_judul = $judul;
            $param_name = $name;
            $param_penerbit = $penerbit;
            $param_genre = $genre;
            $param_address = $address;
            $param_halaman = $halaman;
            $param_price = $price;
            $param_tahun_terbit = $tahun_terbit;
            $param_stok = $stok;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM books WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    
                    <div class="form-group <?php echo (!empty($isbn_err)) ? 'has-error' : ''; ?>">
                            <label>ISBN Buku</label>
                            <input type="text" name="isbn" class="form-control" value="<?php echo $isbn; ?>">
                            <!-- <textarea name="" class="form-control"><?php echo $isbn; ?></textarea> -->
                            <span class="help-block"><?php echo $isbn_err;?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                            <label>Judul Buku</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            <span class="help-block"><?php echo $judul_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($penerbit_err)) ? 'has-error' : ''; ?>">
                        <label>Penerbit Buku</label>
                        <textarea type="text" name="penerbit" class="form-control"><?php echo $penerbit; ?></textarea>
                        <span class="help-block"><?php echo $penerbit_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">
                        <label>Genre Buku</label>
                        <textarea type="text" name="genre" class="form-control"><?php echo $genre; ?></textarea>
                        <span class="help-block"><?php echo $genre_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                        <label>Alamat</label>
                        <textarea type="text" name="address" class="form-control"><?php echo $address; ?></textarea>
                        <span class="help-block"><?php echo $address_err;?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($halaman_err)) ? 'has-error' : ''; ?>">
                        <label>Halaman buku</label>
                        <textarea type="text" name="halaman" class="form-control"><?php echo $halaman; ?></textarea>
                        <span class="help-block"><?php echo $halaman_err;?></span>
                    </div>


                    <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>price Buku</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($tahun_terbit_err)) ? 'has-error' : ''; ?>">
                            <label>Tahun terbit Buku</label>
                            <input type="date" name="tahun_terbit" class="form-control" value="<?php echo $tahun_terbit; ?>">
                            <span class="help-block"><?php echo $tahun_terbit_err;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($stok_err)) ? 'has-error' : ''; ?>">
                            <label>Stok Buku</label>
                            <input type="text" name="stok" class="form-control" value="<?php echo $stok; ?>">
                            <span class="help-block"><?php echo $stok_err;?></span>
                    </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>