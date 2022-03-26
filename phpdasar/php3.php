<?php

$arr = [
  ['f', 'g', 'h', 'i'],
  ['j', 'k', 'p', 'q'],
  ['r', 's', 't', 'u']
];

function cari(array $arr, string $kata)
{
  $current_position = [];
  $kata_split = str_split($kata);

  foreach ($kata_split as $ks) {
    foreach ($arr as $outer => $value) {
      $inner = array_search($ks, array_column($value, null));
      if ($inner !== false) {
        if (!is_sibling($current_position, [$outer, $inner])) {
          return false;
        }
        $current_position = [$outer, $inner];
      }
    }
  }
  return true;
}

function is_sibling(array $current, array $next)
{
  if (empty($current)) {
    return true;
  }

  // to right
  if ([$current[0], $current[1] + 1] == $next) {
    return true;
  }
  // to left
  if ([$current[0], $current[1] - 1] == $next) {
    return true;
  }
  // to top
  if ([$current[0] - 1, $current[1]] == $next) {
    return true;
  }
  // to bottom
  if ([$current[0] + 1, $current[1]] == $next) {
    return true;
  }
  return false;
}

$cariKata[0] = cari($arr, 'fghi');
$cariKata[1] = cari($arr, 'fghp');
$cariKata[2] = cari($arr, 'fjrstp');
$cariKata[3] = cari($arr, 'fghq');
$cariKata[4] = cari($arr, 'fst');
$cariKata[5] = cari($arr, 'pqr');
$cariKata[6] = cari($arr, 'fghh');
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

  <title>PHP Dasar 3</title>
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
            <h6>Pencarian Kata</h6>
            <div class="row">
              <a>
                cari($arr, 'fghi') :
                <?php if ($cariKata[0] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>

              <a>
                cari($arr, 'fghp') :
                <?php if ($cariKata[1] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>

              <a>
                cari($arr, 'fjrstp') :
                <?php if ($cariKata[2] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>
              <p></p>
              <a>
                cari($arr, 'fghq') :
                <?php if ($cariKata[3] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>

              <a>
                cari($arr, 'fst') :
                <?php if ($cariKata[4] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>

              <a>
                cari($arr, 'pqr') :
                <?php if ($cariKata[5] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>

              <a>
                cari($arr, 'fghh') :
                <?php if ($cariKata[6] == 1) {
                  echo 'True';
                } else {
                  echo 'False';
                } ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>