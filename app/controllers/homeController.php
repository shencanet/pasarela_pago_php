<?php 

class homeController extends Controller {
  function __construct()
  {
  }

  function index()
  {
    $data =
    [
      'title'     => 'Home',
      'productos' => get_productos()
    ];

    View::render('index', $data);
  }
}