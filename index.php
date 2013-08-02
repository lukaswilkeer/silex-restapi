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
    'Heineken' => array('estilo'=>'pilsen','nome'=>'heik'),
    'Guinness' => array('estilo'=>'pilsen','nome'=>'Guinnes'),
    'Skol' => array('estilo'=>'stou','nome'=>'Skol, a cerveja que desce redondo')
    );

$app->get('/cervejas',function () use ($cervejas){
    //$result = implode(',',$cervejas['marcas']);
    $result = $cervejas;
    return new Response (json_encode($result),200);
});

$app->get('/cervejas/{id}', function ($id) use ($cervejas) {
    if($id == null){
        return new Response (json_encode('Não existe o parametro ID'),404);
    }

    $key = array_key_exists($id,$cervejas); 
    if($key == null){
        return new Response (json_encode('Não encontrada'),404);
    }
    return new Response (json_encode($cervejas[$id]),200);
})->value('id',null);

$app->get('/cervejas/{id}/{info}', function ($id,$info) use ($cervejas) {
    if($info == null){
        return new Response (json_encode('Não encontrado'),404);
    }
    $key = array_key_exists($info,$cervejas[$id]);
    if($key == null){
        return new Response (json_encode('Informação não existente'),404);
    }
    return new Response (json_encode($cervejas[$id][$info]),200);
});

$app->get('/marcas', function () use ($cervejas){
    return implode(',',$cervejas['estilos']);
});

/* 
TODO: Está dando um erro nesta rota, corrigir depois.
// Edita o nome de uma cerveja existente.
$app->put('/cervejas/{id}/nome/{novoNome}', function ($id,$novoNome) use ($cervejas['nome']){
    if($novoNome == null){
        return new Response (json_encode('Faltam parametros'),404);
    }
    // Verifica se existe a cerveja com aquele ID.
    $key = array_key_exists($id, $cervejas[$id]);
    if($key == null){
        return new Response (json_encode('Não existe cerveja com essa id.'),404);
    }
    array_replace($cervejas[$id]['nome'],$novoNome);
    return new Response (json_encode($cervejas[$id]),200);
}); */

//Adiciona o cabeçalho após todas as requisições
$app->after(function (Request $request, Response $response){
    $response->headers->set('Content-Type','text/json');
});
$app['debug'] = true;
$app->run();
?>
