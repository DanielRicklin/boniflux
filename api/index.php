<?php


require_once __DIR__.'/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Slim application instance
$conf = ['settings' => ['displayErrorDetails' => true]];
$app = new \Slim\App($conf);

//Eloquent ORM settings
require_once 'db.php';

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Respect\Validation\Validator as v;
use \DavidePastore\Slim\Validation\Validation as Validation;

$error = require_once __DIR__.'/../src/conf/error.php';


$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', $req->getHeader('Origin')[0])
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});


$app->get('/streams[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->stream($req, $resp, $args);
    }
);

$app->get('/streamsall[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->stream($req, $resp, $args);
    }
);

$app->get('/stream/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getstream($req, $resp, $args);
    }
);

//Connexion
$app->post('/members/signin[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->connexion($req, $resp, $args);
    }
);

//Inscription
$app->post('/members[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->inscription($req, $resp, $args);
    }
);


//Messages chat
$app->get('/messages/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getmessage($req, $resp, $args);
    }
);

//Messages chat
$app->post('/messages/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postmessage($req, $resp, $args);
    }
);


//Get abonnements
$app->get('/abonnements/{id}', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getabonnements($req, $resp, $args);
    }
);

//Post abonnements
$app->post('/abonnement[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postabonnement($req, $resp, $args);
    }
);

//Delete abonnements
$app->post('/desabonnement[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->delabonnement($req, $resp, $args);
    }
);

//Get User
$app->get('/user/{id}[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getuser($req, $resp, $args);
    }
);

//Post video
$app->post('/postvideo[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->postvideo($req, $resp, $args);
    }
);

//Get videos
$app->get('/video[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->getvideo($req, $resp, $args);
    }
);

//Créer stream
$app->post('/createStream[/]', function (Request $req, Response $resp, $args) {
    $c = new boniflux\api\control\Controller($this);
    return $c->createStream($req, $resp, $args);
    }
);

$app->run();
