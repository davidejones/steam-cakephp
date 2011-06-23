<?php
class TestsController extends AppController {

	var $name = 'Tests';
	var $uses = array('Steamnews','Steamplayer','Steamachievements');

	function index()
	{
	
		# Find all steam news articles (default is to show 10 news with full content length and for game tf2)
		pr($this->Steamnews->find('all'));
		
		# Find all the News items For a game by supplying gameid the number of news items and content length to return.
		pr($this->Steamnews->find('all',array('conditions'=>array('appid'=>440,'count'=>3,'maxlength'=>300))));
		
		# Find all the PlayerSummaries (because api requires steamid default is robin walker)
		pr($this->Steamplayer->find('all'));
		
		# Find all the PlayerSummaries by supplying steam ids
		pr($this->Steamplayer->find('all',array('conditions'=>array('steamids'=>array("76561197994235337","76561198034180652")))));
		
		# Find all the Global Achievement Percentages For a game
		pr($this->Steamachievements->find('all'));
		
		$this->autoRender = false;
		exit();
	}

}
?>