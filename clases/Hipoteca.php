<?php
/**
 * Clase para ser utilizada tal cual. No modificar.
 */
class Hipoteca
{
  public static function calcularCuotaMensualHipoteca(
    float $capital,
    float
    $tasaAnual,
    int $anios
  ): float {
    $r = $tasaAnual / 100 / 12;
    $n = $anios * 12;
    if ($r == 0) {
      return $capital / $n;
    }
    return $capital * $r * pow(1 + $r, $n) / (pow(1 + $r, $n) - 1);
  }
}
?>