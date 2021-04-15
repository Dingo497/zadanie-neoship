<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <?php session_start(); ?>

    <title>Zadanie Neoship</title>
  </head>
<body>

<div class="container text-center">
  <div class="row">
    <div class="mt-4">
      <h3 class="mb-3">
        Aplikacia na vypocet ceny zasielok
      </h3>
      <hr class="my-4">
      <form action="inc/excel_convertor.php" method="POST" enctype="multipart/form-data">
        <div class="card card-body">
          <div class="row justify-content-center">
            <div class="col-2 my-auto">
              <h4>Select File</h4>
            </div>
            <div class="col-4">
              <input type="file" name="import_file" class="form-control">
            </div>
            <div class="col-2">
              <button type="submit" name="submit_import" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
    

  <table class="table mt-5">
    <thead>
      <tr>
        <th>Referenčné číslo</th>
        <th>Krajina</th>
        <th>Váha</th>
        <th>Dobierka bez DPH</th>
        <th>Spolu doprava bez DPH</th>
        <th>Spolu doprava s DPH</th>
        <th>Spolu zasielka</th>
      </tr>
    </thead>
    <tbody>

<?php if (!empty($_SESSION['final_array'])) : //session_destroy(); ?>
  <?php foreach ($_SESSION['final_array'] as $value) : ?>

      <tr>
        <td><a href=""><?php echo $value['referenčné číslo'] ?></a></td>
        <td><?php echo $value['príjemca-štát'] ?></td>
        <td><?php echo $value['váha'] . " kg" ?></td>
        <td><?php
          if (!empty($value['dobierka'])) {
            echo $value['dobierka'] . " €";
          }else{
            echo "0 €";
          }
        ?></td>
        <td><?php echo $value['total without DPH'] . " €" ?></td>
        <td><?php echo $value['total with DPH'] . " €" ?></td>
        <td><?php echo $value['total with DPH and package'] . " €" ?></td>
      </tr>

  <?php endforeach ?>
<?php endif ?>

    </tbody>
  </table>

</div>

</body>
</html>
