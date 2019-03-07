<?php

namespace App\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Webhook;
use App\Events\UserFollowedStreamer;

class FollowsController extends Controller
{
    /**
     * Handle the webhook callback request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handle(Request $request)
    {
        event(new UserFollowedStreamer($request->data[0]));
    }

    /**
     * Authorize the webhook callback request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function verify(Request $request)
    {
        if (!$webhook = Webhook::where('topic', $request->hub_topic)->first()) {
            $webhook = Webhook::create([
                'topic' => $request->hub_topic,
            	'expires_at' => date('Y-m-d H:i:s', time() + $request->hub_lease_seconds)
            ]);
        }

        $webhook->expires_at = date('Y-m-d H:i:s', time() + $request->hub_lease_seconds);
        $webhook->save();

        echo $request->hub_challenge;
    }
}
