<?php

class Player extends Member {

    private static $db = array(
    );

    private static $belongs_many_many = array(
        'Games' => 'Game',
        'Teams' => 'Team',
    );

    public function getGamesPlayed() {
        return $this->Games()->count();
    }

    public function PlayerLink() {
        return 'view/' . $this->ID;
    }

}