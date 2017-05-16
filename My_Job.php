<?php

class My_Job{
	function perform(){
		try {
			$url = sprintf('https://api.github.com/users/%s/repos', $this->args['username']);
			$client = new Guzzle\Http\Client();

			$request = $client->get($url);
			$response = $request->send();

			echo count($response->json());
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}