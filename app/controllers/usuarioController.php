<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de usuario
 */
class usuarioController extends Controller {
  private $user = null;
  private $id   = null;
  private $rol  = null;

  function __construct()
  {
    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }

    $this->user = get_user();
    $this->id   = get_user('id');
    $this->rol  = get_user('rol');

    // Si no es comprador
    if ($this->rol !== 'comprador') {
      Flasher::deny();
      Redirect::to('home');
    }
  }
  
  function index()
  {
    $this->compras();
  }

  function compras()
  {
    $data =
    [
      'title'   => 'Mis compras',
      'compras' => compraModel::by_usuario($this->id)
    ];

    View::render('compras', $data);
  }
}