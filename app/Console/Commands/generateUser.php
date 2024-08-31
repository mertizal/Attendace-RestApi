<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class generateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name= $this->ask('adın ne?');
        $email= $this->ask('email ne?');
        $password= $this->ask('password ne?');

        $user=User::Create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        $token = $user->createToken('sifre');
        $this->line($token->plainTextToken);
        $this->info('user oluşturuldu'.$user->name);
   
    }
}
