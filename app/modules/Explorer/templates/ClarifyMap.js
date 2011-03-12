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
            var bestZoomAndCenter = yMap.getBestZoomAndCenter(points);
            yMap.drawZoomAndCenter(bestZoomAndCenter.YGeoPoint, bestZoomAndCenter.zoomLevel);
            for (var index in points) {
                var marker = new YMarker(points[index]);
                marker.addAutoExpand(placeNames[index].link(placeUrl[index]));
                yMap.addOverlay(marker);
            }

        } catch (e) {
            alert('Exception: '+Y.dump(e));
        }

    });

});
