<?php

require_once("clases/Vivienda.php");
require_once("clases/ListaViviendas.php");

class ColeccionViviendas implements ListaViviendas
{
  private array $viviendas = [];

  public function getViviendas(): array
  {
    return $this->viviendas;
  }

  #[Override]
  public function insertar_vivienda($vivienda): void
  {
    $this->viviendas[] = $vivienda;
  }

  #[Override]
  public function eliminar_primera(): Vivienda
  {
    if (empty($this->viviendas)) {
      echo "ERROR: No hay viviendas";
    }

    return array_shift($this->viviendas);
  }

  #[Override]
  public function ordenar_por_coste_total(): array
  {
    $viviendasOrdenadas = $this->viviendas;

    usort($viviendasOrdenadas, function ($a, $b) {
      return $a->calcularCosteTotal() <=> $b->calcularCosteTotal();
    });

    return $viviendasOrdenadas;
  }
}