
<?php
session_start();

$tipoVivienda = "";

if (isset($_POST["selector-vivienda"])) {
    $tipoVivienda = $_POST["selector-vivienda"];
}

$formulario = "";

if ($tipoVivienda == "Compra") {
    $formulario = "
        <h2>Datos de la vivienda en compra</h2>

        <form action='index.php' method='POST'>
            <input type='hidden' name='selector-vivienda' value='Compra'>

            <label>Precio de la vivienda:</label>
            <input type='number' name='precio'>

            <label>Entrada (%):</label>
            <input type='number' name='porcentaje-entrada'>

            <label>Tasa de interés anual:</label>
            <input type='number' name='tasa-interes'>

            <label>Plazo (en años):</label>
            <input type='number' name='plazo'>

            <label>Superficie (m²):</label>
            <input type='number' name='superficie'>

            <button type='submit' name='agregar-vivienda'>Añadir vivienda</button>
        </form>
    ";
} elseif ($tipoVivienda == "Alquiler") {
    $formulario = "
        <h2>Datos de la vivienda en alquiler</h2>

        <form action='index.php' method='POST'>
            <input type='hidden' name='selector-vivienda' value='Alquiler'>

            <label>Renta mensual:</label>
            <input type='number' name='precio'>

            <label>Subida anual (%):</label>
            <input type='number' name='localidad'>

            <label>Plazo (en años):</label>
            <input type='number' name='localidad'>

            <label>Superficie (m²):</label>
            <input type='number' name='superficie'>

            <button type='submit' name='agregar-vivienda'>Añadir vivienda</button>
        </form>
    ";
} elseif ($tipoVivienda == "Construccion") {
    $formulario = "
        <h2>Datos de la vivienda de construcción propia</h2>

        <form action='index.php' method='POST'>
            <input type='hidden' name='selector-vivienda' value='Construccion'>

            <label>Precio del suelo:</label>
            <input type='number' name='precio'>

            <label>Entrada (%):</label>
            <input type='number' name='porcentaje-entrada'>

            <label>Tasa de interés anual:</label>
            <input type='number' name='tasa-interes'>

            <label>Plazo (en años):</label>
            <input type='number' name='plazo'>

            <label>Coste de construcción:</label>
            <input type='number' name='coste-construccion'>

            <label>Honorarios y licencias:</label>
            <input type='number' name='honorarios-licencias'>  
            
            <label>Superficie (m²):</label>
            <input type='number' name='superficie'>

            <button type='submit' name='agregar-vivienda'>Añadir vivienda</button>
        </form>
    ";
}
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

        <select name="selector-vivienda" id="selector-vivienda">
            <option value="Compra"
                <?php
                if ($tipoVivienda == "Compra") {
                    echo "selected";
                }
                ?>>
                Compra
            </option>

            <option value="Alquiler"
                <?php
                if ($tipoVivienda == "Alquiler") {
                    echo "selected";
                }
                ?>>
                Alquiler
            </option>

            <option value="Construccion"
                <?php
                if ($tipoVivienda == "Construccion") {
                    echo "selected";
                }
                ?>>
                Construcción propia
            </option>
        </select>

        <button type="submit" name="enviar-vivienda">Enviar</button>
    </form>

    <?php
    echo $formulario;
    ?>

    <hr>

    <form action="index.php" method="POST">
        <button type="submit" name="comparar">Comparar</button>

        <label for="ordenar-mayor-menor">
            <input type="checkbox" name="ordenar-mayor-menor"
                id="ordenar-mayor-menor">
            Ordenar de mayor a menor
        </label>
    </form>

</body>
</html>
