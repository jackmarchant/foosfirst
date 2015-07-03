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
    );

    public function getGames() {
        return Game::get();
    }

    public function view(SS_HTTPRequest $request) {
        $params = $request->params();
        $game_id = $params['ID'];
        $game = Game::get()->filter('ID', $game_id)->first();
        $players = $game->Players();
        $link = PlayersPage::get()->first()->Link();
        $data = new ArrayData(array(
            'Players' => $players,
            'LeaderboardLink' => $link,
        ));
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

        $form->setTemplate('form/NewGameForm');

        return $form;
    }

    public function doAddGame($data, Form $form) {

        $game = Game::create();

        $game->ScoreTeamOne = $data['ScoreTeamOne'];
        $game->ScoreTeamTwo = $data['ScoreTeamTwo'];

        $game->write();

        return $this->redirectBack();
    }

}