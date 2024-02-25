<?php

require 'functions.php';

$id = $_GET["id"];

if( delete($id) > 0 ) {
    echo "
            <script>
            alert('data sucessful removed');
            document.location.href = 'index.php';
            </script>
        ";
    }else{ 
        echo "
            <script>
            alert('failed to remove data');
            document.location.href = 'index.php';
            </script>
        
        ";
}


?>