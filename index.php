<html>
<head>
<title>Domino Logs</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
.emotion_tone{
 background-color: #ffcccc;
}
.language_tone{
 background-color: #ccffcc;
}
.social_tone{
 background-color: #ccccff;
}
</style>
<script>
$( function(){
  $( ".slider" ).slider({disabled:true});
});
</script>
</head>
<body>
<table border="1">
<tr><th>tone</th><th width="250">slider</th><th>value</th></tr>

<?php
require_once( 'common.php' );

date_default_timezone_set( 'Asia/Tokyo' );

$text = getLogs();
$xml = simplexml_load_string( $text );
$events = $xml->event;

$logs = "";
$b = true;
for( $i = 0; $b && $i < count($events); $i ++ ){
  $event = $events[$i];
  if( strlen( $logs ) < 130000 ){
    $logs .=  $event[0];
  }else{
    $b = false;
  }
}

$ta = getTA( $logs );
?>

<?php
$document_tone = $ta->document_tone;
$tone_categories = $document_tone->tone_categories;

for( $i = 0; $i < count($tone_categories); $i ++ ){
  $tone_category = $tone_categories[$i];
  $category_id = $tone_category->category_id;
  $category_name = $tone_category->category_name;
  $tones = $tone_category->tones;
  for( $j = 0; $j < count($tones); $j ++ ){
    $tone = $tones[$j];
    $score = $tone->score;
    $tone_id = $tone->tone_id;
    $tone_name = $tone->tone_name;

    $tr = "<tr class=\"$category_id\"><td>$tone_name</td><td><div id=\"$tone_id\" class=\"slider\"></div><script>$(function(){ $( \"#$tone_id\" ).slider( \"value\", $score *100 );});</script></td><td>$score</td></tr>\n";
    echo $tr;
  }
}
?>
</table>

<!-- $tone_categories
<?php var_dump($tone_categories); ?>
-->

</body>
</html>

