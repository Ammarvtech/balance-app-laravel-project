<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Card;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;
use App\Language;
use App\Transaction;
use App\User; 
use App\Temp; 
use App\UserLog;

class WeeklyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reports on the weekly bases!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $card = array(
               'user_id' => "43",
               'name' =>"weekly Reports",
               'card_number' =>"7899708",
               'expiry_date' =>"2020-10-19",
               'cvv' =>"453"
        );
        Card::create($card);
    }
}
