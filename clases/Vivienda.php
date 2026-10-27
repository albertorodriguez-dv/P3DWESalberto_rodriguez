<?php

abstract class Vivienda
{
  private string $nombre;
  private string $fecha;
  private float $superficie;

  abstract function calcularCosteTotal();
}