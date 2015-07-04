<?php

class Player extends Member {

    private static $db = array(
    );

    private static $belongs_many_many = array(
        'Teams' => 'Team',
    );

    public function getGamesPlayed() {
        $teams = Team::get();
        $count = 0;
        foreach ($teams as $team) {
            if ($team->PlayerOne == $this->ID || $team->PlayerTwo == $this->ID) {
                $count++;
            }
        }
        return $count;
    }

    public function PlayerLink() {
        return 'view/' . $this->ID;
    }

}