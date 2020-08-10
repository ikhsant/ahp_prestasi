<?php
    include '../include/header.php';
    $id_user = $_SESSION['id_user'];
?>
<script type="text/javascript" src="../assets/js/Chart.min.js"></script>

<?php  
$jumalah_kriteria = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kriteria"));
$jumalah_alternatif = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM alternatif"));
$jumalah_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE akses_level = 'user' "));

?>

<!-- end query -->
<!-- user -->
<?php if($_SESSION['akses_level'] == "admin"){ ?>
<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <span style="font-size: 50px">
                            <?php echo $jumalah_kriteria ?></span>
                        <div><b>Kriteria</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <span style="font-size: 50px">
                            <?php echo $jumalah_alternatif ?></span>
                        <div><b>Alternatif</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <span style="font-size: 50px">
                            <?php echo $jumalah_user ?></span>
                        <div><b>User</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</div>
<?php } ?>

<?php if($_SESSION['akses_level'] == "admin"){ ?>

<?php } ?>


<h2 class="ui header">Analitycal Hierarchy Process (AHP)</h2>

            <p>Analytic Hierarchy Process (AHP) merupakan suatu model pendukung keputusan yang dikembangkan oleh Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi suatu hirarki. Hirarki  didefinisikan sebagai suatu representasi dari sebuah permasalahan yang kompleks dalam suatu struktur multi level dimana level pertama adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga level terakhir dari alternatif.</p>
            
            <p>AHP membantu para pengambil keputusan untuk memperoleh solusi terbaik dengan mendekomposisi permasalahan kompleks ke dalam bentuk yang lebih sederhana untuk kemudian melakukan sintesis terhadap berbagai faktor yang terlibat dalam permasalahan pengambilan keputusan tersebut. AHP mempertimbangkan aspek kualitatif dan kuantitatif dari suatu keputusan dan mengurangi kompleksitas suatu keputusan dengan membuat perbandingan satu-satu dari berbagai kriteria yang dipilih untuk kemudian mengolah dan memperoleh hasilnya.</p>

            <p>AHP sering digunakan sebagai metode pemecahan masalah dibanding dengan metode yang lain karena alasan-alasan sebagai berikut :</p>

            <ol class="ui list">
                <li>Struktur yang berhirarki, sebagai konsekuesi dari kriteria yang  dipilih, sampai pada subkriteria yang paling dalam.</li>
                <li>Memperhitungkan validitas sampai dengan batas toleransi inkonsistensi berbagai kriteria dan alternatif yang dipilih oleh pengambil keputusan.</li>
                <li>Memperhitungkan daya tahan output analisis sensitivitas pengambilan keputusan.</li>
            </ol>

            <br>

            <h3 class="ui header">Tabel Tingkat Kepentingan menurut Saaty (1980)</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nilai Numerik</th>
                        <th>Tingkat Kepentingan <em>(Preference)</em></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="center aligned">1</td>
                        <td>Sama pentingnya <em>(Equal Importance)</em></td>
                    </tr>
                    <tr>
                        <td class="center aligned">2</td>
                        <td>Sama hingga sedikit lebih penting</td>
                    </tr>
                    <tr>
                        <td class="center aligned">3</td>
                        <td>Sedikit lebih penting <em>(Slightly more importance)</em></td>
                    </tr>
                    <tr>
                        <td class="center aligned">4</td>
                        <td>Sedikit lebih hingga jelas lebih penting</td>
                    </tr>
                    <tr>
                        <td class="center aligned">5</td>
                        <td>Jelas lebih penting <em>(Materially more importance)</em></td>
                    </tr>
                    <tr>
                        <td class="center aligned">6</td>
                        <td>Jelas hingga sangat jelas lebih penting</td>
                    </tr>
                    <tr>
                        <td class="center aligned">7</td>
                        <td>Sangat jelas lebih penting <em>(Significantly more importance)</em></td>
                    </tr>
                    <tr>
                        <td class="center aligned">8</td>
                        <td>Sangat jelas hingga mutlak lebih penting</td>
                    </tr>
                    <tr>
                        <td class="center aligned">9</td>
                        <td>Mutlak lebih penting <em>(Absolutely more importance)</em></td>
                    </tr>
                </tbody>
            </table>

            <a href="bobot_kriteria.php" class="btn btn-primary btn-lg">LANJUTKAN</a>


<?php  
include '../include/footer.php';
?>