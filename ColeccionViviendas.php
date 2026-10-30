<?php

require_once("clases\Vivienda.php");
require_once("clases\ListaViviendas.php");

class ColeccionViviendas implements ListaViviendas
{
  private array $viviendas = [];

  #[Override]
  public function insertar_vivienda($vivienda): void
  {
    $this->viviendas[] = $vivienda;
  }

  #[Override]
  public function eliminar_primera(): Vivienda
  {
    if (empty($this->viviendas)) {
      throw new UnderflowException("La colección está vacía");
    }

    return array_shift($this->viviendas);
  }

  #[Override]
  public function ordenar_por_coste_total(): array
  {
    $viviendasOrdenadas = $this->viviendas;

    usort($viviendasOrdenadas, function ($a, $b) {
      return $a->get_coste_total() <=> $b->get_coste_total();
    });

    return $viviendasOrdenadas;
  }
}