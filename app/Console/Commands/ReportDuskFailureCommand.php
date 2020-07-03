<?php

namespace App\Console\Commands;

use App\Mail\DuskFailureMailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReportDuskFailureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whiteapp_dusk:reportFailure';

    protected $toEmails = [
        'didinonpqcms@gmail.com',
        //'manuel@noxx.me'
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send screnshoot of failure test';

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
        foreach ($this->toEmails as $email) {
            Mail::to($email)->send(new DuskFailureMailer());
        }
    }
}
