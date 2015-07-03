<?php

class GamesAdmin extends ModelAdmin {

    private static $title = 'Games';

    private static $url_segment = 'games';

    private static $managed_models = array(
        'Game',
    );

}