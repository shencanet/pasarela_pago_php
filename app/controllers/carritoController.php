<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de carrito
 */
class carritoController extends Controller {
  function __construct()
  {
    // Validación de sesión de usuario, descomentar si requerida
    /**
    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }
    */
  }
  
  function index()
  {
    $carrito = new Carrito();
    $carrito = $carrito->cargar_carrito();

    $data = 
    [
      'title'   => 'Tu carrito',
      'carrito' => $carrito,
      'auth'    => Auth::validate()
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

  function agregar()
  {
    try {
      if (!check_get_data(['_t','id_producto'], $_GET) || !Csrf::validate($_GET["_t"])) {
        throw new Exception('Acceso no autorizado.');
      }

      // Validamos la existencia del producto
      $id_producto   = clean($_GET["id_producto"]);
      if (!$producto = get_producto($id_producto)) {
        throw new Exception('El producto no existe en la base de datos.');
      }

      // Agregamos el producto al carrito
      $producto['cantidad'] = 1;
      if (!Carrito::agregar($producto)) {
        throw new Exception('Hubo un problema al agregar el producto al carrito.');
      }

      // Se agregó con éxito
      Flasher::new(sprintf('<b>%s</b> agregado al carrito con éxito.', $producto['titulo']), 'success');
      Redirect::back();

    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }

  function borrar()
  {
    try {
      if (!check_get_data(['_t','id_producto'], $_GET) || !Csrf::validate($_GET["_t"])) {
        throw new Exception('Acceso no autorizado.');
      }

      // Validamos la existencia del producto
      $id_producto   = clean($_GET["id_producto"]);
      if (!$producto = get_producto($id_producto)) {
        throw new Exception('El producto no existe en la base de datos.');
      }

      // Borrar producto del carrito
      if (!Carrito::borrar($id_producto)) {
        throw new Exception('Hubo un problema al borrar el producto del carrito.');
      }

      // Se borró con éxito
      Flasher::new(sprintf('<b>%s</b> borrado del carrito con éxito.', $producto['titulo']), 'success');
      Redirect::back();

    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }

  function vaciar()
  {
    try {
      if (!check_get_data(['_t'], $_GET) || !Csrf::validate($_GET["_t"])) {
        throw new Exception('Acceso no autorizado.');
      }

      // Vaciamos el carrito
      if (!Carrito::vaciar()) {
        throw new Exception('Hubo un problema al vaciar el carrito de compras.');
      }

      // Se agregó con éxito
      Flasher::new('Carrito vaciado con éxito.', 'success');
      Redirect::back();

    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }
}