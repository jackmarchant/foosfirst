<?php

class Team extends DataObject {

    private static $db = array(
        'PlayerOne' => 'Varchar',
        'PlayerTwo' => 'Varchar',
    );

    private static $summary_fields = array(
        'getTeamNames' => 'Players',
    );

    private static $belongs_many_many = array(
        'Games' => 'Game',
    );

    private static $many_many = array(
        'Players' => 'Player',
    );

    public function getTitle() {
        return $this->getTeamNames();
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $players = Player::get();
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerOne', 'Player One', $players->map('ID', 'FirstName')));
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerTwo', 'Player Two', $players->map('ID', 'FirstName')));


        return $fields;
    }

    public function getTeamNames() {
        $player_one = Player::get()->filter('ID', $this->PlayerOne)->first();
        $player_two = Player::get()->filter('ID', $this->PlayerTwo)->first();
        return $player_one->FirstName . ' & ' . $player_two->FirstName;
    }

    public function getGamesPlayed() {
        return $this->Games()->count();
    }

}