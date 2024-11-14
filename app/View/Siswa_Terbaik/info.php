<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h3>Info Weighted Product</h>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Pengertian</h4>
                    </div>
                    <div class="box-body">
                        <p>
                            Metode Weighted Product merupakan sebuah metode di dalam penentuan sebuah keputusan dengan cara perkalian untuk menghubungkan rating atribut, dimana rating setiap atribut harus dipangkatkan dulu dengan bobot atribut yang bersangkutan. Proses tersebut sama halnya dengan proses normalisasi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex">
                <div class="box flex-fill row">
                    <div class="box-header">
                        <h4>Cara Kerja</h4>
                    </div>
                    <div class="box-body">
                        <p>
                            Berikut ini adalah cara kerja dari metode Weighted Product: <br>
                            1.	Menentukan alternatif yang akan menjadi objek penelitian. <br>
                            2.	Menentukan kriteria-kriteria yang akan digunakan untuk menilai alternatif dan memberikan nilai bobot (W) kepada setiap kriteria. <br>
                            3.	Membuat referensi penilaian alternatif sebagai acuan untuk pemberian nilai alternatif. <br>
                            4.	Melakukan normalisasi bobot kriteria dengan rumus sebagai berikut: 
                        </p>
                        <img id="NormalisasiBobot" src="/assets/images/NormalisasiBobot.png" alt="W_j=W_j/(∑▒W_j )" style="display: block; width: 135px; height: 135px; object-fit: contain;">
                        <img id="NormalisasiBobot-light" src="/assets/images/NormalisasiBobot-light.png" alt="W_j=W_j/(∑▒W_j )" style="display: none; width: 135px; height: 135px; object-fit: contain;">
                        <pre>
Keterangan:
∑Wj = 1 
W : Bobot kriteria
j : Kriteria

                        </pre>
                        <p>
                        5.	Memberikan nilai pada setiap alternatif yang ada berdasarkan referensi penilaian alternatif. <br>
                        6.	Melakukan perhitungan skor total (S) pada setiap alternatif dengan rumus sebagai berikut:
                        </p>
                        <img id="vektorS" src="/assets/images/VektorS.png" alt="S_i=∏_(j=1)^n〖X_ij〗^wj" style="display: block; width: 135px; height: 135px; object-fit: contain;">
                        <img id="vektorS-light" src="/assets/images/VektorS-light.png" alt="S_i=∏_(j=1)^n〖X_ij〗^wj" style="display: none; width: 135px; height: 135px; object-fit: contain;">
                        <pre>
Keterangan:
S : Skor dianalogikan dengan vektor S
X : Nilai kriteria
i : Alternatif
n : Banyaknya kriteria

                        </pre>
                        <p>
                        7.	Melakukan perhitungan nilai preferensi (V) setiap alternatif dengan rumus sebagai berikut:
                        </p>
                        <img id="vektorV" src="/assets/images/VektorV.png" alt="V_(i )=  (∏_(j=1)^n▒〖X_ij〗^wj )/(∏_(j=1)^n▒〖(X_j^*)〗^wj )" style="display: block; width: 150px; height: 150px; object-fit: contain;">
                        <img id="vektorV-light" src="/assets/images/VektorV-light.png" alt="V_(i )=  (∏_(j=1)^n▒〖X_ij〗^wj )/(∏_(j=1)^n▒〖(X_j^*)〗^wj )" style="display: none; width: 150px; height: 150px; object-fit: contain;">
                        <pre>
Keterangan:
V : Preferensi alternatif dianalogikan sebagai vektor V
* : Banyaknya kriteria yang telah dinilai pada vektor S
                        </pre>
                        <p>
                        8.	Mengurutkan peringkat alternatif berdasarkan nilai vektor V yang telah diperoleh. Nilai vektor V tertinggi adalah alternatif terbaik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function toggleImageSource() {
        const current = document.documentElement.getAttribute('data-bs-theme');
        const imageW = document.getElementById('NormalisasiBobot');
        const imageWLight = document.getElementById('NormalisasiBobot-light');
        const imageS = document.getElementById('vektorS');
        const imageSLight = document.getElementById('vektorS-light');
        const imageV = document.getElementById('vektorV');
        const imageVLight = document.getElementById('vektorV-light');

        if (current === 'dark') {
            imageW.style.display = 'none';
            imageWLight.style.display = 'block';
            imageS.style.display = 'none';
            imageSLight.style.display = 'block';
            imageV.style.display = 'none';
            imageVLight.style.display = 'block';
        } else {
            imageW.style.display = 'block';
            imageWLight.style.display = 'none';
            imageS.style.display = 'block';
            imageSLight.style.display = 'none';
            imageV.style.display = 'block';
            imageVLight.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('vektorS')) {
        toggleImageSource();
    }
});

</script>