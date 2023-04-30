<?php 

class Carrito
{
  private $var_name   = 'session_cart';
  private $carrito     = null; // toda la información de nuestro carrito
  private $numero      = null; // será considerado como número de "venta"
  private $hash        = null; // hash único del carrito actual en curso
  private $productos   = [];
  public $t_productos = 0;
  public $subtotal    = 0;
  public $impuestos   = 0;
  public $envio       = 0;
  public $tipo_env    = 'Express'; // gratis si es mayor a 499
  public $gratis_env  = 1999; // tarifa para envío gratis
  public $tarifa_env  = 99;  // costo base de envío
  public $total       = 0;

  // Del cliente
  public $nombres     = '';
  public $apellidos   = '';
  public $email       = '';
  public $telefono    = '';
  public $calle       = '';
  public $num         = '';
  public $ciudad      = '';
  public $cp          = '';
  public $pais        = 'México';

  public function __construct()
  {
    if (!isset($_SESSION[$this->var_name])) {
      $this->crear_nuevo();
    }

    return $this;
  }

  // Crear un nuevo carrito e inicializarlo
  private function crear_nuevo()
  {
    $this->hash    = generate_token();
    $this->numero  = random_password(6, 'numeric');
    $this->carrito =
    [
      'hash'            => $this->hash,
      'numero'          => $this->numero,
      'productos'       => $this->productos,
      'total_productos' => $this->t_productos,
      'subtotal'        => $this->subtotal,
      'tipo_env'        => $this->tipo_env,
      'envio'           => $this->envio,
      'total'           => $this->total,
      'impuestos'       => $this->impuestos
    ];

    $_SESSION[$this->var_name] = $this->carrito;

    return $this;
  }

  // Obtener el carrito
  public function cargar_carrito()
  {
    // Cargar directo de los valores más actuales en sesión
    $this->carrito     = $_SESSION[$this->var_name];

    // Reestablecer los valores de todas las propiedades
    $this->productos   = $this->carrito['productos'];
    $this->t_productos = $this->carrito['total_productos'];
    $this->subtotal    = $this->carrito['subtotal'];
    $this->tipo_env    = $this->carrito['tipo_env'];
    $this->envio       = $this->carrito['envio'];
    $this->total       = $this->carrito['total'];
    $this->impuestos   = $this->carrito['impuestos'];

    // Recalcular todos los elementos
    $this->recalcular();

    return $this->carrito;
  }

  // Contar productos
  private function contar()
  {
    return $this->t_productos = !empty($this->productos) ? count($this->productos) : 0;
  }

  // Recalcular totales
  public function recalcular()
  {
    // Inicializar la cuenta
    $subtotal = 0;

    // Si hay productos
    if (!empty($this->productos)) {
      foreach ($this->productos as $i => $p) {
        $subtotal = $subtotal + ($p['precio'] * $p['cantidad']);
      }
    }

    // Operaciones necesarias
    $this->subtotal  = $subtotal;
    $this->tipo_env  = $this->subtotal > $this->gratis_env ? 'Gratis' : 'Express';
    $this->envio     = $this->tipo_env === 'Gratis' ? 0 : ($this->subtotal === 0 ? 0 : $this->tarifa_env);
    $this->total     = $this->subtotal + $this->envio;
    $this->impuestos = $this->total * 0.16;

    // Guardar en el carrito de la sesión
    $_SESSION[$this->var_name]['subtotal']        = $this->subtotal;
    $_SESSION[$this->var_name]['tipo_env']        = $this->tipo_env;
    $_SESSION[$this->var_name]['envio']           = $this->envio;
    $_SESSION[$this->var_name]['total']           = $this->total;
    $_SESSION[$this->var_name]['impuestos']       = $this->impuestos;
    $_SESSION[$this->var_name]['total_productos'] = $this->contar();
    $this->carrito                                = $_SESSION[$this->var_name];

    return $this;
  }

  // Obtener productos
  public function cargar_productos()
  {
    return $this->productos;
  }

  // Agregar / actualizar producto a carrito
  public static function agregar($producto)
  {
    $self      = new self();
    $carrito   = $self->cargar_carrito();
    $productos = $self->cargar_productos();

    // Si ya existen productos
    if (!empty($productos)) {
      foreach ($productos as $i => $p) {
        if ((int) $p['id'] === $producto['id']) {
          $p['cantidad'] = $p['cantidad'] + 1; // se añade 1 a la cantidad
          $_SESSION[$self->var_name]['productos'][$i] = $p; // se actualiza la información en sesión
          return true;
        }
      }
    }

    // Si no existe el producto en al array o si no había productos
    $_SESSION[$self->var_name]['productos'][] = $producto;

    // Recalcular
    $self->recalcular();

    return true;
  }

  // Eliminar producto
  public static function borrar($id_producto)
  {
    $self      = new self();
    $carrito   = $self->cargar_carrito();
    $productos = $self->cargar_productos();

    // Si ya existen productos
    if (empty($productos)) {
      return false; // no hay productos
    }
    
    foreach ($productos as $i => $p) {
      if ((int) $p['id'] === (int) $id_producto) {
        unset($self->productos[$i]);
        unset($_SESSION[$self->var_name]['productos'][$i]);

        // Recalcular
        $self->recalcular();

        return true;
      }
    }

    return false; // no se encontró el producto
  }

  // Vaciar carrito
  public static function vaciar()
  {
    $self                                   = new self();
    $_SESSION[$self->var_name]['productos'] = [];
    $self->productos                        = [];
    $self->recalcular();

    return true;
  }

  // Validar si un producto existe en la cesta o carrito ya
  public static function dentro($id_producto)
  {
    $self      = new self();
    $carrito   = $self->cargar_carrito();
    $productos = $self->cargar_productos();

    // Si ya existen productos
    if (empty($productos)) {
      return false; // no hay productos
    }
    
    foreach ($productos as $i => $p) {
      if ((int) $p['id'] === $id_producto) {
        return true;
      }
    }

    return false; // no se encontró el producto
  }

  // Reiniciar el carrito de compras
  public static function reiniciar()
  {
    $self = new self();
    if (!isset($_SESSION[$self->var_name])) {
      return true;
    }

    unset($_SESSION[$self->var_name]);
    return true;
  }
}
