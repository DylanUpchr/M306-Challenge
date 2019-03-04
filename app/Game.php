<?php

namespace App;

use App\DB;

/**
 * Game model.
 */
class Game 
{
    public $id;
    public $name;

    /**
     * Default constructor.
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Easy way to create instance from data array.
     *
     * @param array $data
     * @return Game|null
     */
    public static function factory($data)
    {
        if (empty($data)) {
            return null;
        }

        return new Game($data['id'], $data['name']);
    }

    /**
     * Find a game by id.
     *
     * @param int $id
     * @return Game|null
     */
    public static function find($id) 
    {
        return self::factory(DB::run('SELECT * FROM games WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
    }
}