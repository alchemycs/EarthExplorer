<div class="fb-widget" id="fbtb-2fea73533c5646f59cda6fbe87903d00" style="border:0; outline:0; padding:0; margin:0; position:relative; float:right" itemscope="" itemid="http://www.freebase.com/id/m/06w2tsz" itemtype="http://www.freebase.com/id/common/topic"> <form class="fb-widget-placeholder" style="border:0; outline:0; padding:0; margin:0;"> <input name="src" value="http://www.freebase.com/widget/topic?track=topicblocks_homepage&amp;mode=content&amp;id=%2Fm%2F06w2tsz" type="hidden" /> <input name="width" value="413" type="hidden" /> <input name="height" value="285" type="hidden" /> <span style="line-height:1; border:0; outline:0; padding:0; margin:0; display:inline-block; padding:5px; background:#eee; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;"> <div style="text-align:left; vertical-align:baseline; line-height:1; border:0; outline:0; margin:0 0 5px 5px;"> <a style="text-align:left; vertical-align:baseline; font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; font-weight:bold; line-height:1.6; text-decoration:none; color:#17b; border:0; outline:0; padding:0; margin:0;" href="http://www.freebase.com/view/m/06w2tsz" target="_blank" > W3C Geolocation API </a> </div> <div style="vertical-align:top; border:1px solid #ddd; outline:0; padding:0; margin:0; position: relative; width:400px; height:220px; overflow:auto; background-color:#fff"> <img src="http://img.freebase.com/api/trans/image_thumb/m/06w2tsz?pad=1&amp;errorid=%2Ffreebase%2Fno_image_png&amp;maxheight=150&amp;mode=fillcropmid&amp;maxwidth=150" title="W3C Geolocation API" style="border:0; outline:0; padding: 0; margin: 28px auto; display: block;"> </div> </span> </form> <script src="http://freebaselibs.com/static/widgets/2/widget.js" type="text/javascript" defer=""></script> </div>
<div>
    <h1>Where are you?</h1>
    <p>
        EarthExplorer would like to use your current location as a starting point.
        If you have a browser that supports the HTML5 Geo Location API, you may
        see a popup box asking you to share your information.
    </p>
    <p>
        By sharing your information you allow EarthExplorer to start with a place
        that is relevant for you. Of course, you may be interested in somewher else
        on Earth and you can happily search for the place you are looking for.
    </p>
</div>
<div>
    <a href="<?php echo $ro->gen('PrivacyPolicy');?>" class="button orange">Privacy Policy</a>
    <a id="ipLink" style="display:none" href="<?php echo $ro->gen('Explore');?>" class="button green">Just use my IP address</a>
    <a href="<?php echo $ro->gen('Explore.Location', array('woeid'=>1, 'slug_name'=>'Earth'));?>" class="button blue">Start With Earth</a>
</div>
<script type="text/javascript" src="http://isithackday.com/hacks/geo/yql-geo-library/yqlgeo.js"></script>
<script type="text/javascript">
YUI({

}).use('node','dump', function(Y){
   yqlgeo.get('visitor', function(o) {
    var woeid = o.place.woeid;
    var name = o.place.name;
    var redirect = '<?php echo $ro->gen('Explore', array(), array('relative'=>false));?>/'+woeid+'-'+name.replace(/[^a-zA-Z0-9]/, '-');

    var node = Y.one('#ipLink');
    node.set('href', redirect);
    node.set('innerHTML', 'Start with '+name);
    node.setStyle('display', 'inline');

    //document.location = redirect;
//    alert(redirect);
//    alert(Y.dump(o));
//    alert(o.place.woeid);
//    alert(o.place.name);
   });
});

</script>