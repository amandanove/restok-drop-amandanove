<?php 

	include ('koneksi.php');

	$row['nama'] = ' ';
	$row['jumlah']  =  ' ';

if(isset($_POST['cariBarang'])){
    $barang = $_POST['barang'];

    $sql = 'SELECT * FROM barang WHERE id='.$barang;
    $result = $db->query($sql);
    if(!$result = $db->query($sql)){
        die("Gagal Query");
    };
    $row = $result->fetch_assoc();
}

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];
    $jumlahpilihan = $_POST['jumlahpilihan'];
    $pilihan = $_POST['pilihan'];
    $hasil = 0;

    if($pilihan=='tambah'){
        $hasil = $jumlah + $jumlahpilihan;
        $statement = $db->prepare('UPDATE barang SET jumlah=? WHERE id=?');
        $statement->bind_param('ii', $hasil, $id);
        $statement->execute();
        $message = "Berhasil Ditambahkan, Jumlah Barang Sekarang ".$hasil;
    }
    elseif($pilihan=='kurang'){
        if($jumlahpilihan > $jumlah){
            $messageerror = "Jumlah Barang yang dikurangkan Melebihi Stock yang Tersedia";
        }else{
            $hasil = $jumlah - $jumlahpilihan;
            $statement = $db->prepare('UPDATE barang SET jumlah=? WHERE id=?');
            $statement->bind_param('ii', $hasil, $id);
            $statement->execute();
            $message = "Berhasil, Jumlah Barang Sekarang ".$hasil;
        }
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Hello, world!!</title>
</head>
<body>
<div class="container">
    <br>
    <div class="row">
        <div class="mr-3 ml-3"><a href="index.php" class="btn btn-danger">Kembali</a></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama"><h3>Cari Barang</h3></label>
                </div>    
                <div class="row">
                    <div class="col-sm">
                        <select class="form-control" name="barang">
                           <?php 

                            $sql = 'SELECT * FROM barang';
                            $result = $db->query($sql);

                            if(!$result = $db->query($sql)){
                                die("Gagal Query");
                            };

                            while ($data = $result->fetch_assoc()) { ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                                <?php }; ?>  
                        </select>
                    </div>
                    <div class="col-sm">
                        <button type="submit" name="cariBarang" class="btn btn-info">Cari</button>
                    </div>
                </div> 
                <br>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <?php if(isset($message)){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
                <?php } ?>
            <?php if(isset($messageerror)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $messageerror; ?>
                </div>
                <?php } ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body">  
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nama"><h3>Drop Restock Barang</h3></label>
                    <input type="text" name="id" value="<?php echo $row['id']; ?> " hidden="" required="true">
                </div>    
                <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" readonly> 
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" readonly>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <select class="form-control" name="pilihan" o>
                            <option value="tambah">Restock</option> 
                            <option value="kurang">Drop</option>
                        </select>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jumlahpilihan">
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
                </div>      
            </form>
        </div>
    </div>
</body>
</html>