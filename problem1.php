<pre><?php

	require_once('Make_Decision_Tree.php');

	$weatherStations = array('Adel','Ankeny','Carlisle','Altoona');
	
	$data = array();
	foreach ($weatherStations as $station):
		//print_r(getWeather($station));
		$weatherData = getWeather($station);
		$data[] = array("Condition"	=> $weatherData['current_observation']['weather'],
						"Temp"		=> $weatherData['current_observation']['temp_f'],
						"Wind"		=> $weatherData['current_observation']['wind_dir'],
						"Humid"		=> $weatherData['current_observation']['relative_humidity']);
	endforeach;

	//print_r($data);
	
	$dt = new Decision_Tree($data);


	$tree = $dt->classify('Condition','Partly Cloudy','Clear', 'Mostly Cloudy');
	echo "-------- Decision_Tree\n"; 
	print_r($tree);
	
	
	$target = array_shift($data);
	$res = $dt->prognosis($target);
	$res = $dt->exe_prognosis($tree,$target);

	echo "-------- estimate weather in Des Moines is as follow \n"; 
	print_r($res);


	function getWeather($slug){
		$data = file_get_contents("http://api.wunderground.com/api/9fcabc619b46b420/geolookup/conditions/q/IA/$slug.json");
		return $json_data = json_decode($data, true);
	}

?>

</pre>