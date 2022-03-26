<?php

// Saol 1
$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";

// Memecah string menjadi array
$nilai_arr = explode(" ", $nilai);

$jumlah_nilai = count($nilai_arr);
$total_nilai = array_sum($nilai_arr);
$rata_rata = $total_nilai / $jumlah_nilai;


asort($nilai_arr, SORT_NUMERIC);
// Mencari 7 niali terendah
$terendah = array_slice($nilai_arr, 0, 7, true);
$nilai_terendah = '';
foreach ($terendah as $isi) {
  $nilai_terendah .= $isi . ' ';
}
$nilai_terendah = substr($nilai_terendah, 0, -1);

// Mencari 7 niali tertinggi
$tertinggi = array_slice($nilai_arr, -7, 7, true);
$nilai_tertinggi = '';
foreach ($tertinggi as $isi) {
  $nilai_tertinggi .= $isi . ' ';
}
$nilai_tertinggi = substr($nilai_tertinggi, 0, -1);
?>

</html>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <title>PHP Dasar</title>
</head>

<body>

  <div class="container">
    <div class="row justify-content-between mt-4">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <strong>Soal 1</strong>
          </div>
          <div class="card-body">
            <p class="card-text">
              Nilai : "<?php echo $nilai; ?>"
            </p>
            <i class="bi bi-record-fill"></i> Rata-rata nilai adalah <?php echo round($rata_rata, 2); ?><br>
            <i class="bi bi-record-fill"></i> 7 nilai terendah adalah <?php echo $nilai_terendah; ?><br>
            <i class="bi bi-record-fill"></i> 7 nilai tertinggi adalah <?php echo $nilai_tertinggi; ?><br>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <strong>Soal 2</strong>
          </div>
          <div class="card-body">
            <h6>Menghitung Jumlah Huruf Kecil</h6>
            <form class="row g-3">
              <div class="col">
                <label for="hurufKecil" class="visually-hidden">Data</label>
                <input type="text" name="input1" class="form-control" id="hurufKecil">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Cek</button>
              </div>
            </form>
            <?php
            if (isset($_GET['input1'])) {
              $data = $_GET['input1'];

              if (!empty($data)) {
                // Memecah kata menjadi array
                $data_array = str_split($data);

                $jumlah_huruf_kecil = 0;
                foreach ($data_array as $isi) {
                  if (ctype_lower($isi)) {
                    $jumlah_huruf_kecil += 1;
                  }
                }
                echo '<i class="bi bi-record-fill"></i> "' . $data . '" mengandung ' . $jumlah_huruf_kecil . ' huruf kecil';
              } else {
                echo '<i class="bi bi-exclamation-circle-fill"></i> Data tidak boleh kosong!';
              }
            }
            ?>
          </div>
        </div>
      </div>

      <div class="col-6 mt-4">
        <div class="card">
          <div class="card-header">
            <strong>Soal 3</strong>
          </div>
          <div class="card-body">
            <h6>Membentuk Unigram, Bigram dan Trigram</h6>
            <form class="row g-3">
              <div class="col">
                <label for="data1" class="visually-hidden">Data</label>
                <input type="text" name="input2" class="form-control" id="data1">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Mulai</button>
              </div>
            </form>
            <?php
            if (isset($_GET['input2'])) {
              $data = $_GET['input2'];

              if (!empty($data)) {
                // Memecah kata menjadi array
                $data_arr = explode(" ", strtolower($data));
                $index_terakhir = $jumlah_nilai = count($data_arr) - 1;

                // Unigram
                $j = 0;
                $unigram = '';
                foreach ($data_arr as $isi) {
                  if ($j == $index_terakhir) {
                    $unigram .= $isi;
                    $j = 0;
                  } else {
                    $unigram .= $isi . '<a class="text-danger">,</a> ';
                    $j++;
                  }
                }

                // Bigram
                $i = 0;
                $bigram = '';
                foreach ($data_arr as $isi) {
                  if ($j == $index_terakhir) {
                    $bigram .= $isi;
                    $j = 0;
                  } else  if ($i < 1) {
                    $bigram .= $isi . ' ';
                    $i++;
                    $j++;
                  } else {
                    $bigram .= $isi . '<a class="text-danger">,</a> ';
                    $i = 0;
                    $j++;
                  }
                }

                // Trigram
                $i = 0;
                $trigram = '';
                foreach ($data_arr as $isi) {
                  if ($j == $index_terakhir) {
                    $trigram .= $isi;
                    $j = 0;
                  } else if ($i < 2) {
                    $trigram .= $isi . ' ';
                    $i++;
                    $j++;
                  } else {
                    $trigram .= $isi . '<a class="text-danger">,</a> ';
                    $i = 0;
                    $j++;
                  }
                }

                echo '"' . $data . '" <br>';
                echo '<i class="bi bi-record-fill"></i> Unigram : ' . $unigram . '<br>';
                echo '<i class="bi bi-record-fill"></i> Bigram : ' . $bigram . '<br>';
                echo '<i class="bi bi-record-fill"></i> Trigram : ' . $trigram . '<br>';
              } else {
                echo '<i class="bi bi-exclamation-circle-fill"></i> Data tidak boleh kosong!';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>