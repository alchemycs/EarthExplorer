/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

YUI().use('node', 'dump', function(Y) {
    Y.on('domready', function(){

        try {
            var map = Y.one('#map');
            var mapRegion = map.get('region');
            map.setStyle('height', mapRegion.width/1.4142+'px');

            var yMap = new YMap(Y.Node.getDOMNode(map));
            yMap.setMapType(YAHOO_MAP_REG);
            yMap.addPanControl();
            yMap.addZoomLong();
            yMap.addTypeControl();
            yMap.disableKeyControls();
            var bestZoomAndCenter = yMap.getBestZoomAndCenter([
                new YGeoPoint(boundingBox.northEast.latitude, boundingBox.northEast.longitude),
                new YGeoPoint(boundingBox.southWest.latitude, boundingBox.southWest.longitude),
                ]);
            if (bestZoomAndCenter.zoomLevel > 17) bestZoomAndCenter.zoomLevel = 17;
            if (bestZoomAndCenter.zoomLevel < 1) bestZoomAndCenter.zoomLevel = 1;
            var marker = new YMarker(new YGeoPoint(centroid.latitude, centroid.longitude))
            marker.addAutoExpand(locationName);
            yMap.addOverlay(marker);
            yMap.drawZoomAndCenter(bestZoomAndCenter.YGeoPoint, bestZoomAndCenter.zoomLevel);

        //            var weatherRSS = 'http://weather.yahooapis.com/forecastrss?w='+woeid;
        //            alert(weatherRSS);
        //            yMap.addOverlay(new YGeoRSS(weatherRSS));
        } catch (e) {
            alert('Exception: '+Y.dump(e));
        }


    })


});