<?php

namespace App;

use App\DB;

class Challenge
{
    public $id;
    public $name;
    public $startDate;
    public $endDate;

    public function __construct($id, $name, $startDate, $endDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function factory($data)
    {
        if (empty($data)) {
            return null;
        }
        
        return new Challenge($data['id'], $data['name'], $data['start_date'], $data['end_date']);
    }

    public static function find($id) 
    {
        return self::factory(DB::run('SELECT * FROM challenges WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
    }
}