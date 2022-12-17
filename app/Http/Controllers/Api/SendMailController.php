<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Project;
use Illuminate\Http\Request;


class SendMailController extends Controller
{

    /**
     * Api route
     *
     * To accept data and initiate mail job
     * @return json
     */
    public function send(Request $request){

        $drivers = $request->input('driver');
        $params = $request->input('params');
        $template = $request->input('template');

        $to = $params['to'];
        $webhook_url = $params['webhook_url'];
        $webhook_url_format_type = $params['webhook_url_format_type'];

        $data = [
            'template' => $template,
            'webhook_url' => $webhook_url,
            'webhook_url_format_type' => $webhook_url_format_type,
        ];

        // Dispath email job for each driver
        foreach($drivers as $driver){
            if($driver === "smtp1"){
                dispatch(new SendEmailJob($data));
            }
        }

        return ($data);
    }
}
