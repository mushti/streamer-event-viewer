<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Favorite\Update;

class FavoriteController extends Controller
{
    /**
     * Display the authenticated resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user()->favorites()->firstOrFail();
    }

    /**
     * Update the authenticated resource in storage.
     *
     * @param  \App\Http\Requests\API\Favorite\Update  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request)
    {
        return $request->process();
    }
}
