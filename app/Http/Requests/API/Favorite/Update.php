<?php

namespace App\Http\Requests\API\Favorite;

use Illuminate\Foundation\Http\FormRequest;
use Twitch\Client;
use App\Models\User;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:50'
        ];
    }

    /**
     * Process the request.
     *
     * @return \App\Models\User
     */
    public function process()
    {
        $twitch = $this->fetchTwitchUser($this->username, $this->user()->access_token);

        if (!$twitch) {
            return response()->json([
                'message' => '',
                'errors' => [
                    'username' => ['The username is invalid.']
                ]
            ], 422);
        }

        $streamer = User::findOrCreateForTwitch($twitch);
        $this->user()->favorites()->sync($streamer);

        $this->subscribeWebhook($streamer->twitch_id, $this->user()->access_token);

        return $this->user()->favorite;
    }

    /**
     * Fetch user from twich.
     *
     * @return \App\Models\User
     */
    public function fetchTwitchUser($username, $access_token)
    {
        try {
            $client = new Client();
            $response = $client->get('users?login=' . $username, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ]);
            $response = json_decode($response->getBody());
            return count($response->data) ? (object) [
                'id' => $response->data[0]->id,
                'nickname' => $response->data[0]->login,
                'name' => $response->data[0]->display_name,
                'avatar' => $response->data[0]->profile_image_url,
                'cover' => $response->data[0]->offline_image_url
            ] : null;
        } catch (\Exception $e) {
            return;
        }
    }

    /**
     * Subscribe to Twitch Webhook.
     *
     * @return void
     */
    public function subscribeWebhook($streamer_id, $access_token)
    {
        try {
            $client = new Client();
            $response = $client->post('webhooks/hub', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Bearer ' . $access_token
                ],
                'form_params' => [
                    'hub.callback' => 'http://ec2-52-10-243-103.us-west-2.compute.amazonaws.com/streamereventviewer/public/webhooks/users/follows',
                    'hub.topic' => 'https://api.twitch.tv/helix/users/follows?first=1&to_id=' . $streamer_id,
                    'hub.lease_seconds' => '86400',
                    'hub.mode' => 'subscribe'
                ]
            ]);
            $response = json_decode($response->getBody());
            return true;
        } catch (\Exception $e) {
            return;
        }
    }
}
