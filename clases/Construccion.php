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

  public function __construct(float $costeConstruccion, float $honorariosLicencia, float $porcentajeEntrada, float $tasaInteresAnual, int $plazo, float $precioSuelo, float $metrosCuadrados)
  {
    $this->costeConstruccion = $costeConstruccion;
    $this->honorariosLicencia = $honorariosLicencia;
    $this->porcentajeEntrada = $porcentajeEntrada;
    $this->tasaInteresAnual = $tasaInteresAnual;
    $this->plazo = $plazo;
    $this->precioSuelo = $precioSuelo;
    $this->metrosCuadrados = $metrosCuadrados;
    $this->cuota = Hipoteca::calcularCuotaMensualHipoteca($this->calcularCapital(), $this->tasaInteresAnual, $this->plazo);
  }

  public function calcularPrecioTotal()
  {
    return $this->precioSuelo + $this->superficie * $this->metrosCuadrados * (1 + ($this->honorariosLicencia) / 100);
  }

  public function calcularEntrada()
  {
    return $this->calcularPrecioTotal() * $this->porcentajeEntrada;
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
}