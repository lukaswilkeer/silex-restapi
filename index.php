<?php
// Mostra todos os erros do php.
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//loader do composer
$loader = require_once __DIR__.'/vendor/autoload.php';

$app = new Application();

$cervejas = array(
    'marcas' => array('Heineken','Guinness','Skol','Colorado'),
    'estilos' => array('Pilsen','Stou')
);

$app->get('/cervejas/{id}', function ($id) use ($cervejas) {
    if($id == null){
        return implode(',',$cervejas['marcas']);
    }

    $key = array_search($id,$cerveja['marcas']);
    if($key == null){
        return 'Não encontrada';
    }
    return $cervejas['marcas'][$key];
})->value('id',null);

$app->get('/marcas', function () use ($cervejas){
    return implode(',',$cervejas['estilos']);
});

$app->run();
?>
