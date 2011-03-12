<?php
$places = $t['places'];
//var_dump($places);
?>

<div class="yui3-gd">
    <div class="yui3-u first">
<h2><?php echo htmlspecialchars($t['_title']);?></h2>
        <ul>
            <?php foreach ($places as $place) : ?>
            <li>
                <a href="<?php echo $place->getUrl();?>"><?php echo htmlspecialchars($place->getLongDisplayName()); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="yui3-u">
        <div id="map">
        </div>
    </div>
</div>
<?php if (count($places)<50): ?>
<div>
    <dl>
    <?php foreach($places as $place) :?>
    <?php foreach($place->getWikipediaArticles() as $article):?>
        <dt style="font-weight:bold; clear:both;margin-top:1em">
                <a target="wikipedia" href="http://<?php echo $article['wikipediaUrl'];?>"><?php echo htmlspecialchars($article['title']); ?></a>
        </dt>
        <dd>
                <?php if(isset($article['thumbnailImg'])): ?>
            <img src="<?php echo $article['thumbnailImg'];?>" style="float:left; border: 1px solid gray;padding:.5em; margin-top:5px;margin-right:10px;margin-bottom:10px;-webkit-border-radius:5px;-webkit-box-shadow: 2px 2px 5px gray" alt=""/>
                <?php endif;?>
            <p>
                <?php echo htmlspecialchars(substr($article['summary'], 0, -5)); ?> ...
                (<a target="wikipedia" href="http://<?php echo $article['wikipediaUrl'];?>">more on Wikipedia</a>)
            </p>
            <pre>
                    <?php //var_dump($article);?>
            </pre>
        </dd>
    <?php endforeach;?>
    <?php endforeach;?>
    </dl>
</div>
<?php endif;?>
<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.8&amp;appid=<?php echo AgaviConfig::get('YAHOO.ymappid');?>"></script>
<script type="text/javascript">
var points = new Array();
var placeNames = new Array();
var placeUrl = new Array();
<?php foreach ($places as $place) : ?>
    <?php if ($place->getWoeid()==1) continue; ?>
points[points.length] = new YGeoPoint(<?php echo $place->getCentroid()->getLatitude();?>, <?php echo $place->getCentroid()->getLongitude();?>);
placeNames[placeNames.length] = '<?php echo addslashes($place->getLongDisplayName());?>';
placeUrl[placeUrl.length] ='<?php echo $place->getUrl();?>';
<?php endforeach;?>
//Begin ClarifyMap
<?php include('ClarifyMap.js'); ?>
//End ClarofyMap
</script>
