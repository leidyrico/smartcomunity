<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo usuario en la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== CREAR NUEVO USUARIO ===');
        
        // Obtener datos del usuario
        $name = $this->option('name') ?: $this->ask('Nombre del usuario');
        $email = $this->option('email') ?: $this->ask('Email del usuario');
        $password = $this->option('password') ?: $this->secret('Contraseña del usuario');
        
        // Validar los datos
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $this->error('Error en la validación:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('- ' . $error);
            }
            return 1;
        }

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            $this->info('✅ Usuario creado exitosamente!');
            $this->table(
                ['ID', 'Nombre', 'Email', 'Fecha de Creación'],
                [[$user->id, $user->name, $user->email, $user->created_at]]
            );
            
            $this->info('Ahora puedes usar estas credenciales para iniciar sesión:');
            $this->info("Email: {$email}");
            $this->info("Contraseña: [la que ingresaste]");
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Error al crear el usuario: ' . $e->getMessage());
            return 1;
        }
    }
}
