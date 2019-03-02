<?php

namespace App\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Webhook;

class FollowsController extends Controller
{
    /**
     * Show the application panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handle(Request $request)
    {
        Webhook::create([
        	'data' => $request->all()
        ]);
    }

    /**
     * Show the application panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verify(Request $request)
    {
        Webhook::create([
        	'data' => $request->all()
        ]);

        echo $request->hub_challenge;
    }
}
