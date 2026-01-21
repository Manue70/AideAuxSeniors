<?php


// 🔎 DEBUG TEMPORAIRE
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Affiche toutes les exceptions Laravel
set_exception_handler(function ($e) {
    echo "<h1>Laravel Exception Debug</h1>";
    echo "<pre>" . htmlspecialchars($e) . "</pre>";
    exit;
});

set_error_handler(function ($severity, $message, $file, $line) {
    echo "<h1>PHP Error Debug</h1>";
    echo "<pre>";
    echo "Severity: $severity\nMessage: $message\nFile: $file\nLine: $line";
    echo "</pre>";
    exit;
});

var_dump(getenv('APP_KEY'));
var_dump(getenv('DB_HOST'));
exit;


use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
