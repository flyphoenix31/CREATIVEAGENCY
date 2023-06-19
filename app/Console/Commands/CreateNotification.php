<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class CreateNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:create {type} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create In-App notifications';

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
     * @return mixed
     */
    public function handle()
    {
        // Start deployment
        $this->info('Started');

        $type = $this->argument('type');
        $id   = $this->argument('id');

        //dd($type, $id);





        switch($type)
        {
            case('storeJob'):
                $job = \App\Models\Job\Job::where('id', $id)->first();
                if($job)
                {
                    if($job->type_id == 1)
                    {
                        $jobdis = \App\Models\Job\JobDistribution::where('job_id', $job->id)->first();
                        $users  =  \App\Models\User::Active()->IfRole('designer')->get();

                        foreach($users as $user)
                        {
                            $this->generateNotification($user, 'job', 'New Job Alert', 'You got a new Job alert.', $job);
                        }
                    }
                    else
                    {
                        $jobdis = \App\Models\Job\JobDistribution::with('user')->where('job_id', $job->id)->get();

                        foreach($jobdis as $row)
                        {
                            $this->generateNotification($row->user, 'job', 'New Job Alert', 'You got a new Job alert.', $job);
                        }
                    }
                }
            break;

            case('viewQuote'):
                $record = \App\Models\Invoice\MailQuotation::with('user', 'invoice')->where('id', $id)->first();
                if($record)
                {
                    $this->generateNotification($record->user,'quotation', 'Your Quote #'.$record->invoice->invoice_number.' Viewed', 'Your #'.$record->invoice->invoice_number.' Viewed', $record);
                }
            break;
        }



        $this->info('Everything is done, congratulations! 🥳🥳🥳');
    }


    private function generateNotification($user, $type = 'system', $subject = null, $message = null, $data = [])
    {
        $noti = new NotificationService();

        $noti->triggerNotification($user, $type, $subject, $message);
    }
}
