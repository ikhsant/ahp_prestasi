<?php

include('config.php');
include('fungsi.php');


// menghitung perangkingan
$jmlKriteria 	= getJumlahKriteria();
$jmlAlternatif	= getJumlahAlternatif();
$nilai			= array();

// mendapatkan nilai tiap alternatif
for ($x=0; $x <= ($jmlAlternatif-1); $x++) {
	// inisialisasi
	$nilai[$x] = 0;

	for ($y=0; $y <= ($jmlKriteria-1); $y++) {
		$id_alternatif 	= getAlternatifID($x);
		$id_kriteria	= getKriteriaID($y);

		$pv_alternatif	= getAlternatifPV($id_alternatif,$id_kriteria);
		$pv_kriteria	= getKriteriaPV($id_kriteria);

		$nilai[$x]	 	+= ($pv_alternatif * $pv_kriteria);
	}
}

// update nilai ranking
for ($i=0; $i <= ($jmlAlternatif-1); $i++) { 
	$id_alternatif = getAlternatifID($i);
	$query = "INSERT INTO ranking VALUES ($id_alternatif,$nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
	$result = mysqli_query($koneksi,$query);
	if (!$result) {
		echo "Gagal mengupdate ranking";
		exit();
	}
}

include('../include/header.php');

?>
<script type="text/javascript" src="../assets/js/Chart.min.js"></script>

	<h2 class="ui header">Hasil Perhitungan</h2>
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>Overall Composite Height</th>
			<th>Priority Vector (rata-rata)</th>
			<?php
			for ($i=0; $i <= (getJumlahAlternatif()-1); $i++) { 
				echo "<th>".getAlternatifNama($i)."</th>\n";
			}
			?>
		</tr>
		</thead>
		<tbody>

		<?php
			for ($x=0; $x <= (getJumlahKriteria()-1) ; $x++) { 
				echo "<tr>";
				echo "<td>".getKriteriaNama($x)."</td>";
				echo "<td>".round(getKriteriaPV(getKriteriaID($x)),5)."</td>";

				for ($y=0; $y <= (getJumlahAlternatif()-1); $y++) { 
					echo "<td>".round(getAlternatifPV(getAlternatifID($y),getKriteriaID($x)),5)."</td>";
				}


				echo "</tr>";
			}
		?>
		</tbody>

		<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<?php
			for ($i=0; $i <= ($jmlAlternatif-1); $i++) { 
				echo "<th>".round($nilai[$i],5)."</th>";
			}
			?>
		</tr>
		</tfoot>

	</table>


	<h2 class="ui header">Perangkingan</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Peringkat</th>
				<th>Alternatif</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query  = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
				$result = mysqli_query($koneksi, $query);

				$i = 0;
				while ($row = mysqli_fetch_array($result)) {
					$i++;
				?>
				<tr>
					<?php if ($i == 1) {
						echo "<td><b>Pertama</b></td>";
					} else {
						echo "<td>".$i."</td>";
					}

					?>

					<td><?php echo $row['nama'] ?></td>
					<td><?php echo $row['nilai'] ?></td>
				</tr>

				<?php	
				}


			?>
		</tbody>
	</table>

	<?php $jumlah = mysqli_num_rows($result); ?>
	<div style="max-width: 400px; margin: auto; margin-bottom: 100px" class="text-center">
		<h3>Chart</h3>
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>

<script>
	function poolColors(a) {
	    var pool = [];
	    for(i = 0; i < a; i++) {
	        pool.push(dynamicColors());
	    }
	    return pool;
	}

	function dynamicColors() {
	    var r = Math.floor(Math.random() * 255);
	    var g = Math.floor(Math.random() * 255);
	    var b = Math.floor(Math.random() * 255);
	    return "rgba(" + r + "," + g + "," + b + ", 0.5)";
	}

	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: [
	        	<?php  
	        		foreach($result as $row){
	        			echo "'".$row['nama']."',";
	        		}
	        	?>
	        ],
	        datasets: [{
	            label: '# Rank',
	            data: [
	            	<?php  
	        		foreach($result as $row){
	        			echo "'".$row['nilai']."',";
	        		}
	        		?>
	            ],
	            backgroundColor: poolColors(<?= $jumlah ?>),
			    borderColor: poolColors(<?= $jumlah ?>),
			    borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
	</script>

<?php include('footer.php'); ?>