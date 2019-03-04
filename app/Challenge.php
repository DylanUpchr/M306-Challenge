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
        $this->id = $id;
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
}