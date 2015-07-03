<?php

class Game extends DataObject {

    private static $db = array(
        'ScoreTeamOne' => 'Int',
        'ScoreTeamTwo' => 'Int',
        'PlayerOneTeamOne' => 'Varchar',
        'PlayerTwoTeamOne' => 'Varchar',
        'PlayerOneTeamTwo' => 'Varchar',
        'PlayerTwoTeamTwo' => 'Varchar',
    );

    private static $has_one = array(

    );

    private static $summary_fields = array(
        'Winner' => 'Winner',
        'ScoreTeamOne' => 'ScoreTeamOne',
        'ScoreTeamTwo' => 'ScoreTeamTwo',
    );

    private static $many_many = array(
        'Players' => 'Player',
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $players = Player::get();

        //  team one
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerOneTeamOne', 'Player One (Team 1)', $players->map('ID', 'FirstName')));
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerTwoTeamOne', 'Player Two (Team 1)', $players->map('ID', 'FirstName')));

        //  team two
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerOneTeamTwo', 'Player One (Team 2)', $players->map('ID', 'FirstName')));
        $fields->addFieldToTab('Root.Main', DropdownField::create('PlayerTwoTeamTwo', 'Player One (Team 2)', $players->map('ID', 'FirstName')));

        return $fields;
    }

    public function onBeforeWrite() {
        parent::onBeforeWrite();

        if ($this->ScoreTeamOne == 8 || $this->ScoreTeamTwo) {
            return false;
        }

    }

    public function getWinner() {
        return ($this->ScoreTeamOne > $this->ScoreTeamTwo) ? 'Team One' : 'Team Two';
    }

    public function GameLink() {
        return 'view/' . $this->ID;
    }

}