<?php

class Team extends DataObject {

    private static $db = array(
    );

    private static $has_many = array(
        'Players' => 'Player',
    );

}