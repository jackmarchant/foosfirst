<?php

class PlayersAdmin extends ModelAdmin {

    private static $title = 'Players';

    private static $url_segment = 'players';

    private static $managed_models = array(
        'Player',
    );

}