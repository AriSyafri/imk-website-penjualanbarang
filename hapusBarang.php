<?php
    require 'functions.php';

    $data = $_GET["idbarang"];

    if (hapusBarang($data) > 0 ) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href= 'barang.php';
    
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus, periksa apakah ada tabel berelasi');
                document.location.href= 'barang.php';
            </script>
        ";
    }
?>