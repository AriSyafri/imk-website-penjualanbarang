<?php 
    require 'functions.php';

    $data = $_GET["idpegawai"];

    if(hapusPegawai($data) > 0) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href= 'pegawai.php';
    
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href= 'pegawai.php';
            </script>
        ";
    }


?>