<?php

namespace App\Traits;
use App\Models\Mail\MailDailyCount;
use App\Models\Mail\MailErrorTracker;

use \App\Services\GenerateMail;

trait SendMailTrait
{
    public function sendMail($type = 'sendmail', $email_data = [], $mailtype = 'text', $view = null )
    {

        $this->trigger($type, $email_data, $mailtype, $view);
    }

    public function trigger($type, $email_data, $mailtype, $view)
    {
        $mailerror   = '';
        $mail_status = null;
        $excepti     = '';

        $mailcount = MailDailyCount::firstOrCreate(
            ['send_date' =>  date('Y-m-d'), 'type' => $type],
            ['send_date' =>  date('Y-m-d'), 'type' => $type]
        );

        $to_email = $email_data['to_email'];

        try{
            if ($mailtype == 'text')
            {
                $mail_status = \Mail::send([], $email_data, function ($message) use ($email_data)
                                {
                                    $message->from(\config('pm.from_mail'));
                                    $message->to($email_data['to_email'], $email_data['to_name']);
                                    $message->subject($email_data['subject']);
                                    $message->setBody($email_data['content'],'text/html');
                                });
            }
            elseif ($mailtype == 'html')
            {
                \Mail::to($email_data['to_email'])->queue(new GenerateMail( $view, $email_data));


               /*  $mail_status = \Mail::send('mail/'.$view, $email_data, function($message) use ($email_data){
                    $message->from(\config('pm.from_mail'));
                    $message->to($email_data['to_email'], $email_data['to_name']);
                    $message->subject($email_data['subject']);
                 }); */
            }

        }
        catch(\Swift_TransportException $e )
        {
            \Log::error(json_encode($e->getMessage()));
            $mailerror = 'yes';
            $excepti   = json_encode($e->getMessage()); dd($excepti);
        }
        catch(Exception $e)
        {
            $mailerror = 'yes';
            // Never reached
            \Log::error(json_encode($e->getMessage()));

            if($mail_status->failures() > 0){
                    $excepti = json_encode($e->getMessage());
            }
        }

        if (!$mailerror) {
            $mailcount->increment('success_count', 1);
        }
        else
        {
            $data = ['type' => $type, 'user_id' => \Auth::id(), 'email' => $to_email, 'error_data' => $excepti];
            MailErrorTracker::create($data);
            $mailcount->increment('failure_count', 1);
        }

        return true;
    }
}
