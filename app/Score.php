<?php

namespace App;

use App\{DB, Challenge, Game, User};

class Score 
{
    public $id;
    public $score;
    public $challengeId;
    public $gameId;
    public $userId;

    public function __construct($id, $score, $challengeId, $gameId, $userId)
    {
        $this->id = $id;
        $this->score = $score;
        $this->challengeId = $challengeId;
        $this->gameId = $gameId;
        $this->userId = $userId;
    }

    public static function factory($data)
    {
        if (empty($data)) {
            return null;
        }
        
        return new Score($data['id'], $data['score'], $data['challenge_id'], $data['game_id'], $data['user_id']);
    }

    public static function find($id) 
    {
        return self::factory(DB::run('SELECT * FROM scores WHERE id = ? LIMIT 1', $id)[0] ?? null) ?? null;
    }

    public static function create($score, Challenge $challenge, Game $game, User $user)
    {
        DB::run('INSERT INTO scores(score, challenge_id, game_id, user_id) VALUES (?, ?, ?, ?)',
            $score, $challenge->id, $game->id, $user->id
        );
    }
}