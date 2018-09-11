<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

// Routes
/**
 * Example GET route
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $req  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $res  PSR7 response
 * @param  array                                    $args Route parameters
 *
 * @return \Psr\Http\Message\ResponseInterface
 */

//  $app->get('/prueba', function (Request $request, Response $response, array $args) {
// $this->logger->addInfo('Prueba Lucas');
//  });

$app->get('/hello/{name}', "saludador:hola");
$app->post('/login/', "logueador:login");
$app->post('/registro/', "logueador:registro");
// $app->get('/session/', "sessionador:getSession");
