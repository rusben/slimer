<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new \Slim\Middleware\JwtAuthentication([
    "secret" => getenv("JWT_SECRET"),
    "path" => "/api",
    "secure" => false
]));
