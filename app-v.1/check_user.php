<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== DATOS DEL USUARIO EXISTENTE ===\n";

try {
    $user = DB::table('users')->first();
    
    if ($user) {
        echo "ID: " . $user->id . "\n";
        echo "Usuario: " . $user->user . "\n";
        echo "Password (hash): " . $user->password . "\n";
        echo "Role: " . $user->role . "\n";
        echo "Status: " . $user->status . "\n";
    } else {
        echo "No se encontraron usuarios.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}