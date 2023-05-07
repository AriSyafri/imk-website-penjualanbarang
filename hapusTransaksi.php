<?php
    require 'functions.php';

    $data = $_GET["idpembelian"];

    if (hapusTransaksi($data) > 0 ) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href= 'transaksi.php';
    
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href= 'transaksi.php';
            </script>
        ";
    }
?>