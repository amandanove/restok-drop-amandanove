<?php

include('koneksi.php');

if(isset($_POST['sbumit'])){
    if(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus'){
        $id = $_POST['id'];
        $sql = "DELETE FROM barang WHERE id=".$id;
        $db->query($sql);
        if($db->affected_rows > 0){
            $message = "Data berhasil dihapus";
        }
    }
}

if(!$result = $db->query('SELECT * FROM barang')){
    die("Gagal meminta data");
}
$no = 1;

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
        <h1>Daftar Barang</h1>

        <div class="row">
            <div class="col-sm">
                <a href="tambah.php" class="btn btn-primary">Tambah Barang</a>
            </div>
        </div>
        
        <div class="row py-2">
            <div class="col-sm">
                
                <?php if(isset($message)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th class="text-right" scope="col">Harga</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $row['nama'] ?></td>
                        <td><?php echo $row['jumlah'] ?></td>
                        <td class="text-right"><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <form method="POST" action="index.php" onsubmit="return confirm('Yakin mau dihapus?');">
                                
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class='btn btn-sm btn-primary'>Edit</a>

                                <input type="hidden" name="aksi" value="hapus">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
                                <button type="submit" name="sbumit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    
    
</body>
</html>