<?php

namespace Twitch;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{
	function __construct(array $config = [])
	{
		parent::__construct([ 'base_uri' => 'https://api.twitch.tv/helix/' ]);
	}
}