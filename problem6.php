<?php

$hotQuestion = getStackEx("https://api.stackexchange.com/2.2/questions?pagesize=1&order=desc&sort=hot&site=woodworking&filter=withbody");

// Original question and answers
echo "<h1>Original Question & Answers</h1>";
echo "<b>Q: ";
echo $Q["title"] = $hotQuestion["items"][0]["title"];
echo "</b>\n";
echo $Q["body"]  = $hotQuestion["items"][0]["body"];
$Q["id"] 	= $hotQuestion["items"][0]["question_id"];

echo "<h3>Answers</h3>";
$answersToQ = getStackEx("https://api.stackexchange.com/2.2/questions/".$Q["id"] ."/answers?order=desc&sort=activity&site=woodworking&filter=withbody");
$count = 1;
foreach($answersToQ['items'] as $answer):
	echo "<b>Answer $count -</b> ".$answer['body'];
	$count++;
endforeach;


// Pirate speak question and answers
echo "<h1>Pirate Speak Question & Answers</h1>";
echo "<b>Q: ";
echo getPirateText($Q["title"]);
echo "</b>\n";
echo getPirateText($Q["body"]);
echo "<h3>Answers</h3>";
$count = 1;
foreach($answersToQ['items'] as $answer):
	echo "<b>Answer $count -</b> ".getPirateText($answer['body']);
	$count++;
endforeach;



function getStackEx($apiURL){
	$data = file_get_contents($apiURL);
	return $json_data = json_decode(gzdecode($data), true);
}


function getPirateText($normalText){
	return file_get_contents("http://isithackday.com/arrpi.php?text=".urlencode($normalText));
}

?>