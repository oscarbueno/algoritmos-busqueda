<!DOCTYPE html>

<html lang="es">

<head>
  <title>AB En Ambientes Discretos</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="resources/bootstrap/css/style1.css" />
  <link rel="shortcut icon" href="/favicon.ico" />

  <style>

  </style>

</head>

<body>

  <div class="container">

    <form class="form-signin" action="src/main.php" method="GET">
      <h2 class="form-signin-heading text-center">AB En Ambientes Discretos</h2>
      <label for="inputEmail" class="">Seleccioné Algoritmo</label>
      <select class="form-control" name="algoritmo">
        <option value="1">Wall Tracing</option>
        <option value="2">Waypoint Navigation</option>
      </select>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Calcular</button>
    </form>

  </div>
  <!-- /container -->

</body>

</html>