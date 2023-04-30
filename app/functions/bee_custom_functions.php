<?php 

function get_productos()
{
  $products = [
    [
      'id'     => 1,
      'titulo' => 'Rifle AEG "Calico Jack" de Metal M4',
      'precio' => 5350,
      'imagen' => 'https://www.evike.com/images/21/large/doubleeagle-21567.jpg'
    ],
    [
      'id'     => 2,
      'titulo' => 'FN Herstal P90 Airsoft AEG',
      'precio' => 3210,
      'imagen' => 'https://www.evike.com/images/large/fnherstal-39653.jpg'
    ],
    [
      'id'     => 3,
      'titulo' => 'Pistola APS Edición Limitada Bumblebee GBB',
      'precio' => 5200,
      'imagen' => 'https://www.evike.com/images/large/aps-22979.jpg'
    ],
    [
      'id'     => 4,
      'titulo' => 'Pistola ASG CZ P-09 GBB',
      'precio' => 1699,
      'imagen' => 'https://www.evike.com/images/large/gp-50085a.jpg'
    ],
    [
      'id'     => 5,
      'titulo' => 'SCAR-H CQB FN MK17 GBB',
      'precio' => 7699,
      'imagen' => 'https://www.evike.com/images/large/palco-70278.jpg'
    ],
    [
      'id'     => 6,
      'titulo' => 'PDW M2 Compacta GBB',
      'precio' => 6400,
      'imagen' => 'https://www.evike.com/images/318/large/gr-kaa-pdw-s-bk.jpg'
    ]
  ];

  return $products;
}

function get_producto($id)
{
  $productos = get_productos();

  foreach ($productos as $p) {
    if ((int) $p['id'] === (int) $id) {
      return $p;
    }
  }

  return false;
}