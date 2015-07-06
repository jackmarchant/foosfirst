<?php

class GamesPage extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;
    }
}
class GamesPage_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'view',
        'addgame',
        'doAddGame',
        'assignteams',
        'doAssignTeams',
    );

    public function getGames() {
        return Game::get()->sort('Created DESC');
    }

    public function view(SS_HTTPRequest $request) {
        $params = $request->params();
        $game_id = $params['ID'];
        $game = Game::get()->filter('ID', $game_id)->first();
        $teams = $game->Teams();
        $allTeams = array();
        foreach ($teams as $team) {
            $teamArr = array();
            $player_one = Player::get()->filter('ID', $team->PlayerOne)->first();
            $player_two = Player::get()->filter('ID', $team->PlayerTwo)->first();
            $teamArr['Names'] = $player_one->Name . ' & ' . $player_two->Name;
            $teamArr['GamesPlayed'] = $team->getGamesPlayed();
            $teamArr['TeamID'] = $team->ID;
            if ($allTeams == array()) {
                $allTeams['TeamOne'] = $teamArr;
            } else {
                $allTeams['TeamTwo'] = $teamArr;
            }
        }
        $link = $this->Link();
        $data = new ArrayData(array(
            'Teams' => $allTeams,
            'ParentLink' => $link,
            'Winner' => $game->Winner,
            'Score' => $game->ScoreTeamOne . '-' . $game->ScoreTeamTwo,
        ));
        if ($data->getField('Teams') == array()) {
            $data = new ArrayData(array(
                'Content' => 'There are no teams assigned to this game.',
                'AddNewTeam' => '<a href="' . $link . 'assignteams/'. $game_id .'" class="btn btn-success">Assign a Team to this game</a>',
                'ParentLink' => $this->Link(),
            ));
            Session::set('GameID', $game_id);
        }
        return $data->renderWith(array('Game', 'Page'));
    }

    public function addgame(SS_HTTPRequest $request) {
         $data = new ArrayData(array(
            'Form' => $this->newGameForm(),
            'ParentLink' => $this->Link(),
        ));
        return $data->renderWith(array('NewGame', 'Page'));
    }

    public function newGameForm() {

        $fields = new FieldList(
            NumericField::create('ScoreTeamOne', 'Score Team One'),
            NumericField::create('ScoreTeamTwo', 'Score Team Two')
        );

        $actions = new FieldList(
            FormAction::create("doAddGame")->setTitle("Add Game")
        );

        $required = new RequiredFields('ScoreTeamOne', 'ScoreTeamTwo');

        $form = Form::create($this, 'doAddGame', $fields, $actions, $required);

        $form->setTemplate('forms/NewGameForm');

        return $form;
    }

    public function doAddGame($data, Form $form) {

        $game = Game::create();

        $game->ScoreTeamOne = $data['ScoreTeamOne'];
        $game->ScoreTeamTwo = $data['ScoreTeamTwo'];

        $game->write();

        $redirectLink = $this->Link() . '?success=1';

        return $this->redirect($redirectLink);
    }

    public function success() {
        return ($this->getRequest()->getVar('success')) ? true : false;
    }

    public function assignteams(SS_HTTPRequest $request) {

        $params = $request->params();
        $game_id = $params['ID'];

        $teams = Team::get();

        $data = new ArrayData(array(
            'Form' => $this->assignTeamsForm($game_id),
            'ParentLink' => $this->Link()
        ));

        return $data->renderWith(array('AssignTeams', 'Page'));

    }

    public function assignTeamsForm($game_id) {

        $teams = Team::get();
        $teamOne = DropdownField::create('TeamOne', 'Team One', $teams->map('ID', 'getTeamNames'));
        $teamTwo = DropdownField::create('TeamTwo', 'Team Two', $teams->map('ID', 'getTeamNames'));
        $gameID = HiddenField::create('GameID', 'Game ID', $game_id);

        $fields = new FieldList(
            $teamOne,
            $teamTwo,
            $gameID
        );

        $actions = new FieldList(
            FormAction::create("doAssignTeams")->setTitle("Assign Teams to this game")
        );

        $required = new RequiredFields('TeamOne', 'TeamTwo');

        $form = Form::create($this, 'doAssignTeams', $fields, $actions, $required);

        $form->setTemplate('forms/AssignTeamsForm');

        return $form;
    }

    public function doAssignTeams($data, Form $form) {

        // assign teams to the game
        $game = Game::get()->filter('ID', $data['GameID'])->first();

        $teamsCount = $game->Teams()->count();
        if ($teamsCount < 2) {
            // add the teams
            $game->Teams->add($data['TeamOne']);
            $game->Teams->add($data['TeamTwo']);
        }

        $redirectLink = $this->Link() . '?success=1';

        return $this->redirect($redirectLink);
    }

}