<?php

class PlayersPage extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;
    }
}
class PlayersPage_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'view'
    );

    public function init() {
        parent::init();
    }

    public function getPlayers() {
        return Player::get();
    }

    public function view(SS_HTTPRequest $request) {
        $params = $request->params();
        $player_id = $params['ID'];
        $player = Player::get()->filter('ID', $player_id)->first();
        $link = $this->Link();
        $data = new ArrayData(array(
            'Player' => $player,
            'ParentLink' => $link,
        ));
        return $data->renderWith(array('Player', 'Page'));
    }

}