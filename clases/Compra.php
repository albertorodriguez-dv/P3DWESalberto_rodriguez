<?php

require_once("Vivienda.php");
require_once("Hipoteca.php");

class Compra extends Vivienda
{
  private float $precioVivienda;
  private float $porcentajeEntrada;
  private float $tasaInteresAnual;
  private int $plazo;
  protected float $cuota;

  public function __construct(string $nombre, string $fecha, float $superficie, float $precioVivienda, float $porcentajeEntrada, float $tasaInteresAnual, float $plazo)
  {
    parent::__construct($nombre, $fecha, $superficie);
    $this->precioVivienda = $precioVivienda;
    $this->porcentajeEntrada = $porcentajeEntrada;
    $this->tasaInteresAnual = $tasaInteresAnual;
    $this->plazo = $plazo;
    $this->cuota = Hipoteca::calcularCuotaMensualHipoteca($this->calcularCapital(), $this->tasaInteresAnual, $this->plazo);
  }

  public function calcularEntrada()
  {
    return $this->precioVivienda * $this->porcentajeEntrada / 100;
  }

  public function calcularCapital()
  {
    return $this->precioVivienda - $this->calcularEntrada();
  }

  #[Override]
  public function calcularCosteTotal()
  {
    return $this->calcularEntrada() + 12 * $this->plazo * $this->cuota;
  }

  #[Override]
  public function filaTabla()
  {
    echo "<tr>";
    echo "<td>" . $this->nombre . "</td>";
    echo "<td>" . $this->fecha . "</td>";
    echo "<td>" . "Compra" . "</td>";
    echo "<td>" . $this->precioVivienda . "</td>";
    echo "<td>" . $this->superficie . "</td>";
    echo "<td>" . $this->plazo . "</td>";
    echo "<td>" . $this->cuota . "</td>";
    echo "<td>" . $this->calcularCosteTotal() . "</td>";
    echo "</tr>";
  }
}