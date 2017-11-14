<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Service\PreStudentService;

// Routes
// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');

// Define named route
$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'home.html', [
        'name' => $args['name']
    ]);
})->setName('home');

// Define named route
$app->get('/ajuda', function ($request, $response, $args) {
    return $this->view->render($response, 'help.html', [
        'name' => $args['name']
    ]);
})->setName('help');



// Define named route
$app->get('/fp', function ($request, $response, $args) {

$courses = [["id" => 1, "name" => "Muntatge i manteniment d’equips"], 
            ["id" => 2, "name" => "Sistemes operatius monolloc"], 
            ["id" => 3, "name" => "Aplicacions ofimàtiques"],
            ["id" => 4, "name" => "Sistemes operatius en xarxa"],
            ["id" => 5, "name" => "Xarxes locals"],
            ["id" => 6, "name" => "Seguretat informàtica"],
            ["id" => 7, "name" => "Serveis de xarxa"],
            ["id" => 8, "name" => "Aplicacions web"],
            ["id" => 9, "name" => "FOL"],
            ["id" => 10, "name" => "Empresa i iniciativa emprenedora"],
            ["id" => 11, "name" => "Anglès tècnic"]];

    return $this->view->render($response, 'fp-course-uf-selection-form.html', [
        'name' => $args['name'],
        'courses' => $courses
    ]);
})->setName('fp');

// Define named route
$app->get('/pre', function ($request, $response, $args) {
    return $this->view->render($response, 'pre-enrollment.html', [
        'name' => $args['name']
    ]);
})->setName('pre-enrollment');

// Define named route
$app->get('/pre-new', function ($request, $response, $args) {
    return $this->view->render($response, 'pre-enrollment-new-student.html', [
        'name' => $args['name']
    ]);
})->setName('pre-enrollment-new-student');

// Define named route
$app->get('/pre-old', function ($request, $response, $args) {
    return $this->view->render($response, 'pre-enrollment-old-student.html', [
        'name' => $args['name']
    ]);
})->setName('pre-enrollment-old-student');

// Define named route
$app->post('/pre-old', function ($request, $response, $args) {

    $oldStudent = $this->PreStudentService->getOldStudent($request->getParsedBody());

    if ($oldStudent) { // Success - Generate random access
        $this->PreStudentService->sendEmailActivation($oldStudent);
        return $this->view->render($response, 'pre-enrollment-old-student-success.html', [
            'name' => $args['name'],
            'info' => "Informació recuperada, si trobes alguna errada en les teves dades acadèmiques consulta al personal de secretaria abans de continuar."
        ]);

        return;
    } else { // No student found
        return $this->view->render($response, 'pre-enrollment-old-student-failed.html', [
            'name' => $args['name'],
            'error' => "No s'ha trobat cap usuari amb aquest correu."
        ]);
    }

});



// Define named route
$app->post('/pre', function ($request, $response, $args) {
    $nim = $this->PreStudentService->createPreStudent($request->getParsedBody());

    return $this->view->render($response, 'pre-enrollment-success.html', [
        'nim' => $nim
    ]);
});

// Define named route
$app->get('/matricula', function ($request, $response, $args) {
    return $this->view->render($response, 'enrollment.html', [
        'name' => $args['name']
    ]);
})->setName('enrollment');

// Define named route
$app->post('/matricula', function ($request, $response, $args) {
    $this->PreStudentService->getPreStudent($request->getParsedBody());

    return $this->view->render($response, 'enrollment-success.html', [
        'nim' => $args['nim']
    ]);
});
// Define named route
$app->get('/cover', function ($request, $response, $args) {
    return $this->view->render($response, 'cover.html', [
        'name' => $args['name']
    ]);
})->setName('cover');

// Define named route
$app->get('/jumbotron', function ($request, $response, $args) {
    return $this->view->render($response, 'jumbotron.html', [
        'name' => $args['name']
    ]);
})->setName('jumbotron');

// Render from string
$app->get('/hi/{name}', function ($request, $response, $args) {
    $str = $this->view->fetchFromString('<p>Hi, my name is {{ name }}.</p>', [
        'name' => $args['name']
    ]);
    $response->getBody()->write($str);
    return $response;
});

$app->get('/examples', function ($request, $response, $args) {

    $sql = "SELECT * FROM example";
    $condition = "1";

    try {
        //$db = MyPDO::getConnection();
        $stmt = $this->db->prepare($sql);
       // $stmt->bindParam("condition", $condition);
        $stmt->execute();
        $examples = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $response->getBody()->write(json_encode( $examples ));
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        $response->getBody()->write(json_encode( $error ));
    }

});

/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
}); */
