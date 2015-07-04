<?php

class TeamsPage extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;
    }
}
class TeamsPage_Controller extends Page_Controller {

    public function getTeams() {
        $teams = Team::get();
        $data = new ArrayList();
        foreach ($teams as $team) {
            $teamArray = array();
            $teamArray['PlayerOne'] = $this->getPlayerNameById($team->PlayerOne);
            $teamArray['PlayerTwo'] = $this->getPlayerNameById($team->PlayerTwo);
            $teamArray['GamesPlayed'] = $team->getGamesPlayed();
            $data[] = $teamArray;
        }
        return $data;
    }

    public function getPlayerNameById($id) {
        return Player::get()->filter('ID', $id)->first()->Name;
    }

}