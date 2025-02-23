<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'تحديث حالة المستخدمين كل دقيقة تلقائيًا';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users=User::whereRaw('DATEDIFF(CURDATE(),created_at) > 5')->update(['expiration'=>0]);
        
        }   
    }

