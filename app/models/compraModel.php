<?php

/**
 * Plantilla general de modelos
 * Versión 1.0.1
 *
 * Modelo de compra
 */
class compraModel extends Model {
  public static $t1   = 'compras'; // Nombre de la tabla en la base de datos;
  public static $t2   = 'compras_items';
  
  // Nombre de tabla 2 que talvez tenga conexión con registros
  //public static $t2 = '__tabla 2___'; 
  //public static $t3 = '__tabla 3___'; 

  function __construct()
  {
    // Constructor general
  }
  
  static function all()
  {
    // Todos los registros
    $sql = 'SELECT * FROM compras ORDER BY id DESC';
    return ($rows = parent::query($sql)) ? $rows : [];
  }

  static function by_id($id)
  {
    // Un registro con $id
    $sql = 'SELECT * FROM compras WHERE id = :id LIMIT 1';
    return ($rows = parent::query($sql, ['id' => $id])) ? $rows[0] : [];
  }

  static function by_usuario($id)
  {
    // Un registro con $id
    $sql = 'SELECT * FROM compras WHERE id_usuario = :id ORDER BY id DESC';
    return ($rows = parent::query($sql, ['id' => $id])) ? $rows : [];
  }

  static function by_numero($numero)
  {
    // Un registro con $id
    $sql  = 'SELECT * FROM compras WHERE numero = :numero LIMIT 1';
    
    if (!$rows = parent::query($sql, ['numero' => $numero])) {
      return [];
    }

    // Cargar todos los items de la compra
    $row          = $rows[0];
    $row['items'] = self::get_items($row['id']);

    return $row;
  }

  static function by_hash($hash)
  {
    // Un registro con $id
    $sql  = 'SELECT * FROM compras WHERE hash = :hash LIMIT 1';
    
    if (!$rows = parent::query($sql, ['hash' => $hash])) {
      return [];
    }

    // Cargar todos los items de la compra
    $row          = $rows[0];
    $row['items'] = self::get_items($row['id']);

    return $row;
  }

  static private function get_items($id_compra)
  {
    $sql = 'SELECT ci.* FROM compras_items ci WHERE ci.id_compra = :id ORDER BY ci.id DESC';
    return ($rows = parent::query($sql, ['id' => $id_compra])) ? $rows : [];
  }
}

