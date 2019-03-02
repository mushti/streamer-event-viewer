<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhook;

class WebhooksController extends Controller
{
    /**
     * Show the application panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userFollows(Request $request)
    {
        Webhook::create([
        	'data' => $request->all()
        ]);
    }
}
