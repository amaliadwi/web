<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

    if(isset($_REQUEST['submit'])){

        $id_buku = $_REQUEST['id_buku'];

        $sql = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id_buku'");
        if($sql == true){
            header("Location: ./admin.php?hlm=buku");
            die();
        }
    }
}
?>
