<?php
interface ListaViviendas
{
  /**
   * Inserta una vivienda en la última posición de la lista.
   *
   * @param Vivienda $vivienda
   */
  public function insertar_vivienda($vivienda);
  /**
   * Elimina la primera vivienda de la lista y la devuelve.
   *
   * @return Vivienda
   */
  public function eliminar_primera(): Vivienda;
  /**
  * Devuelve un array ordenado por coste total sin modificar la colección
  original.
  *
  * @return array
  */
  public function ordenar_por_coste_total(): array;
}
?>