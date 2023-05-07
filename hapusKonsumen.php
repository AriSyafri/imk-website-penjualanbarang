<?php
    require 'functions.php';

    $data = $_GET["idkonsumen"];
    
    
    if (hapusKonsumen($data) > 0 ) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href= 'konsumen.php';
    
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus, periksa apakah ada tabel berelasi');
                document.location.href= 'konsumen.php';
            </script>
        ";
    }

?>