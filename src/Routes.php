<?php

use Doggo\Database\Felhasznalok;
use Doggo\Database\Helyszin;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    //Helyszínek
    $app->get('/helyszin', function(Request $request, Response $response) {
        $hely = Helyszin::all();
        $kimenet = $hely->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/helyszin', function(Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $hely = Helyszin::create($input);

        $kimenet = $hely->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/helyszin/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $hely = Helyszin::find($args['id']);
            if ($hely === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $hely->delete();
            return $response
                ->withStatus(204);
        });

        $app->put('/helyszin/{id}', function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $hely = Helyszin::find($args['id']);
            if ($hely === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(), true);
            $hely->fill($input);
            $hely->save();
            $response->getBody()->write($hely->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

        //Felhasználók
        $app->get('/felhasznalo', function(Request $request, Response $response) {
            $felhasznalo = Felhasznalok::all();
            $kimenet = $felhasznalo->toJson();
            
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-Type', 'application/json');
        });
    
        $app->post('/felhasznalo', function(Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $felhasznalo = Felhasznalok::create($input);
    
            $kimenet = $felhasznalo->toJson();
            
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json');
        });
    
        $app->delete('/felhasznalo/{id}',
            function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalo = Felhasznalok::find($args['id']);
                if ($felhasznalo === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $felhasznalo->delete();
                return $response
                    ->withStatus(204);
            });
    
            $app->put('/felhasznalo/{id}', function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalo = Felhasznalok::find($args['id']);
                if ($felhasznalo === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(), true);
                $felhasznalo->fill($input);
                $felhasznalo->save();
                $response->getBody()->write($felhasznalo->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
};