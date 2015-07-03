<?php

class Player extends Member {

    private static $db = array(
    );

    private static $belongs_many_many = array(
        'Teams' => 'Team',
    );

    public function getGamesPlayed() {
        return $this->Teams()->count();
    }

    public function PlayerLink() {
        return 'view/' . $this->ID;
    }

}