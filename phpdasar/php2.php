<?php

function geser_teks($string, $key)
{
  return implode('', array_map(function ($char) use ($key) {
    return geser_karakter($char, $key);
  }, str_split($string)));
}

function geser_karakter($char, $shift)
{
  $shift = $shift % 25;
  $ascii = ord($char);
  $shifted = $ascii + $shift;

  if ($ascii >= 65 && $ascii <= 90) {
    return chr(geser_huruf_besar($shifted));
  }

  if ($ascii >= 97 && $ascii <= 122) {
    return chr(geser_huruf_kecil($shifted));
  }

  if ($ascii >= 33 && $ascii <= 58) {
    return chr(geser_angka($shifted));
  }

  return chr($ascii);
}

function geser_angka($ascii)
{
  if ($ascii < 33) {
    $ascii = 59 - (33 - $ascii);
  }

  if ($ascii > 58) {
    $ascii = ($ascii - 58) + 32;
  }
  return $ascii;
}

function geser_huruf_besar($ascii)
{
  if ($ascii < 65) {
    $ascii = 91 - (65 - $ascii);
  }

  if ($ascii > 90) {
    $ascii = ($ascii - 90) + 64;
  }

  return $ascii;
}

function geser_huruf_kecil($ascii)
{
  if ($ascii < 97) {
    $ascii = 123 - (97 - $ascii);
  }

  if ($ascii > 122) {
    $ascii = ($ascii - 122) + 96;
  }

  return $ascii;
}

function enkripsi($plain_text, $key)
{
  return geser_teks($plain_text, $key);
}

function dekripsi($cipher_text, $key)
{
  return geser_teks($cipher_text, $key);
}
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

  <title>PHP Dasar 2</title>
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
            <?php
            $a = 8;
            ?>
            <table>
              <?php for ($i = 1; $i <= $a; $i++) { ?>
                <tr>
                  <?php for ($j = (($i - 1) * $a) + 1; $j <= ($i * $a); $j++) { ?>
                    <th class="p-3 text-center"><?php echo $j;  ?></th>
                  <?php } ?>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <strong>Soal 2</strong>
          </div>
          <div class="card-body">
            <h6>Enkripsi</h6>
            <form class="row g-3">
              <div class="col">
                <label for="hurufKecil" class="visually-hidden">Data</label>
                <input type="text" name="input1" class="form-control" id="hurufKecil">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Enkripsi</button>
              </div>
            </form>
            <?php
            if (isset($_GET['input1'])) {
              $data = $_GET['input1'];

              if (!empty($data)) {
                // Memecah kata menjadi array
                $data_arr = str_split($data);

                $i = 1;
                // Fungsi enkripsi
                $cipherText = '';
                foreach ($data_arr as $isi) {
                  if ($i % 2 == 0) {
                    $cipherText .= enkripsi($isi, -$i);
                    $i++;
                  } else {
                    $cipherText .= enkripsi($isi, $i);
                    $i++;
                  }
                }
                echo '"' . $data . '" <br>';
                echo '<i class="bi bi-record-fill"></i> Hasil enkripsi : ' . $cipherText . '<br>';
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