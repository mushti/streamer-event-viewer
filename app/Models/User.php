<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'twitch_id', 'username', 'name', 'email', 'avatar', 'access_token', 'cover',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'access_token', 'favorites',
    ];

    /**
     * Get the user's favorite.
     *
     * @param  string  $value
     * @return string
     */
    public function getFavoriteAttribute($value)
    {
        return $this->favorites->count() ? $this->favorites[0] : null;
    }

    /**
     * The favorites that belong to the user.
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Models\User', 'favorites', 'user_id', 'streamer_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @param  \Laravel\Socialite\AbstractUser  $twitch
     * @return \App\Models\User
     */
    public static function findOrCreateForTwitch($twitch)
    {
        $user = self::where('twitch_id', $twitch->id)->when(isset($twitch->email), function ($query) use ($twitch) {
                    $query->orWhere('email', $twitch->email);
                })->first();

        if ($user) {
            $user->name = $twitch->name;
            $user->avatar = $twitch->avatar;
            if (isset($twitch->email)) $user->email = $twitch->email;
            if (isset($twitch->cover)) $user->cover = $twitch->cover;
            if (isset($twitch->token)) $user->access_token = $twitch->token;
            $user->save();
            
            return $user;
        }

        return self::create([
            'twitch_id' => $twitch->id,
            'username' => $twitch->nickname,
            'name' => $twitch->name,
            'email' => isset($twitch->email) ? $twitch->email : null,
            'avatar' => $twitch->avatar,
            'cover' => isset($twitch->cover) ? $twitch->cover : null,
            'access_token' => isset($twitch->token) ? $twitch->token : null
        ]);;
    }
}
