<?php
$place = $t['place'];
$placeSummary = $place->getPlaceSummary();
?>
<div class="yui3-g" id="locationDetail">
    <div style="float:right; margin-top:1em; margin-right:.5em">
        <a href="<?php echo $ro->gen('Explore.Location.BelongsTo');?>" class="button medium white">Belongs To</a>
        <a href="<?php echo $ro->gen('Explore.Location.Neighbours');?>" class="button medium white">Neighbours</a>
        <a href="<?php echo $ro->gen('Explore.Location.Contains');?>" class="button medium white">Contains</a>
    </div>
    <h2><?php printf("%s", htmlspecialchars($place->getShortDisplayName()));?></h2>
    <div class="yui3-g first">
        <div class="yui3-u first primaryDetail">
            <?php if (count($placeSummary)):?>
            <h3>Place Details</h3>
            <dl class="placeDetails">
                <?php foreach($placeSummary as $type=>$name): ?>
                <dt>
                <?php echo htmlspecialchars($type); ?>
                </dt>
                <dd>
                <?php echo htmlspecialchars($name);?>
                </dd>
                    <?php endforeach;?>
            </dl>
            <?php else: ?>
            <h3>No Summary Information Available</h3>
            <?php endif;?>
        </div>
        <div class="yui3-u">
            <div id="weatherDetail">
                <?php if ($slots['weather']) echo $slots['weather']; ?>
            </div>
        </div>
    </div>
    <div class="yui3-u">
        <div id="mapDetail">
            <div id="map" >
            </div>
        </div>
    </div>
</div>
<div>
    <dl>
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
    </dl>
</div>
<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.8&amp;appid=<?php echo AgaviConfig::get('YAHOO.ymappid');?>"></script>
<script type="text/javascript">
    var locationName = '<?php echo $place->getLongDisplayName();?>';
    var woeid = <?php echo $place->getWoeid();?>;
    var locationUrl ='<?php echo $place->getUrl();?>';
    var centroid = {
        latitude:'<?php echo $place->getCentroid()->getLatitude();?>',
        longitude:'<?php echo $place->getCentroid()->getLongitude();?>'
    };
    var boundingBox = {
        southWest: {
            latitude:'<?php echo $place->getBoundingBox()->getSouthWest()->getLatitude();?>',
            longitude:'<?php echo $place->getBoundingBox()->getSouthWest()->getLongitude();?>'
        },
        northEast : {
            latitude:'<?php echo $place->getBoundingBox()->getNorthEast()->getLatitude();?>',
            longitude:'<?php echo $place->getBoundingBox()->getNorthEast()->getLongitude();?>'
        }
    };
<?php include('ExplorerMap.js'); ?>
</script>
