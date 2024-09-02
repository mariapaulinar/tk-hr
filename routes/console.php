<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('user:admin {password}', function(string $password) {
    if(!$password) {
        return $this->comment('No ingresaste un password. Intenta nuevamente.');
    }
    $data = [
        'email' => 'admin@marcgo.com',
        'name' => 'Admin',
        'password' => Illuminate\Support\Facades\Hash::make($password)
    ];
    App\Models\User::create($data);
    $this->comment('Usuario creado!');
});
