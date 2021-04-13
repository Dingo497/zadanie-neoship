<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <?php
  // show errors
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
  ?>

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
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry the Bird</td>
        <td>@twitter</td>
        <td>something</td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>