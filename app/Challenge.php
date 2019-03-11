<?php
/**
* @author Florian Burgener <florian.brgnr@eduge.ch>, Ismael Adda <ismael.add@eduge.ch>
* @version 1.0.0
*/

namespace App;

use App\DB;

/**
 * Challenge model.
 */
class Challenge
{
    public $id;
    public $name;
    public $startDate;
    public $endDate;

    /**
     * Default constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct($id, $name, $startDate, $endDate)
    {
        $this->id = (int)$id;
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Get ranking of the challenge.
     *
     * @return array
     */
    public function ranking($challengeId) 
    {
        $users =  DB::run('SELECT u.username, u.first_name, u.last_name, SUM(s.score) score FROM users u             
            INNER JOIN scores s ON s.user_id = u.id        
            WHERE s.challenge_id = ?
            GROUP BY s.user_id       
            ORDER BY score DESC     
        ', $challengeId);

        for ($i = 0; $i < count($users); $i++) {
            $users[$i]['score'] = (int)$users[$i]['score'];
        }

        return $users;
    }

    /**
     * Easy way to create instance from data array.
     *
     * @param array $data
     * @return Challenge|null
     */
    public static function factory($data)
    {
        if (empty($data)) {
            return null;
        }

        return new Challenge($data['id'], $data['name'], $data['start_date'], $data['end_date']);
    }

    /**
     * Find a challenge by id.
     *
     * @param int $id
     * @return Challenge|null
     */
    public static function find($id)
    {
        return self::factory(DB::run('SELECT * FROM challenges WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
    }

    /**
     * @return Challenge[]
     */
    public static function all(): array
    {
        $rows = DB::run('SELECT * FROM challenges');
        return array_map(function($row) {
            return static::factory($row);
        }, $rows);
    }
}
