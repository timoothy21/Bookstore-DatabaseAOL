<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$isbn = $judul = $name = $penerbit = $genre = $address = $halaman = $price = $tahun_terbit = $stok = "";
$isbn_err = $judul_err = $name_err = $penerbit_err = $genre_err = $address_err = $halaman_err = $price_err = $tahun_terbit_err = $stok_err = "";
// $name = $address = $price = $judul = $penerbit = "" ;
// $name_err = $address_err = $price_err = $judul_err = $penerbit_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

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
    } elseif(!ctype_digit($input_stok)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $stok = $input_stok;
    }

    // Check input errors before inserting in database
    if(empty($isbn_err) && empty($judul_err) && empty($name_err) && empty($penerbit_err) && empty($genre_err) && empty($address_err) && empty($halaman_err) && empty($price_err) && empty($tahun_terbit_err) && empty($stok_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO books (isbn, judul, name, penerbit, genre, address, halaman, price, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_isbn, $param_judul, $param_name, $param_penerbit, $param_genre, $param_address, $param_halaman, $param_price, $param_tahun_terbit, $param_stok);

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

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
        }
    </style>
</head>
<body>
    <div class="wrapper_create">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Buku</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data buku ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="container_box">
                        <div class="form-group <?php echo (!empty($isbn_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 36%">
                                <label>ISBN Buku</label>
                                <input type="text" name="isbn" class="form-control" value="<?php echo $isbn; ?>">
                                <!-- <textarea name="isbn" class="form-control"><?php echo $isbn; ?></textarea> -->
                                <span class="help-block"><?php echo $isbn_err;?></span>
                        </div>
    
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 63%">
                            <label>Judul Buku</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            <!-- <textarea name="judul" class="form-control"><?php echo $judul; ?></textarea> -->
                            <span class="help-block"><?php echo $judul_err;?></span>
                        </div>
                    </div>
                    
                    
                    <div class="container_box">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 50%">
                            <label>Nama Pengarang</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($penerbit_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 50%">
                            <label>Penerbit Buku</label>
                            <input type="text" name="penerbit" class="form-control" value="<?php echo $penerbit; ?>">
                            <!-- <textarea name="penerbit" class="form-control"><?php echo $penerbit; ?></textarea> -->
                            <span class="help-block"><?php echo $penerbit_err;?></span>
                        </div>
                    </div>
                    
                    <div class="container_box">
                        <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 32%">
                            <label>Genre Buku</label>
                            <input type="text" name="genre" class="form-control" value="<?php echo $genre; ?>">
                            <!-- <textarea name="genre" class="form-control"><?php echo $genre; ?></textarea> -->
                            <span class="help-block"><?php echo $genre_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($halaman_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 35%">
                            <label>Total Halaman buku</label>
                            <input type="text" name="halaman" class="form-control" value="<?php echo $halaman; ?>">
                            <!-- <textarea name="halaman" class="form-control"><?php echo $halaman; ?></textarea> -->
                            <span class="help-block"><?php echo $halaman_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tahun_terbit_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 30%">
                            <label>Tahun Terbit</label>
                            <input type="date" name="tahun_terbit" class="form-control" value="<?php echo $tahun_terbit; ?>">
                            <span class="help-block"><?php echo $tahun_terbit_err;?></span>
                        </div>
                    </div>

                    <div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                    </div>

                    <div class="container_box">
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 50%">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($stok_err)) ? 'has-error' : ''; ?>" id='inline' style="width: 50%">
                            <label>Stok</label>
                            <input type="text" name="stok" class="form-control" value="<?php echo $stok; ?>">
                            <!-- <textarea name="stok" class="form-control"><?php echo $stok; ?></textarea> -->
                            <span class="help-block"><?php echo $stok_err;?></span>
                        </div>
                    </div>
                        
                    <a href="index.php" class="btn btn-default pull-left">Cancel</a>
                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>