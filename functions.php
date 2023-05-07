<?php 
    $conn = mysqli_connect("localhost", "root", "", "penjualanimk");
    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    // pencarian barang
    function cariBrg($keyword) {
        $query = "SELECT * FROM inventoribarang
        INNER JOIN pegawai 
        ON inventoribarang.idpegawai = pegawai.idpegawai
        where
        idbarang like '%$keyword%' or
        namabarang like '%$keyword%' or
        stok like '%$keyword%' or
        harga like '%$keyword%' or
        namapegawai like '%$keyword%'       
        ";
        return query($query);
    }

    function cariKonsumen($keyword) {
        $query = "SELECT * FROM konsumen
        where
        idkonsumen like '%$keyword%' or
        namakonsumen like '%$keyword%' or
        nohp like '%$keyword%'      
        ";
        return query($query);
    }

    // pencarian pegawai
    function caripegawai($keyword) {
        $query = "SELECT * FROM pegawai
        where
        namapegawai like '%$keyword%' or
        role like '%$keyword%' or
        alamat like '%$keyword%' or
        nohp like '%$keyword%'
        ";
        return query($query);
    }

    function cariTrans($keyword) {
        $query = "SELECT pembelian.idpembelian, namabarang, status,namakonsumen, jumlahbeli, DATE(waktu) AS waktu ,harga,harga * jumlahbeli AS 'harga pembelian'
        FROM pembelian
        INNER JOIN konsumen
        ON pembelian.idkonsumen = konsumen.idkonsumen
        INNER JOIN inventoribarang
        ON pembelian.idbarang = inventoribarang.idbarang
        where 
        pembelian.idpembelian like '%$keyword%' or
        namabarang like '%$keyword%' or
        namakonsumen like '%$keyword%' or
        jumlahbeli like '%$keyword%' or
        harga like '%$keyword%'
        ORDER BY DATE(waktu) DESC
        ";
        return query($query);
    }

    function tambahBarang($data) {
        global $conn;

        $idbarang = htmlspecialchars($data["idbarang"]);
        $namabarang = htmlspecialchars($data["namabarang"]);
        $stok = htmlspecialchars($data["stok"]);
        $harga = htmlspecialchars($data["harga"]);
        $idpegawai = htmlspecialchars($data["idpegawai"]);

        $query = "INSERT INTO inventoribarang values
        ('$idbarang', '$namabarang', '$stok', '$harga','$idpegawai')";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function ubahBarang($data) {
        global $conn;


        $idbarang = htmlspecialchars($data["idbarang"]);
        $namabarang = htmlspecialchars($data["namabarang"]);
        $stok = htmlspecialchars($data["stok"]);
        $harga = htmlspecialchars($data["harga"]);
        $idpegawai = htmlspecialchars($data["idpegawai"]);

        $query = "UPDATE inventoribarang SET
                    namabarang = '$namabarang',
                    stok = '$stok',
                    harga = '$harga',
                    idpegawai = '$idpegawai'
                where idbarang = '$idbarang'
                ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapusBarang($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM inventoribarang WHERE idbarang = '$id'");
        return mysqli_affected_rows($conn);
    }

    function tambahPegawai($data){
        global $conn;

        $id = strtolower(stripslashes($data["idpegawai"]));
        $nama = htmlspecialchars($data["namapegawai"]);
        $role = htmlspecialchars($data["role"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $hp = htmlspecialchars($data["nohp"]);
        $password = mysqli_real_escape_string($conn, $data["pass"]);
        $password2 = mysqli_real_escape_string($conn, $data["pass2"]);

        if ($role == "0") {
            echo "<script>
                    alert('Pilih role dulu')
                </script>";
            return false;
        }
    

        // memeriksa username
        $result = mysqli_query($conn, "SELECT idpegawai FROM pegawai WHERE
        idpegawai = '$id'"); 
        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                    alert('username sudah terdaftar')
                </script>";
            return false;
        }

        // cek konfirmasi pass
        if ($password !== $password2) {
            echo "<script>
                    alert('konfirmasi password tidak sesuai');
                </script>";
            return false;
        }

          // enkripsi pass
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO pegawai VALUES('$id','$password','$nama','$role','$alamat','$hp')");

        return mysqli_affected_rows($conn);


    }

    function ubahPegawai($data) {
        global $conn;

        $id = strtolower(stripslashes($data["idpegawai"]));
        $nama = htmlspecialchars($data["namapegawai"]);
        $role = htmlspecialchars($data["role"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $hp = htmlspecialchars($data["nohp"]);

        $query = "UPDATE pegawai SET
                    idpegawai = '$id',
                    namapegawai = '$nama',
                    role = '$role',
                    alamat = '$alamat',
                    nohp = '$hp'
                WHERE idpegawai = '$id'
            ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapusPegawai($id) {
        global $conn;
        mysqli_query($conn,"DELETE FROM pegawai WHERE idpegawai = '$id'");
        return mysqli_affected_rows($conn);
    }

    function tambahKonsumen($data){
        global $conn;

        $nama = htmlspecialchars($data['namaKonsumen']);
        $hp = htmlspecialchars($data['nohp']);

        $result = mysqli_query($conn, "SELECT namakonsumen FROM konsumen WHERE
        namakonsumen = '$nama'"); 
        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                    alert('Nama sudah terdaftar')
                </script>";
            return false;
        }

        $query = "INSERT INTO konsumen values 
        ('','$nama', '$hp')";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function mengubahKonsumen($data){
        global $conn;

        $id = strtolower(stripslashes($data["idkonsumen"]));
        $nama = htmlspecialchars($data["namaKonsumen"]);
        $hp = htmlspecialchars($data["nohp"]);

        $query = "UPDATE konsumen SET
                    namakonsumen = '$nama',
                    nohp = '$hp'
                WHERE idkonsumen = '$id'
            ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapusKonsumen($id) {
        global $conn;
        mysqli_query($conn,"DELETE FROM konsumen WHERE idkonsumen = '$id'");
        return mysqli_affected_rows($conn);
    }

    function tambahtransaksi($data){
        global $conn;

        $barang = htmlspecialchars($data["barang"]);
        $konsumen = htmlspecialchars($data["konsumen"]);
        $status = htmlspecialchars($data["status"]);
        $jbeli = htmlspecialchars($data["beli"]);

        if ($barang == "0") {
            echo "<script>
                    alert('Pilih barang dulu')
                </script>";
            return false;
        }
        
        if ($konsumen == "0") {
            echo "<script>
                    alert('Pilih konsumen dulu')
                </script>";
            return false;
        }


        $query = "INSERT INTO pembelian (jumlahbeli, idbarang, idkonsumen, status) values
        ('$jbeli','$barang','$konsumen','$status')";

        mysqli_query($conn, $query);

        echo "
        <script>
            alert('data telah ditambahkan');
            document.location.href = 'transaksi.php'
        </script>
        ";

        return mysqli_affected_rows($conn);

    }

    function ubahtransaksi($data){
        global $conn;

        $id = htmlspecialchars($data["idpembelian"]);
        $konsumen = htmlspecialchars($data["konsumen"]);
        $status = htmlspecialchars($data["status"]);

        $query = "UPDATE pembelian SET
                idkonsumen  = '$konsumen',
                status = '$status'
            WHERE idpembelian = '$id'
        ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapusTransaksi($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM pembelian WHERE idpembelian = '$id'");
        return mysqli_affected_rows($conn);
    }

    function bayarStatusTransaksi($data) {
        global $conn;
        $id = htmlspecialchars($data["idpegawai"]);

        $query = "UPDATE pembelian SET
                    status = 'dibayar'
                    WHERE idkonsumen = '$id'
                "; 
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function updateTransaksi($data) {
        global $conn;

        $barang = htmlspecialchars($data["barang"]);
        $jBeli = htmlspecialchars($data["beli"]);

        $barangCari = query("SELECT * FROM inventoribarang WHERE idbarang = '$barang'")[0];

        //validasi jika kurang
        if (($barangCari["stok"] - $jBeli) < 0) {
            echo "<script>
                    alert('nilai stok kurang dari jumlah beli')
                </script>";
            return false;
        }

        $query = "UPDATE inventoribarang
                    SET stok = stok - '$jBeli'
                WHERE idbarang = '$barang'
            ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


?>