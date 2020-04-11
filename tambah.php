<?php

if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    include('koneksi.php');

    $statement = $db->prepare('INSERT INTO barang(nama, harga, jumlah) VALUES(?, ?, ?)');
    $statement->bind_param('sii', $nama, $harga, $jumlah);
    $statement->execute();

    if($db->affected_rows > 0){
        $message = "Data berhasil diinputkan";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
    
    <div class="container">
        <h1>Tambah Barang</h1>

        <div class="row">
            <div class="col-sm">
                <a href="index.php" class="btn btn-primary">List Barang</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm">

                <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

                <form method="POST" action="tambah.php" onsubmit="return confirm('Do you really want to submit the form?');">
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Barang</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Barang</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <button type="submit" name='submit' class="btn btn-primary">Tambah</button>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>