<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$judul = $_REQUEST['judul'];
		$pengarang = $_REQUEST['pengarang'];
		$penerbit = $_REQUEST['penerbit'];
		$id_user = $_SESSION['id_user'];

		$ekstensi_diperbolehkan	= array('png','jpg');
		$gambar = $_FILES['gambar']['name'];
		$x = explode('.', $gambar);
		$ekstensi = strtolower(end($x));
		$file_tmp = $_FILES['gambar']['tmp_name'];

		if (!empty($gambar)){
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload gambar
				move_uploaded_file($file_tmp, 'gambar/'.$gambar);
			}
		}

		$sql = mysqli_query($koneksi, "INSERT INTO buku(judul, pengarang, penerbit, gambar, created_at) VALUES('$judul', '$pengarang', '$penerbit', '$gambar', NOW())");

		if($sql == true){
			header('Location: ./admin.php?hlm=buku');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		?>
		<h2>Tambah Buku Baru</h2>
		<hr>
		<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
			<div class="form-group">
				<label for="judul" class="col-sm-2 control-label">Judul</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="judul" name="judul" placeholder="judul buku" required>
				</div>
			</div>
			<div class="form-group">
				<label for="pengarang" class="col-sm-2 control-label">Pengarang</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="nama pengarang" required>
				</div>
			</div>
			<div class="form-group">
				<label for="penerbit" class="col-sm-2 control-label">Penerbit</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="nama penerbit" required>
				</div>
			</div>
			<div class="form-group">
				<label for="gambar" class="col-sm-2 control-label">Gambar</label>
				<div class="col-sm-3">
					<input type="file" class="form-control" id="gambar" name="gambar" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="submit" class="btn btn-info">Simpan</button>
					<a href="./admin.php?hlm=buku" class="btn btn-warning">Batal</a>
				</div>
			</div>
		</form>
		<?php
	}
}
?>
