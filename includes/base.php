<base href="http://localhost/milatulegal.com/">
<?php 
    if(!isset($_SESSION['phonenumber'])){
        // header("location:../logout");
        echo "not logged in";
    }
?>