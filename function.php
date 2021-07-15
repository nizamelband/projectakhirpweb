<?php 
session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang2");

// insert barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi  = $_POST['deskripsi'];
    $stock  = $_POST['stock'];

    $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
    if ($addtotable) {
        header('location:index.php');
    }else{
        echo 'gagal';
    }
};

// menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya  =   $_POST['barangnya'];
    $pemasok   =   $_POST['pemasok'];
    $qty        =   $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang =$ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;
    $addtomasuk =   mysqli_query($conn,"insert into masuk (idbarang, pemasok, qty) values('$barangnya','$pemasok','$qty')");
    $updatestockmasuk   =   mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if ($addtomasuk&&$updatestockmasuk) {
        header('location:masuk.php');
    }else{
        echo 'gagal';
    }
}

// menambah barang keluar
if (isset($_POST['barangkeluar'])) {
    $barangnya  =   $_POST['barangnya'];
    $keterangan =   $_POST['keterangan'];
    $qty        =   $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya     = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang    = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar=mysqli_query($conn,"insert into keluar (idbarang, keterangan, qty) values('$barangnya','$keterangan','$qty')");
    $updatestockkeluar=mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if ($addtokeluar&&$updatestockkeluar) {
        header('location:keluar.php');
    }else{
        echo 'gagal';
    }
}


// Update Barang
if (isset($_POST['updatebarang'])) {
   $idb = $_POST['idb'];
   $namabarang = $_POST['namabarang'];
   $deskripsi = $_POST['deskripsi'];
    
   $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
   if ($update) {
    header('location:index.php');
    }
}


// Hapus Barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
   $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
   if ($update) {
    header('location:index.php');
    
    }
}



// update barang masuk

if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $pemasok = $_POST['pemasok'];
    $qty       = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $lihatqty = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($lihatqty);
    $qtyskrg = $qtynya['qty']; //qty dari database

       $updatesql = "UPDATE masuk set pemasok='$pemasok', qty='$qty' where idmasuk='$idm'";
       // $updatesql = "UPDATE masuk SET  qty='$qty', keterangan='$keterangan' WHERE idmasuk='$idm'";
    // jika val update lebih besar dari val semula
    if ($qty>$qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya        = mysqli_query($conn, $updatesql);
            if($kuranginstocknya&&$updatenya){
              header('location:masuk.php');
            }
    }else{
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya        = mysqli_query($conn, $updatesql);
            if($kuranginstocknya&&$updatenya){
              header('location:masuk.php');
            }

    }
    
}

// Hapus Barang Masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if ($update&&$hapusdata) {
    header('location:masuk.php');
    
    }
}


// update barang Keluar

if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $keterangan = $_POST['keterangan'];
    $qty       = $_POST['qty'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $lihatqty = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($lihatqty);
    $qtyskrg = $qtynya['qty']; //qty dari database

       $updatesql = "UPDATE keluar set keterangan='$keterangan', qty='$qty' where idkeluar='$idk'";
       
    // jika val update lebih besar dari val semula
    if ($qty>$qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kuranginstocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya        = mysqli_query($conn, $updatesql);
            if($kuranginstocknya&&$updatenya){
              header('location:keluar.php');
            }
    }else{
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kuranginstocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya        = mysqli_query($conn, $updatesql);
            if($kuranginstocknya&&$updatenya){
              header('location:keluar.php');
            }

    }
    
}

// Hapus Barang Keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if ($update&&$hapusdata) {
    header('location:keluar.php');
    
    }
}

// Tanggal
    function tanggal_indo($tanggal, $cetak_hari = false){
        $hari = array ( 1 =>    'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');     
        $bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $jam= ' ' . date("H:i") . ' WIB';
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo . $jam;
        }
        return $tgl_indo;
    }


 ?>