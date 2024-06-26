<?php

namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{
  public static function index(Router $router)
  {
    $paginaActual = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    if(!$paginaActual || $paginaActual < 1){
      header('Location: /admin/ponentes?page=1');
    }
    
    $registrosPorPagina = 5;
    $totalRegistros = Ponente::count();
    $paginacion = new Paginacion($paginaActual, $registrosPorPagina, $totalRegistros);

    if($paginacion->totalPaginas() < $paginaActual){
      header('Location: /admin/ponentes?page=1');
    }

    $ponentes = Ponente::paginar($registrosPorPagina, $paginacion->offset());


    if(!isAdmin()){
      header('Location: /login');
    }

    $router->render('admin/ponentes/index', [
      'titulo' => 'Ponentes - Conferencistas',
      'ponentes' => $ponentes,
      'paginacion' => $paginacion->paginacion()
    ]);
  }
  public static function crear(Router $router)
  {
    if(!isAdmin()){
      header('Location: /login');
    }
    $alertas = [];
    $ponente = new Ponente();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Leer imagen
      if ($_FILES['imagen']['tmp_name']) {

        $carpetaImagenes = '../public/img/speakers';

        // Crear carpeta si no existe
        if (!is_dir($carpetaImagenes)) {
          mkdir($carpetaImagenes, 0755, true);
        }

        $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('png', 80);
        $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('webp', 80);

        // Guardar imagen
        $nombre_imagen = md5(uniqid(rand(), true));

        $_POST['imagen'] = $nombre_imagen;
      }

      // Quitar los slashes de las redes sociales
      $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

      $ponente->sincronizar($_POST);

      // Validar
      $alertas = $ponente->validar();

      // Guardar el registro
      if (empty($alertas)) {
        // Guardar las imágenes
        $imagen_png->save($carpetaImagenes . "/$nombre_imagen.png");
        $imagen_webp->save($carpetaImagenes . "/$nombre_imagen.webp");

        // Guardar en la base de datos
        $ponente->created_at = date('Y-m-d H:i:s');
        $resultado = $ponente->guardar();

        if ($resultado) {
          header('Location: /admin/ponentes');
        }
      }
    }

    $router->render('admin/ponentes/crear', [
      'titulo' => 'Registrar Ponente - Conferencista',
      'alertas' => $alertas,
      'ponente' => $ponente,
      'redes' => json_decode($ponente->redes)
    ]);
  }
  public static function actualizar(Router $router)
  {
    if(!isAdmin()){
      header('Location: /login');
    }
    $alertas = [];
    // Validar ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      header('Location: /admin/ponentes');
    }
    // Obtener el ponente
    $ponente = Ponente::find($_GET['id']);
    if (!$ponente) {
      header('Location: /admin/ponentes');
    }

    $ponente->imagen_actual = $ponente->imagen;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($_FILES['imagen']['tmp_name']) {

        $carpetaImagenes = '../public/img/speakers';

        // Crear carpeta si no existe
        if (!is_dir($carpetaImagenes)) {
          mkdir($carpetaImagenes, 0755, true);
        }

        $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('png', 80);
        $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600)->encode('webp', 80);

        // Guardar imagen
        $nombre_imagen = md5(uniqid(rand(), true));

        $_POST['imagen'] = $nombre_imagen;
      } else {
        $_POST['imagen'] = $ponente->imagen_actual;
      }

      $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
      $ponente->sincronizar($_POST);
      $alertas = $ponente->validar();

      if (empty($alertas)) {
        if (isset($nombre_imagen)) {
          // Guardar las imágenes
          $imagen_png->save($carpetaImagenes . "/$nombre_imagen.png");
          $imagen_webp->save($carpetaImagenes . "/$nombre_imagen.webp");
        }
        $ponente->updated_at = date('Y-m-d H:i:s');
        $resultado = $ponente->guardar();

        if ($resultado) {
          header('Location: /admin/ponentes');
        }
      }

    }

    $router->render('admin/ponentes/actualizar', [
      'titulo' => 'Actualizar Ponente - Conferencista',
      'alertas' => $alertas,
      'ponente' => $ponente ?? null,
      'redes' => json_decode($ponente->redes)
    ]);
  }
  public static function eliminar()
  {
    if(!isAdmin()){
      header('Location: /login');
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];

      $ponente = Ponente::find($id);
      if (!isset($ponente)) {
        header('Location: /admin/ponentes');
      }
      $resultado = $ponente->eliminar();
      if ($resultado) {
        header('Location: /admin/ponentes');
      }
    }
  }
}