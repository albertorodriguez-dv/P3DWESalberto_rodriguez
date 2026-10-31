<?php

abstract class Vivienda
{
  protected string $nombre;
  protected string $fecha;
  protected float $superficie;

  public function __construct(string $nombre, string $fecha, float $superficie)
  {
    $this->nombre = $nombre;
    $this->fecha = $fecha;
    $this->superficie = $superficie;
  }

  abstract public function calcularCosteTotal();

  abstract public function filaTabla();
}