<?php
App::import('Core', 'HttpSocket');
class SteamSource extends DataSource {

	function __construct($config) {
		$this->connection = new HttpSocket("http://api.steampowered.com");
		parent::__construct($config);
	}
	
	public function listSources() {
		return array('steamnews','steamplayers','steamachievements');
	}

	public function read($model, $queryData = array()) 
	{		
		$results = array();
	
		switch($model->useTable)
		{
			case "steamnews":
				if (!isset($queryData['conditions']['appid'])) {
					$queryData['conditions']['appid'] = 440;
				}
				
				if (!isset($queryData['conditions']['count'])) {
					$queryData['conditions']['count'] = 10;
				}
				
				if (!isset($queryData['conditions']['maxlength'])) {
					$queryData['conditions']['maxlength'] = 0;
				}
				
				$url = "/ISteamNews/GetNewsForApp/v0001/";
				$url .= "?appid={$queryData['conditions']['appid']}&count={$queryData['conditions']['count']}&maxlength={$queryData['conditions']['maxlength']}&format=json";
				
				$response = json_decode($this->connection->get($url), true);
				$results[$model->useTable] = array();
				foreach($response['appnews']['newsitems']['newsitem'] as $data)
				{
					$results[$model->useTable][] = $data;
				}
				break;
			case "steamplayers":
				if (!isset($queryData['conditions']['steamids'])) {
					$queryData['conditions']['steamids'] = array("76561197960435530");
				}
				
				$steamids = implode($queryData['conditions']['steamids'], ',');

				$url = "/ISteamUser/GetPlayerSummaries/v0001/";
				$url .= "?key={$this->config['apikey']}&steamids={$steamids}&format=json";

				$response = json_decode($this->connection->get($url), true);
				$results[$model->useTable] = array();
				foreach($response['response']['players']['player'] as $data)
				{
					$results[$model->useTable][] = $data;
				}
				break;
			case "steamachievements":
				if (!isset($queryData['conditions']['gameid'])) {
					$queryData['conditions']['gameid'] = 440;
				}

				$url = "/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0001/";
				$url .= "?gameid={$queryData['conditions']['gameid']}&format=json";

				$response = json_decode($this->connection->get($url), true);
				$results[$model->useTable] = array();
				foreach($response['achievementpercentages']['achievements']['achievement'] as $data)
				{
					$results[$model->useTable][] = $data;
				}
				break;
		}

		return $results;
	}
	
	public function create($model, $fields = array(), $values = array())
	{
		return false;
	}	
	
	public function describe($model) {
		return $model->_schema;
	}
	
}
?>