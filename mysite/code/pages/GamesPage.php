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
        'view'
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

}