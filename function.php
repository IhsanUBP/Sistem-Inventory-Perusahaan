<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stokbarang");

//Menambah Barang Baru
if(isset($_POST['newbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn,"INSERT INTO stock (namabarang, deskripsi, stock) VALUES('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location:index.php');
    } else{
        echo 'Gagal';
        header('location:index.php');
    }
};


//Menambah Barang Masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, penerima, qty) VALUES ('$barangnya', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    
    if($addtomasuk&&$updatestockmasuk){
        header('location: masuk.php');
    } else {
        echo 'Gagal';
        header('location: masuk.php');
    }
}

//Menambah Barang Keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $peminjam = $_POST['peminjam'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, peminjam, keterangan, qty) VALUES ('$barangnya', '$peminjam', '$keterangan', '$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    
    if($addtokeluar&&$updatestockmasuk){
        header('location: keluar.php');
    } else {
        echo 'Gagal';
        header('location: keluar.php');
    }
}


//Update Info Barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST ['idb'];
    $namabarang = $_POST ['namabarang'];
    $deskripsi = $_POST ['deskripsi'];
    $stock = $_POST ['stock'];

    $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi', stock=$stock where idbarang ='$idb'");
    if($update){
        header('location: index.php');
    } else {
        echo 'Gagal';
        header('location: index.php');
    }
    

}


//Hapus Barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST ['idb'];

    $hapus = mysqli_query($conn,"delete from stock where idbarang='$idb'");
    if($hapus){
        header('location: index.php');
    } else {
        echo 'Gagal';
        header('location: index.php');
    }
}


?>