<?php
	include('config.php');
	include('fungsi.php');

	include('../include/header.php');
?>
	<h2 class="ui header">Perbandingan Kriteria</h2>
	<?php showTabelPerbandingan('kriteria','kriteria'); ?>

<?php include('../include/footer.php'); ?>