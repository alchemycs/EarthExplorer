<?php
require_once('GeoPointModel.class.php');
require_once('BoundingBoxModel.class.php');

class Explorer_PlaceModel extends EEExplorerBaseModel
{

    protected $xmlPlace;
    protected $centroid;
    protected $boundingBox;
    protected $placeFinderModel;
    protected $belongsToPlaces;
    protected $neighborPlaces;
    protected $childPlaces;
    protected $weather;

    public function initialize(AgaviContext $context, array $parameters = array()) {
        parent::initialize($context, $parameters);
        $this->xmlPlace = $parameters['place'];
        $this->centroid = $context->getModel('GeoPoint', 'Explorer', array(
            'latitude'=>(string)$this->xmlPlace->centroid->latitude,
            'longitude'=>(string)$this->xmlPlace->centroid->longitude
        ));
        $this->boundingBox = $context->getModel('BoundingBox', 'Explorer', array(
            'southWest'=>$context->getModel('GeoPoint', 'Explorer', array(
                'latitude'=>(string)$this->xmlPlace->boundingBox->southWest->latitude,
                'longitude'=>(string)$this->xmlPlace->boundingBox->southWest->longitude,
            )),
            'northEast'=>$context->getModel('GeoPoint', 'Explorer', array(
                'latitude'=>(string)$this->xmlPlace->boundingBox->northEast->latitude,
                'longitude'=>(string)$this->xmlPlace->boundingBox->northEast->longitude,
            ))
        ));
    }

    public function getPlaceFinder() {
        if (!$this->placeFinderModel) {
            $this->placeFinderModel = $this->getContext()->getModel('PlaceFinder','Explorer', array(
                'options'=>array(
                    'format'=>xml
                )
            ));
        }
        
        return $this->placeFinderModel;
    }

    public function getShortDisplayName() {
        return sprintf("%s (%s)", $this->getPlaceName(), $this->getPlaceTypeName());
    }

    public function getLongDisplayName() {
        $country = $this->getCountry();
        return sprintf('%s (%s)%s',
                $this->getPlaceName(),
                $this->getPlaceTypeName(),
                (empty($country)?'':', '.$this->getCountry())
                );
    }

    public function getSluggableName() {
        $sluggableName = preg_replace('/[^a-zA-Z0-9_\-]{1,}/', '-', $this->getLongDisplayName());
        return trim($sluggableName, " -");
    }

    public function getUrl() {
        return $this->getContext()->getRouting()->gen('Explore.Location', array(
            'woeid'=>$this->getWoeid(),
            'slug_name'=>$this->getSluggableName()
        ));
    }

    public function getWoeid() {
        return (int)$this->xmlPlace->woeid;
    }

    public function getPlaceName() {
        return (string)$this->xmlPlace->name;
    }

    public function getPlaceTypeName() {
        return (string)$this->xmlPlace->placeTypeName;
    }

    public function getPlaceTypeCode() {
        return (string)$this->xmlPlace->placeTypeName['code'];
    }

    public function getCountry() {
        return (string)$this->xmlPlace->country;
    }

    public function getCountryCode() {
        return (string)$this->xmlPlace->country['code'];
    }

    public function getCountryType() {
        return (string)$this->xmlPlace->country['type'];
    }

    public function getAdmin1() {
        return (string)$this->xmlPlace->admin1;
    }
    public function getAdmin1Code() {
        return (string)$this->xmlPlace->admin1['code'];
    }
    public function getAdmin1Type() {
        return (string)$this->xmlPlace->admin1['type'];
    }

    public function getAdmin2() {
        return (string)$this->xmlPlace->admin2;
    }
    public function getAdmin2Code() {
        return (string)$this->xmlPlace->admin2['code'];
    }
    public function getAdmin2Type() {
        return (string)$this->xmlPlace->admin2['type'];
    }

    public function getAdmin3() {
        return (string)$this->xmlPlace->admin3;
    }
    public function getAdmin3Code() {
        return (string)$this->xmlPlace->admin3['code'];
    }
    public function getAdmin3Type() {
        return (string)$this->xmlPlace->admin3['type'];
    }

    public function getLocality1() {
        return (string)$this->xmlPlace->locality1;
    }
    public function getLocality1Type() {
        return (string)$this->xmlPlace->locality1['type'];
    }

    public function getLocality2() {
        return (string)$this->xmlPlace->locality2;
    }
    public function getLocality2Type() {
        return (string)$this->xmlPlace->locality2['type'];
    }

    public function getPostal() {
        return (string)$this->xmlPlace->postal;
    }
    public function getPostalType() {
        return (string)$this->xmlPlace->postal['type'];
    }

    public function getAreaRank() {
        return (string)$this->xmlPlace->areaRank;
    }

    public function getPopulationRank() {
        return (string)$this->xmlPlace->popRank;
    }

    public function getCentroid() {
        return $this->centroid;
    }

    public function getBoundingBox() {
        return $this->boundingBox;
    }

    public function getPlaceSummary() {
        $placeInformation = array();
        if (!empty($this->xmlPlace->country)) {
            $placeInformation[(string)$this->xmlPlace->country['type']]=(string)$this->xmlPlace->country;
        }
        if (!empty($this->xmlPlace->admin1)) {
            $placeInformation[(string)$this->xmlPlace->admin1['type']]=(string)$this->xmlPlace->admin1;
        }
        if (!empty($this->xmlPlace->admin2)) {
            $placeInformation[(string)$this->xmlPlace->admin2['type']]=(string)$this->xmlPlace->admin2;
        }
        if (!empty($this->xmlPlace->admin3)) {
            $placeInformation[(string)$this->xmlPlace->admin3['type']]=(string)$this->xmlPlace->admin3;
        }
        if (!empty($this->xmlPlace->locality1)) {
            $placeInformation[(string)$this->xmlPlace->locality1['type']]=(string)$this->xmlPlace->locality1;
        }
        if (!empty($this->xmlPlace->locality2)) {
            $placeInformation[(string)$this->xmlPlace->locality2['type']]=(string)$this->xmlPlace->locality2;
        }
        if (!empty($this->xmlPlace->postal)) {
            $placeInformation[(string)$this->xmlPlace->postal['type']]=(string)$this->xmlPlace->postal;
        }

        return $placeInformation;
    }

    public function getBelongsTo() {
        if (!$this->belongsToPlaces) {
            $this->belongsToPlaces = $this->getPlaceFinder()->findBelongsToByPlace($this);
        }
        return $this->belongsToPlaces;
    }

    public function getNeighbors() {
        if (!$this->neighborPlaces) {
            $this->neighborPlaces = $this->getPlaceFinder()->findNeighborsByPlace($this);
        }
        return $this->neighborPlaces;
    }

    public function getChildren() {
        if (!$this->childPlaces) {
            $this->childPlaces = $this->getPlaceFinder()->findChildrenByPlace($this);
        }
        return $this->childPlaces;
    }

    public function getWeather($refresh = false) {
        if ($this->weather && !$refresh) {
//            die('already loaded');
            return $this->weather;
        }
        $yql = $this->getContext()->getModel('YQL', null, array(
            'uses'=>array('weather.woeid'=>'http://www.datatables.org/weather/weather.woeid.xml')
        ));
        $result = $yql->executeQuery('SELECT * FROM weather.woeid where w=${woeid} and u="c"', array('woeid'=>$this->getWoeid()));
        $result = simplexml_load_string($result);
        $this->weather = $result;
        return $result;
    }

    public function getWikipediaArticles() {
        $boundingBox = $this->getBoundingBox();
//                die ($boundingBox->getWest());

        $url = 'http://ws.geonames.org/wikipediaBoundingBoxJSON?'.
            'north='.$boundingBox->getNorth().
            '&south='.$boundingBox->getSouth().
            '&east='.$boundingBox->getEast().
            '&west='.$boundingBox->getWest();
        $cachePath=AgaviConfig::get("GeoNames.cache.path");
        $cacheFile = $cachePath.'/geonames.'.md5($url).'.cache.json';
//        die($cacheFile);
        if (is_readable($cacheFile)){
//           die('have cache');
            $json = file_get_contents($cacheFile);
        } else {
//            die('no cache');
            $json = @file_get_contents($url);
            if ($json==false) {
                return null;
            }
            file_put_contents($cacheFile, $json);
        }
        $data = json_decode($json, true);
        return $data['geonames'];
    }

    
}

?>
