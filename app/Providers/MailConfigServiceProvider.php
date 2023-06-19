<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;


class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('mail_accounts')) {
            $mail = DB::table('mail_accounts')->where('is_default', 1)->first();
            if ($mail)
            {
                $config = array(
                    'driver'     => $mail->mail_driver,
                    'host'       => $mail->mail_host,
                    'port'       => $mail->mail_port,
                    'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
                    'encryption' => $mail->mail_enc,
                    'username'   => $mail->mail_username,
                    'password'   => $mail->mail_password,
                );
                Config::set('mail', $config);
            }
        }
    }
}
