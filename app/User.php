<?php
namespace App;

use App\DB;

class User
{
   
	public static function getIdUser($token)
	{
		return DB::run("SELECT id FROM `users` WHERE `access_token`=?", $token)[0]['id'] ?? false;
	}
	
}
