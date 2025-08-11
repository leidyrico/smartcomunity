<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== USUARIOS EN LA BASE DE DATOS ===\n";
echo "ID | Nombre | Email | Fecha de Creación\n";
echo "----------------------------------------\n";

$users = User::all();

foreach ($users as $user) {
    echo $user->id . " | " . $user->name . " | " . $user->email . " | " . $user->created_at . "\n";
}

echo "\nTotal de usuarios: " . $users->count() . "\n";