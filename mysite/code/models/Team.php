<?php

class Team extends DataObject {

    private static $db = array(
        'PlayerOne' => 'Varchar',
        'PlayerTwo' => 'Varchar',
    );

    private static $summary_fields = array(
        'getTeamNames' => 'Players',
    );

    private static $many_many = array(
        'Games' => 'Game',
        'Players' => 'Player',
    );

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

}