<?php

abstract class Vivienda
{
  private string $nombre;
  private string $fecha;
  private float $superficie;

  public function __construct(string $nombre, string $fecha, float $superficie)
  {
    $this->nombre = $nombre;
    $this->fecha = $fecha;
    $this->superficie = $superficie;
  }

  abstract public function calcularCosteTotal();
}