<?php

require_once("Vivienda.php");
require_once("Hipoteca.php");

class Construccion extends Vivienda
{
  private float $costeConstruccion;
  private float $honorariosLicencia;
  private float $porcentajeEntrada;
  private float $tasaInteresAnual;
  private int $plazo;
  private float $precioSuelo;
  private float $metrosCuadrados;
  protected float $cuota;

  public function __construct(string $nombre, string $fecha, float $superficie, float $costeConstruccion, float $honorariosLicencia, float $porcentajeEntrada, float $tasaInteresAnual, int $plazo, float $precioSuelo)
  {
    parent::__construct($nombre, $fecha, $superficie);
    $this->costeConstruccion = $costeConstruccion;
    $this->honorariosLicencia = $honorariosLicencia;
    $this->porcentajeEntrada = $porcentajeEntrada;
    $this->tasaInteresAnual = $tasaInteresAnual;
    $this->plazo = $plazo;
    $this->precioSuelo = $precioSuelo;
    $this->cuota = Hipoteca::calcularCuotaMensualHipoteca($this->calcularCapital(), $this->tasaInteresAnual, $this->plazo);
  }

  public function calcularPrecioTotal()
  {
    return $this->precioSuelo + $this->superficie * $this->metrosCuadrados * (1 + ($this->honorariosLicencia) / 100);
  }

  public function calcularEntrada()
  {
    return $this->calcularPrecioTotal() * $this->porcentajeEntrada / 100;
  }

  public function calcularCapital()
  {
    return $this->calcularPrecioTotal() - $this->calcularEntrada();
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
    echo "<td>" . "Construcción Propia" . "</td>";
    echo "<td>" . $this->calcularCosteTotal() . "</td>";
    echo "<td>" . $this->superficie . "</td>";
    echo "<td>" . $this->plazo . "</td>";
    echo "<td>" . $this->cuota . "</td>";
    echo "<td>" . $this->calcularCosteTotal() . "</td>";
    echo "</tr>";
  }
}