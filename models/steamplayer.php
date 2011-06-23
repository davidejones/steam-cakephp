<?php
class Steamplayer extends AppModel {
	public $useDbConfig = 'steam';
	
	function schema() {
        $this->_schema = array(
            'steamid' => array('type' => 'String'),
			'personaname' => array('type' => 'String'),
			'profileurl' => array('type' => 'String'),
			'avatar' => array('type' => 'String'),
            'avatarmedium' => array('type' => 'String'),
            'avatarfull' => array('type' => 'String'),
			'personastate' => array('type' => 'integer'),
            'communityvisibilitystate' => array('type' => 'integer'),
            'profilestate' => array('type' => 'integer'),
            'lastlogoff' => array('type' => 'integer'),
            'commentpermission' => array('type' => 'integer'),
            'realname' => array('type' => 'String'),
            'primaryclanid' => array('type' => 'String'),
            'timecreated' => array('type' => 'integer'),
            'gameid' => array('type' => 'integer'),
            'gameserverip' => array('type' => 'String'),
            'gameextrainfo' => array('type' => 'String'),
            'cityid' => array('type' => 'String'),
            'loccountrycode' => array('type' => 'String'),
            'locstatecode' => array('type' => 'String'),
            'loccityid' => array('type' => 'String'),
        );
        return $this->_schema;
	}
	
}
?>