<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmil;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ارسال ايميل الى المستخدمين';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users=User::all();
        $data = ['title' => 'program' , 'body' => 'laravel'];
        foreach($users as $emails){
          sleep(2);
          Mail::to($emails->email)->send(new NotifyEmil($data));
        }
    }
}
