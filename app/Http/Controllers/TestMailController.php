<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use App\Jobs\SendEmailJob;
use Spatie\WebhookServer\WebhookCall;

class TestMailController extends Controller
{
    /**
     * Write code on Method
     * Use to check if dispatch is sending mail, and if log is valid
     *
     * @return void()
     */
    public function index()
    {
        // dummy data
        $template = "<html><head><title>asd</title></head><body>body</body></html>";
        $data = [
            'template' => $template,
            'webhook_url' => auth()->user()->webhook_url,
            'webhook_url_format_type' => auth()->user()->webhook_url_format_type,
        ];
        // No other jobs present no need to prioritize
        // No need to run more workers
        dispatch(new SendEmailJob($data));

        dd("Email is dispatched.");
    }
    /**
     * To check if spatie is accessing our test access page
     *
     *
     * @return void()
     */

    public function testSpatie()
    {
        try {
            WebhookCall::create()
                ->url('http://localhost:8000/api/test-fail')
                ->payload(['key' => 'value'])
                ->doNotSign()
                ->dispatchSync();

        } catch (Exception $e) {
            dd($e);
        }

        dd('testing spatie 4');
    }
}
