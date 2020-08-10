<?php
	include('config.php');
	include('fungsi.php');

	// mendapatkan data edit
	if(isset($_GET['jenis'])) {
		$jenis	= $_GET['jenis'];
	}

	if (isset($_POST['tambah'])) {
		$jenis	= $_POST['jenis'];
		$nama 	= $_POST['nama'];

		tambahData($jenis,$nama);

		header('Location: '.$jenis.'.php');
	}

	include('../include/header.php');
?>

	<h2>Tambah <?php echo $jenis?></h2>

	<form class="ui form" method="post" action="tambah.php">
		<div class="form-group">
			<label>Nama <?php echo $jenis ?></label>
			<input type="text" name="nama" placeholder="<?php echo $jenis?> baru" class="form-control">
			<input type="hidden" name="jenis" value="<?php echo $jenis?>">
		</div>
		<br>
		<input class="btn btn-primary" type="submit" name="tambah" value="SIMPAN">
	</form>

<?php include('../include/footer.php'); ?>