<?php

class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}
}
class Page_Controller extends ContentController {

	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		$themeDir = $this->ThemeDir();
		// CSS
		Requirements::css($themeDir . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
		Requirements::css($themeDir . '/bower_components/bootstrap/dist/css/bootstrap-theme.min.css');
		Requirements::css($themeDir . '/css/master.css');
		// JavaScript
		Requirements::javascript($themeDir . '/bower_components/jquery/dist/jquery.min.js');
		Requirements::javascript($themeDir . '/bower_components/bootstrap/dist/js/bootstrap.min.js');
		Requirements::javascript($themeDir . '/bower_components/angular/angular.min.js');
		Requirements::javascript($themeDir . '/javascript/functions.js');
	}


}
