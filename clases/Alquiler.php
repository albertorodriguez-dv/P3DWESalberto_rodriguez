<?php

require_once("Vivienda.php");

class Alquiler extends Vivienda
{
  private float $rentaMensual;
  private float $subidaAnual;
  private int $plazo;

  public function __construct(string $nombre, string $fecha, float $superficie, float $rentaMensual, float $subidaAnual, int $plazo)
  {
    parent::__construct($nombre, $fecha, $superficie);
    $this->rentaMensual = $rentaMensual;
    $this->subidaAnual = $subidaAnual;
    $this->plazo = $plazo;
  }

  #[Override]
  public function calcularCosteTotal()
  {
    $s = $this->subidaAnual / 100;

    if ($s == 0) {
      return 12 * $this->rentaMensual * $this->plazo;
    }

    return 12 * $this->rentaMensual * (pow(1 + $s, $this->plazo) - 1) / $s;
  }

  #[Override]
  public function filaTabla()
  {
    echo "<tr>";
    echo "<td>" . $this->nombre . "</td>";
    echo "<td>" . $this->fecha . "</td>";
    echo "<td>" . "Alquiler" . "</td>";
    echo "<td>" . $this->rentaMensual . "</td>";
    echo "<td>" . $this->superficie . "</td>";
    echo "<td>" . $this->plazo . "</td>";
    echo "<td>" . "-" . "</td>";
    echo "<td>" . $this->calcularCosteTotal() . "</td>";
    echo "</tr>";
  }
}