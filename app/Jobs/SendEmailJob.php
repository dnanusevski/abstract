<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\DemoMail;
use Spatie\WebhookServer\WebhookCall;

use Illuminate\Support\Facades\Log;

// 3 time every 30 seconds

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //terminate after 10 seconds if it does not finish
    public $timeout = 10;
    //Retray if the job fails
    public $tries = 1;
    //Wait between faild job before retrying it again after 3 seconds
    public $backoff = 1; // required to be 30 -> will change that later

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details = null)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_url = $this->details['webhook_url'];
        $webhook_url_format_type = $this->details['webhook_url_format_type'];

        // throwing error to imitate mail fail, shuold be removed
        throw new \Exception($user_url.'|'.$webhook_url_format_type);

        Mail::to('demo@some.com')->send(new DemoMail($this->details));

        // If mail fails then go to failed
        if(Mail::failures()){
            throw new \Exception($user_url.'|'.$webhook_url_format_type);
        }
    }


    /**
     * Execute code on fail.
     *
     * accepts exception $e
     * @return void
     */
    public function failed($e)
    {
        // i created http://localhost:8000/api/test-fail just to see if it will work
        // user url should be replaced in the url of the webhook call
        $userDefinedUrl = explode('|',$e->getMessage());
        Log::debug($userDefinedUrl[0]);
        Log::debug($userDefinedUrl[1]);
        $url = $userDefinedUrl[0];
        $type = $userDefinedUrl[1];

        // Decide in which format should the return data be parsed

        if($type === "json"){
            //.... to send with json
        }

        if($type === "xml"){
            //.... to send with xml
        }

        // still sending here in any case with json
        // I might have used curl it would have been easier. Not sure if spatie can send XML :D:D:D:D
        WebhookCall::create()
            ->url('http://localhost:8000/api/test-fail') //shuld place user url in here $userDefinedUrl
            ->payload(['key' => 'value'])
            ->doNotSign()
            ->dispatch();
    }
}
