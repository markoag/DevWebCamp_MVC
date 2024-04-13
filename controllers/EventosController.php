<?php

namespace Controllers;

use MVC\Router;

class EventosController
{
 public static function index(Router $router)
 {
  $router->render('admin/eventos/index', [
    'titulo' => 'Conferencias y Workshops'
  ]);
 }
 public static function crear(Router $router)
 {
  $router->render('admin/eventos/crear', [
    'titulo' => 'Conferencias y Workshops'
  ]);
 }
 public static function actualizar(Router $router)
 {
  $router->render('admin/eventos/actualizar', [
    'titulo' => 'Conferencias y Workshops'
  ]);
 }
 public static function eliminar(Router $router)
 {
  $router->render('admin/eventos/eliminar', [
    'titulo' => 'Conferencias y Workshops'
  ]);
 }
}