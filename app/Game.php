<?php

namespace App;

use App\DB;

class Game 
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function factory($data)
    {
        if (empty($data)) {
            return null;
        }

        return new Game($data['id'], $data['name']);
    }

    public static function find($id) 
    {
        return self::factory(DB::run('SELECT * FROM games WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
    }
}