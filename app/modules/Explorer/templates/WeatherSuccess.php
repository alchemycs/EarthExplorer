<?php
$weather = $t['place']->getWeather();
?>
<h3><a href="<?php echo $weather->results->rss->channel->link;?>"><?php echo htmlentities((string)$weather->results->rss->channel->title); ?></a></h3>
<?php echo (string)$weather->results->rss->channel->item->description; ?>
