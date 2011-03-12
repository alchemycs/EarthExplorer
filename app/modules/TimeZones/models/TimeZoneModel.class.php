<?php

class TimeZones_TimeZoneModel extends AgaviModel {
    
    protected $regions = array(
        'Africa'=>24865670,
        'America'=>23424977,
        'Antarctica'=>28289409,
        'Arctic'=>55959707,
        'Asia'=>24865671,
        'Atlantic'=>55959709,
        'Australia'=>55949070,
        'Europe'=>24865675,
        'Indian'=>23424848,
        'Pacific'=>55959717
    );

    protected $placeFinder = null;

    public function getRegions() {
        return $this->regions;
    }

    public function getRegionNames() {
        return array_keys($this->regions);
    }

    public function getWoeidForRegion($region) {
        if (array_key_exists($region, $this->regions)) {
            return $this->regions[$region];
        }
        throw new AgaviException('The region specified does not exist ('.$region.')');
    }

    protected function getPlaceFinder() {
        if (!$this->placeFinder) {
            $this->placeFinder = $this->getContext()->getModel('PlaceFinder', 'Explorer');
        }
        return $this->placeFinder;
    }

    public function getPlaceForRegion($region) {
        $woeid = $this->getWoeidForRegion($region);
        $place = $this->getPlaceFinder()->findByWoeid($woeid);
        return $place;
    }
    
}

?>
