<?php
if( !empty( $_SESSION['id_user'] ) ){
	include "koneksi.php";
	?>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href=""><i class="fa fa-book"></i> PERPUSTAKAAN</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="./admin.php">Beranda</a></li>
					<li><a href="./admin.php?hlm=buku">Daftar Buku</a></li>

					<?php
					if( $_SESSION['level'] == 1 ){
						?>
						<li class="dropdown">
							<a href="./admin.php?hlm=user">Daftar User</a></li>

							<?php
						}
						?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo $_SESSION['nama']; ?> <b class="glyphicon glyphicon-user"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a>
								<?php
									if($_SESSION['level'] == 1){
										echo 'Admin.';
									} else {
										echo 'Siswa.';
									}
								?>
								</a>
							</li>
						</ul>
						<li><a href="logout.php">Logout</a></li>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<?php
} else {
	header("Location: ./");
	die();
}
?>
