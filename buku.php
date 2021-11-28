<?php

if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
			include 'buku_baru.php';
			break;
			case 'edit':
			include 'buku_edit.php';
			break;
			case 'hapus':
			include 'buku_hapus.php';
			break;
		}
	} else {

		echo '

		<div class="container">
		<h3 style="margin-bottom: -20px;">Daftar Buku</h3>
		<a href="./admin.php?hlm=buku&aksi=baru" class="btn btn-info btn-s pull-right">Tambah Data</a>
		<br/><hr/>

		<table class="table table-bordered">
		<thead>
		<tr class="info">
		<th width="5%">No</th>
		<th width="15%">Judul Buku</th>
		<th width="15%">Pengarang</th>
		<th width="10%">Penerbit</th>
		<th width="30%">Gambar</th>
		<th width="10%">Tanggal</th>
		<th width="20%">Tindakan</th>
		</tr>
		</thead>
		<tbody>';

			//skrip untuk menampilkan data dari database
		$sql = mysqli_query($koneksi, "SELECT * FROM buku");
		if(mysqli_num_rows($sql) > 0){
			$no = 0;

			while($row = mysqli_fetch_array($sql)){
				$no++;
				echo '

				<tr>
				<td>'.$no.'</td>
				<td>'.$row['judul'].' </td> 
				<td>'.$row['pengarang'].'</td>
				<td>'.$row['penerbit'].'</td>	
				<td class="text-center"><img src="./gambar/' . $row['gambar'] .'" width="120px"></td>
				<td>'.date("d M Y", strtotime($row['created_at'])).'</td>
				<td>

				<script type="text/javascript" language="JavaScript">
				function konfirmasi(){
					tanya = confirm("Anda yakin akan menghapus data buku ini?");
					if (tanya == true) return true;
					else return false;
				}
				</script>

				<a href="?hlm=buku&aksi=edit&id_buku='.$row['id_buku'].'" class="btn btn-primary btn-s">Edit</a>

				<a href="?hlm=buku&aksi=hapus&submit=yes&id_buku='.$row['id_buku'].'" onclick="return konfirmasi()" class="btn btn-warning btn-s">Hapus</a>

				</td>';
			}
		} else {
			echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=buku&aksi=baru">Tambah data baru</a></u> </p></center></td></tr>';
		}
		echo '
		</tbody>
		</table>
		</div>';
	}
}
?>
