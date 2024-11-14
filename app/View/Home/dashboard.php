<main class="content px-3 py-2">
    <div class="container-fluid">
        <?php if (isset($model['error'])) { ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    <?= $model['error'] ?>
                </div>
            </div>
        <?php } ?>
        <div class="container mt-4">
            <h3 class="mb-4">Dashboard</h3>
            <div class="row">
                <div class="col-12 ">
                    <div class="text-center mb-3 alert alert-info">
                        <h3>Selamat Datang Kembali <?= $model['user']['role'] ?>, <?= $model['user']['name'] ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Siswa <br>
                                <?= count($model['siswaList']) ?></h5>
                        </div>
                        <a href="/siswa" class="card-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Kriteria <br>
                                <?= count($model['kriteriaList']) ?></h5>
                        </div>
                        <a href="/kriteria" class="card-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Data Nilai Alternatif <br>
                                <?= count($model['nilaiAlternatifList']) ?></h5>
                        </div>
                        <a href="/nilai-alternatif" class="card-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <h2 class="mt-3">Statistik Penilaian</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            5 Siswa Terbaik Berdasarkan Perhitungan Weighted Product
                        </div>
                        <div class="card-body">
                            <canvas id="peringkatChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    var ctx = document.getElementById("peringkatChart").getContext("2d");
    var barChartData = {
        labels: [
            <?php $limitedSiswaList = array_slice($model['peringkatSiswa'], 0, 5);
            foreach ($limitedSiswaList as $peringkatSiswa) {
                echo '"' . $peringkatSiswa['nama'] . '",';
            } ?>
        ],
        datasets: [{
            label: 'Vektor V',
            backgroundColor: "rgba(75, 192, 192, 0.75)",  // Teal
            borderColor: "rgba(54, 162, 235, 1)",  // Light blue
            hoverBackgroundColor: "rgba(255, 159, 64, 0.75)",  // Orange
            hoverBorderColor: "rgba(255, 99, 132, 1)",  // Pink
            data: [
                <?php foreach ($limitedSiswaList as $peringkatSiswa) {
                    echo $peringkatSiswa['v'] . ',';
                } ?>
            ]
        }]
    };

    window.onload = function() {
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };
</script>