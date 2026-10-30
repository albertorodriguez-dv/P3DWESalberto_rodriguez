<?php
require_once("ColeccionViviendas.php");
require_once("clases/ViviendaAlquiler.php");
require_once("clases/ViviendaCompra.php");
require_once("clases/ViviendaConstruccion.php");

session_start();

if (!isset($_SESSION["coleccion"])) {
    $_SESSION["coleccion"] = new ColeccionViviendas();
}

$tipoVivienda = $_POST["selector-vivienda"] ?? "";
$errores = [];


if (isset($_POST["agregar-vivienda"])) {
    $rangos = [];

    if ($tipoVivienda === "Alquiler") {
        $rangos = [
            "renta-mensual" => [300, 2500],
            "subida-anual" => [0, 5],
            "plazo" => [1, 30],
            "superficie" => [40, 400]
        ];
    } elseif ($tipoVivienda === "Compra") {
        $rangos = [
            "precio" => [50000, 800000],
            "porcentaje-entrada" => [10, 50],
            "tasa-interes" => [0.5, 8],
            "plazo" => [5, 30],
            "superficie" => [40, 400]
        ];
    } elseif ($tipoVivienda === "Construccion") {
        $rangos = [
            'precio-suelo' => [20000, 300000],
            'porcentaje-entrada' => [10, 50],
            'tasa-interes' => [0.5, 8],
            'plazo' => [5, 30],
            'coste-construccion' => [600, 1500],
            'honorarios-licencias' => [5, 20],
            'superficie' => [40, 400]
        ];
    }

    foreach ($rangos as $campo => $rango) {
        $valor = $_POST[$campo] ?? "";

        if ($valor === "" || !is_numeric($valor) || $valor < $rango[0] || $valor > $rango[1]) {
            $errores[] = "El valor del campo '$campo' no es correcto (debe estar entre {$rango[0]} y {$rango[1]}).";
        }
    }

    if (empty($errores)) {

    }
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

            <label>Tasa de interés anual (%):</label>
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
            <input type='number' name='renta-mensual'>

            <label>Subida anual (%):</label>
            <input type='number' name='subida-anual'>

            <label>Plazo (en años):</label>
            <input type='number' name='plazo'>

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
            <input type='number' name='precio-suelo'>

            <label>Entrada (%):</label>
            <input type='number' name='porcentaje-entrada'>

            <label>Tasa de interés anual (%):</label>
            <input type='number' name='tasa-interes'>

            <label>Plazo (en años):</label>
            <input type='number' name='plazo'>

            <label>Coste de construcción:</label>
            <input type='number' name='coste-construccion'>

            <label>Honorarios y licencias (%):</label>
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
            <option value="Compra" <?php if ($tipoVivienda == "Compra")
                echo "selected"; ?>>
                Compra
            </option>
            <option value="Alquiler" <?php if ($tipoVivienda == "Alquiler")
                echo "selected"; ?>>
                Alquiler
            </option>
            <option value="Construccion" <?php if ($tipoVivienda == "Construccion")
                echo "selected"; ?>>
                Construcción propia
            </option>
        </select>

        <button type="submit" name="enviar-vivienda">Enviar</button>
    </form>

    <?php
    if (!empty($errores)) {
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }

    echo $formulario;
    ?>

    <hr>

    <form action="index.php" method="POST">
        <button type="submit" name="comparar">Comparar</button>
        <button type="submit" name="eliminar-primero">Eliminar primero</button>

        <label for="ordenar-mayor-menor">
            <input type="checkbox" name="ordenar-mayor-menor" id="ordenar-mayor-menor">
            Ordenar por coste total
        </label>
    </form>

</body>

</html>