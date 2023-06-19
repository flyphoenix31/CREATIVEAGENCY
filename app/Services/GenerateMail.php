<?php

namespace App\Services;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

//extends Mailable
class GenerateMail extends Mailable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $data;
	public $type;
	public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type = FALSE , $data = FALSE)
    {
        $this->type = $type;
		$this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

		$data    = $this->data;
		$type    = $this->type;
		$view    = 'mail/'.$type;

        return $this->view($view)
                    ->subject($data['subject'])
                    ->with([ 'data' => $this->data ]);


    }

	public function failed()
    {
        // Called when the job is failing...
        \Log::alert('error in email queue mail');
    }

	private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }

    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}
