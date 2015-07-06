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
        'view',
        'addplayer',
        'doAddplayer',
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

    public function addplayer(SS_HTTPRequest $request) {
         $data = new ArrayData(array(
            'Form' => $this->newplayerForm(),
            'ParentLink' => $this->Link(),
        ));
        return $data->renderWith(array('Newplayer', 'Page'));
    }

    public function newPlayerForm() {

        $fields = new FieldList(
            TextField::create('FirstName', 'First Name'),
            TextField::create('Surname', 'Surname')
        );

        $actions = new FieldList(
            FormAction::create("doAddplayer")->setTitle("Add player")
        );

        $required = new RequiredFields('FirstName', 'Surname');

        $form = Form::create($this, 'doAddPlayer', $fields, $actions, $required);

        $form->setTemplate('forms/NewPlayerForm');

        return $form;
    }

    public function success() {
        return ($this->getRequest()->getVar('success')) ? true : false;
    }

    public function doAddPlayer($data, Form $form) {

        $player = Player::create();

        $player->FirstName = $data['FirstName'];
        $player->Surname = $data['Surname'];

        $player->write();

        $redirectLink = $this->Link() . '?success=1';

        return $this->redirect($redirectLink);
    }

}