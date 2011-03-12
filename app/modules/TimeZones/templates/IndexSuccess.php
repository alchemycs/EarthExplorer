<?php
$timeZoneModel = $t['timeZoneModel'];
?>
<div class="yui3-g" id="locationDetail">
    <h2>World Time Zones</h2>
    <div class="yui3-u first">
        <div class="primaryDetail">
            <dl>
            <?php foreach($timeZoneModel->getRegionNames() as $regionName):?>
                <dt>
                <?php 
                $place = $timeZoneModel->getPlaceForRegion($regionName);
                echo "Class: ".get_class($place)."--";
                printf("%s (%s)", $place->getPlaceName(), $place->getWoeid());
                ?>
            </dt>
            <?php endforeach;?>
            </dl>
        </div>
    </div>
    <div class="yui3-u">
        <div class="fb-widget" id="fbtb-fc0514f9b3aa405faeb3892c93856501" style="border:0; outline:0; padding:0; margin:0; position:relative;" itemscope="" itemid="http://www.freebase.com/id/en/time_zone" itemtype="http://www.freebase.com/id/common/topic"> <form class="fb-widget-placeholder" style="border:0; outline:0; padding:0; margin:0;"> <input name="src" value="http://www.freebase.com/widget/topic?track=topicblocks_homepage&amp;mode=content&amp;id=%2Fen%2Ftime_zone" type="hidden" /> <input name="width" value="413" type="hidden" /> <input name="height" value="285" type="hidden" /> <span style="line-height:1; border:0; outline:0; padding:0; margin:0; display:inline-block; padding:5px; background:#eee; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;"> <div style="text-align:left; vertical-align:baseline; line-height:1; border:0; outline:0; margin:0 0 5px 5px;"> <a style="text-align:left; vertical-align:baseline; font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; font-weight:bold; line-height:1.6; text-decoration:none; color:#17b; border:0; outline:0; padding:0; margin:0;" href="http://www.freebase.com/view/en/time_zone" target="_blank" > Time zone </a> </div> <div style="vertical-align:top; border:1px solid #ddd; outline:0; padding:0; margin:0; position: relative; width:400px; height:220px; overflow:auto; background-color:#fff"> <img src="http://img.freebase.com/api/trans/image_thumb/en/time_zone?pad=1&amp;errorid=%2Ffreebase%2Fno_image_png&amp;maxheight=150&amp;mode=fillcropmid&amp;maxwidth=150" title="Time zone" style="border:0; outline:0; padding: 0; margin: 28px auto; display: block;"> </div> </span> </form> <script src="http://freebaselibs.com/static/widgets/2/widget.js" type="text/javascript" defer=""></script> </div>
    </div>
</div>