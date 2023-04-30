<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de compras
 */
class comprasController extends Controller {
  function __construct()
  {
    // Validación de sesión de usuario, descomentar si requerida
    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }
  }
  
  function index()
  {
    Redirect::back();
  }

  /**
   * Página de agradecimiento de compra
   *
   * @param string $hash
   * @return void
   */
  function gracias($hash)
  {
    if (!$compra = compraModel::by_hash($hash)) {
      Flasher::new('No existe la compra en la base de datos.', 'danger');
      Redirect::back();
    }
    
    $data =
    [
      'title' => 'Gracias por tu compra',
      'c'     => $compra
    ];

    View::render('gracias', $data);
  }
}