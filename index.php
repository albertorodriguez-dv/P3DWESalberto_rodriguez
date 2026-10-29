<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Práctica UT3 | Comparador de vivienda</title>
</head>

<body>
  <h1>Comparador de vivienda</h1>
  <form action="index.php" method="POST">
    <label for="selector-vivienda">Elige tu tipo de vivienda:</label>
    <select name="selector-vivienda" id="">
      <option value="Compra">Compra</option>
      <option value="Alquiler">Alquiler</option>
      <option value="Construccion">Construcción Propia</option>
    </select>
    <button type="submit" name="enviar-vivienda">Enviar</button>
  </form>

  <form action="index.php" method="POST">
    <button type="submit" name="agregar-vivienda">Añadir Vivienda</button>
    <button type="submit" name="comparar">Comparar</button>
    <label for="ordenar-mayor-menor"><input type="checkbox" name="ordenar-mayor-menor" id="">Ordenar de mayor a
      menor</label>
  </form>
</body>

</html>