<?php

class TeamsAdmin extends ModelAdmin {

    private static $title = 'Teams';

    private static $url_segment = 'teams';

    private static $managed_models = array(
        'Team',
    );

}