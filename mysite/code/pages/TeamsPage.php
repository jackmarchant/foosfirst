<?php

class TeamsPage extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );

    private static $has_many = array(
        'Players' => 'Player'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;
    }
}
class TeamsPage_Controller extends Page_Controller {

    public function getTeams() {
        return Team::get()->Players();
    }

}