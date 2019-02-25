<?php
namespace App;

use App\DB;

class User
{
	public $id;
	public $username;
    public $password;
	public $firstName;
	public $lastName;
	public $accessToken;

    public function __construct($id, $username, $password, $firstName, $lastName, $accessToken)
    {
		$this->id = $id;
        $this->username = $username;
        $this->password = $password;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->accessToken = $accessToken;
    }

    public static function factory($data)
    {
		if (empty($data)) {
            return null;
		}
		
        return new User($data['id'], $data['username'], $data['password'], $data['first_name'], $data['last_name'], $data['access_token']);
    }

    public static function find($id) 
    {
        return self::factory(DB::run('SELECT * FROM users WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
	}

	public static function findByAccessToken($accessToken) 
    {
        return self::factory(DB::run('SELECT * FROM users WHERE access_token = ? LIMIT 1', $accessToken)[0] ?? null) ?? null;
	}

	/**
	 * Depricated.
	 */
	public static function getIdUser($token)
	{
		return DB::run("SELECT id FROM `users` WHERE `access_token`=?", $token)[0]['id'] ?? false;
	}	
}
