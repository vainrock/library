<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Librarian;
use Illuminate\Support\Facades\Hash;

class CreateLibrarian extends Command
{
    protected $signature = 'librarian:create {email} {password}';
    protected $description = 'Создание нового библиотекаря';

    public function handle()
    {
        $name = $this->ask('Enter name'); // Ask for name input
        $email = $this->argument('email');
        $password = $this->argument('password');

        $librarian = Librarian::create([
            'name' => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Библиотекарь {$librarian->email} успешно создан.");

    }
}