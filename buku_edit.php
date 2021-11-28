<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_buku = $_REQUEST['id_buku'];
		$judul = $_REQUEST['judul'];
		$pengarang = $_REQUEST['pengarang'];
		$penerbit = $_REQUEST['penerbit'];
		$id_user = $_SESSION['id_user'];

		if( $_FILES['gambar']['name'] == ''){
			$sql = mysqli_query($koneksi, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', updated_at=NOW() WHERE id_buku='$id_buku'");
		} else{
			$ekstensi_diperbolehkan	= array('png','jpg');
			$gambar = $_FILES['gambar']['name'];
			$x = explode('.', $gambar);
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['gambar']['tmp_name'];

			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload gambar
				move_uploaded_file($file_tmp, 'gambar/'.$gambar);
			}

			$sql = mysqli_query($koneksi, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', gambar='$gambar', updated_at=NOW() WHERE id_buku='$id_buku'");

		}

		if($sql == true){
			header('Location: ./admin.php?hlm=buku');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_buku = $_REQUEST['id_buku'];

		$sql = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");
		while($row = mysqli_fetch_array($sql)){

			?>

			<h2>Edit Data Buku</h2>
			<hr>
			<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
				<div class="form-group">
					<label for="judul" class="col-sm-2 control-label">Judul</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>" placeholder="judul baru" required>
					</div>
				</div>
				<div class="form-group">
					<label for="pengarang" class="col-sm-2 control-label">Pengarang</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $row['pengarang']; ?>" placeholder="pengarang baru" required>
					</div>
				</div>
				<div class="form-group">
					<label for="penerbit" class="col-sm-2 control-label">Penerbit</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $row['penerbit']; ?>" placeholder="penerbit baru" required>
					</div>
				</div>
				<div class="form-group">
					<label for="gambar" class="col-sm-2 control-label">Gambar</label>
					<div class="col-sm-3">
						<input type="file" class="form-control" id="gambar" name="gambar">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
						<a href="./admin.php?hlm=buku" class="btn btn-warning">Batal</a>
					</div>
				</div>
			</form>
			<?php
		}
	}
}
?>
