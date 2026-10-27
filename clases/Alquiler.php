<?php

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
    if ($this->subidaAnual == 0) {
      return 12 * $this->rentaMensual * $this->plazo;
    }

    return 12 * $this->rentaMensual * (pow(1 + $this->subidaAnual, $this->plazo) - 1) / $this->subidaAnual;
  }
}