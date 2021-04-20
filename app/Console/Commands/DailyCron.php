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
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyEmail;
use Illuminate\Http\Request;

class DailyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reports on the daily bases!';

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
        ///users record:
        $transactions=Transaction::get();
        if(is_null($transactions)){

        }else{
            foreach ($transactions as $key => $value) {
                $user_id=$value['user_id'];
                $data['name']=User::where('id',$user_id)->pluck('name')->get();
                $date['email']=User::where('id',$user_id)->pluck('email')->get();

                if(is_null($data['name'])){

                }elseif(is_null($date['email'])){

                } else {

                    ////////////////////////////Out flow data\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                    $outFlowData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))->where('type','debit')->get();
                    //  dd($transactions);
                    $outflow = 0;
                    foreach ($outFlowData as $key => $value) {
                    $outflow += $value['amount'];
                    }
                    // $data['outflow']=$outflow;
                    $data['wallet']['inflow/outflow']=($inflow ?? "0") - ($outflow ?? "0");


                    ////////////////////////////salary work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                    $salaryData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))->where('transaction_type','salary')->get();
                    $salary = 0;
                    foreach ($salaryData as $key => $value) {
                    $salary += $value['amount'];
                    }        
                    $data['wallet']['salary']=$salary ?? "";

                    ////////////////////////////Bonus work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                    $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))->where('transaction_type','bonus')->get();
                    $bonus = 0;
                    foreach ($bounusData as $key => $value) {
                    $bonus += $value['amount'];
                    }

                    $data['wallet']['bonus']=$bonus ?? "";
                    $data['wallet']['Remaining Cash']=($inflow ?? "0") - ($outflow ?? "0");


                    //Income
                    $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))->where('type','credit')->get();
                    $income = 0;
                    foreach ($bounusData as $key => $value) {
                    $income += $value['amount'];
                    }
                    $data['income']['income']=$income ?? "";

                    //expense
                    $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))->where('type','debit')->get();
                    $expense = 0;
                    foreach ($bounusData as $key => $value) {
                    $expense += $value['amount'];
                    }
                    $data['expenses']['expenses']=$expense ?? "";


                    //mail process
                    $data['subject']="Balance App's Daily report";
                    Mail::to($data['to_email'])->send(new DailyEmail($data));


                    dd('flash_message_success','Mail has been added successfully!');
                }
                

            }


        }
        
       



        ///That's given below, just for testing\\\\\\\\\\\       
        // $user=User::all();
        // Mail::queue('send', ['user' => $user], function($m) use ($user)
        // {
        //     foreach ($user as $user) {
        //        $m->to($user->email)->subject('Email Confirmation');
        //     }                     

        // });


        // Mail::raw(date('Y-m-d').' '.date('H:i'), function ($message) {
        //     $message->to('sairam.santana@gmail.com');
        //     $message->subject('Reminder Notification');
        // });

        // $contracts = Contract::where('end_date', Carbon::parse(today())->toDateString())->get();

        // foreach ($contracts as $contract) {
        //     Mail::to(Setting::first()->value('email'))->send(new ContractEmail($contract));
        // }

    }
}
