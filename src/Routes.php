<?php

use Doggo\Database\Ertekeles;
use Doggo\Database\Felhasznalok;
use Doggo\Database\Helyszin;
use Doggo\Database\Komment;
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

        //Kommentek
        $app->get('/komment', function(Request $request, Response $response) {
            $komment = Komment::all();
            $kimenet = $komment->toJson();
            
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-Type', 'application/json');
        });
    
        $app->post('/komment', function(Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $komment = Komment::create($input);
    
            $kimenet = $komment->toJson();
            
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json');
        });
    
        $app->delete('/komment/{id}',
            function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $komment = Komment::find($args['id']);
                if ($komment === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $komment->delete();
                return $response
                    ->withStatus(204);
            });
    
            $app->put('/komment/{id}', function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $komment = Komment::find($args['id']);
                if ($komment === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(), true);
                $komment->fill($input);
                $komment->save();
                $response->getBody()->write($komment->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });

        //Értékelések
        $app->get('/ertekeles', function(Request $request, Response $response) {
            $ertekeles = Ertekeles::all();
            $kimenet = $ertekeles->toJson();
            
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-Type', 'application/json');
        });
    
        $app->post('/ertekeles', function(Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $ertekeles = Ertekeles::create($input);
    
            $kimenet = $ertekeles->toJson();
            
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json');
        });
    
        $app->delete('/ertekeles/{id}',
            function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $ertekeles = Ertekeles::find($args['id']);
                if ($ertekeles === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $ertekeles->delete();
                return $response
                    ->withStatus(204);
            });
    
            $app->put('/ertekeles/{id}', function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $ertekeles = Ertekeles::find($args['id']);
                if ($ertekeles === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűHelyszin']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(), true);
                $ertekeles->fill($input);
                $ertekeles->save();
                $response->getBody()->write($ertekeles->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
};