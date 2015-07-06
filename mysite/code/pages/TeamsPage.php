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

    private static $allowed_actions = array(
        'addteam',
        'doAddTeam',
    );

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

    public function addteam(SS_HTTPRequest $request) {
        $data = new ArrayData(array(
            'Form' => $this->newTeamForm(),
            'ParentLink' => $this->Link(),
        ));
        return $data->renderWith(array('NewTeam', 'Page'));
    }


    // check success getvar appended to url
    // return boolean
    public function success() {
        return ($this->getRequest()->getVar('success')) ? true : false;
    }

    public function newTeamForm() {

        $players = Player::get();
        $playerOne = DropdownField::create('PlayerOne', 'Player One', $players->map('ID', 'FirstName'));
        $playerTwo = DropdownField::create('PlayerTwo', 'Player Two', $players->map('ID', 'FirstName'));


        $fields = new FieldList(
            $playerOne,
            $playerTwo
        );

        $actions = new FieldList(
            FormAction::create("doAddTeam")->setTitle("Add Team")
        );

        $required = new RequiredFields('PlayerOne', 'PlayerTwo');

        $form = Form::create($this, 'doAddTeam', $fields, $actions, $required);

        $form->setTemplate('forms/NewTeamForm');

        return $form;
    }

    public function doAddTeam($data, Form $form) {

        // check if the player combination for a new team already exists
        $teamExists = $this->teamExists($data['PlayerOne'], $data['PlayerTwo']);
        if (!$teamExists) {
            // check other combination
            $teamExists = $this->teamExists($data['PlayerTwo'], $data['PlayerOne']);
        }

        if ($teamExists) {
            // team already exists
            return $this->redirectBack();

        } else {
            // check again - opposite order

            // create the new team with player ID's
            $team = Team::create();

            $team->PlayerOne = $data['PlayerOne'];
            $team->PlayerTwo = $data['PlayerTwo'];

            $team->write();

            $redirectLink = $this->Link() . '?success=1';

            return $this->redirect($redirectLink);

        }


    }

    /*
     *  Check if a team combination exists
     *  return boolean
     *  @param $playerOne (tinyint - ID)
     *  @param $playerTwo (tinyint -ID)
     */
    public function teamExists($playerOne, $playerTwo) {
        return (Team::get()->filter(array('PlayerOne'=>$playerOne, 'PlayerTwo'=>$playerTwo))->count() > 0) ? true : false;
    }

}