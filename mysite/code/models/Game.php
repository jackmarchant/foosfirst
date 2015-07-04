<?php

class Game extends DataObject {

    private static $db = array(
        'ScoreTeamOne' => 'Int',
        'ScoreTeamTwo' => 'Int',
        'Winner' => 'Varchar',
    );

    private static $has_one = array(

    );

    private static $summary_fields = array(
        'Winner' => 'Winner',
        'ScoreTeamOne' => 'ScoreTeamOne',
        'ScoreTeamTwo' => 'ScoreTeamTwo',
    );

    private static $many_many = array(
        'Teams' => 'Team',
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if ($this->ScoreTeamOne != 8 && $this->ScoreTeamTwo != 8) {
            $fields->addFieldToTab('Root.Main',
                LiteralField::create('Message', '<p class="message error">One team has to score 8 to win. Please check the scores for this game.</p>'),
                'ScoreTeamOne'
            );
        }

        return $fields;
    }

    public function onBeforeWrite() {
        parent::onBeforeWrite();
        if ($this->ScoreTeamOne != 8 || $this->ScoreTeamTwo != 8) {
            // stop this from happening
        }

        $winner = ($this->ScoreTeamOne > $this->ScoreTeamTwo) ? 'Team One' : 'Team Two';
        $this->Winner = $winner;
    }

    public function getWinner() {
        return ($this->ScoreTeamOne > $this->ScoreTeamTwo) ? 'Team One' : 'Team Two';
    }

    public function GameLink() {
        return 'view/' . $this->ID;
    }

    public function getTeams() {
        return $this->Teams();
    }

}