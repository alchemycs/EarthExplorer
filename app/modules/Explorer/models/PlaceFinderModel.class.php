<?php

class Explorer_PlaceFinderModel extends EEExplorerBaseModel
{

    protected $yql;

    public function initialize(AgaviContext $context, array $parameters = array()) {
        parent::initialize($context, $parameters);
        $this->yql = $this->context->getModel('YQLCache', NULL, array(
            'options'=>array(
                'format'=>'xml'
            )
        ));
    }

    public function findByText($textQuery) {

        $response = $this->yql->executeQuery('SELECT * FROM geo.places(0,0) WHERE text="${query}"', array('query'=>$textQuery));
        $response = simplexml_load_string($response);
        switch (count($response->results->place)) {
            case 0: //No results, better show the input again
                return array();
            case 1: //Exactly one result, now we can show the location information
                return array($this->generatePlaceFromXML($response->results->place));
            default: //Multiple results we need to clarify
                return $this->generatePlacesFromXML($response->results);
        }
    }

    public function findByWoeid($woeid) {
        $response = $this->yql->executeQuery('SELECT * FROM geo.places WHERE woeid="${woeid}"', array('woeid'=>$woeid));
        $response = simplexml_load_string($response);
//echo $response->asXML();die();
        if (count($response->results->place)==1) {
            $place = $this->getContext()->getModel('Place', 'Explorer', array(
                'place'=>$response->results->place
            ));

            return $place;
        }
        
        return null;
    }

    public function findByIPAddress($ipAddress) {
        if (is_array($ipAddress)) {
            $ipAddress = $this->determinePublicIPAddress($ipAddress);
            if (!$ipAddress) {
                return $this->findByWoeid(1); //Can't find public address, return Earth
            }
        }
        $publicAddress = null;
        $patterns = array("/192.168.(\d+).(\d+)/i", "/10.(\d+).(\d+).(\d+)/i");
        foreach($patterns as $pattern) {
            if (preg_match($pattern, $address)) {
                //It's a private - break out
                break;

            }
            $parts = explode(".", $ipAddress);
            if ($parts[0]==172 && ($parts[1]>15 && $parts[1]<32)) {
                //It's private - break out
                break;
            }
            $publicAddress = $ipAddress;
            //Public, we break out
            break;
        }
        if (!$publicAddress) {
            return array($this->findByWoeid(1)); //Earth
        }
        $locationData = simplexml_load_file('http://ipinfodb.com/ip_query.php?ip='.$publicAddress);
        $locationString = sprintf("%s %s %s", (string)$locationData->City, (string)$locationData->RegionName, (string)$locationData->CountryName);
        $placeFinder = $this->getContext()->getModel('PlaceFinder', 'Explorer');
        $places = $placeFinder->findByText($locationString);
        if (empty($places)) {
            $place = $this->findByWoeid(1);
        } else {
            $place = $places[0];
        }
        return $place;
    }

    public function determinePublicIPAddress(array $ipAddresses) {
        $publicAddress = null;
        $patterns = array("/192.168.(\d+).(\d+)/i", "/10.(\d+).(\d+).(\d+)/i");
        foreach ($ipAddresses as $ipAddress) {
            foreach($patterns as $pattern) {
                if (preg_match($pattern, $ipAddress)) {
                    //It's a private - break to next ip address
                    continue 2;
                }
                $parts = explode(".", $ipAddress);
                if ($parts[0]==172 && ($parts[1]>15 && $parts[1]<32)) {
                    //It's private - break to next ip address
                    continue 2;
                }
                $publicAddress = $ipAddress;
                //Break ot of address loop, we found the most distant real IP address
                break 2;
            }
        }
        return $publicAddress;
    }

    protected function generatePlaceFromXML($placeXML) {
        $place = $this->getContext()->getModel('Place', 'Explorer', array(
            'place'=>$placeXML
        ));

        return $place;
    }

    protected function generatePlacesFromXML($placesXML) {
        $places = array();
        foreach ($placesXML->place as $placeXML) {
            $places[] = $this->generatePlaceFromXML($placeXML);
        }
        return $places;
    }

    public function prepareInfoForMultiplePlaces($places) {
        $placesInfo = array();
        foreach ($places->place as $place) {
            $placeInfo = $this->prepareInfoForSinglePlace($place);
            $placesInfo[] = $placeInfo;
        }
        return $placesInfo;
    }

    public function prepareInfoForSinglePlace($place) {
        $placeLabel = array(
            'placeTypeName'=>(string)$place->placeTypeName,
            'name'=>(string)$place->name
        );
        $placeInformation = array();
        if (!empty($place->country)) {
            $placeInformation[(string)$place->country['type']]=(string)$place->country;
        }
        if (!empty($place->admin1)) {
            $placeInformation[(string)$place->admin1['type']]=(string)$place->admin1;
        }
        if (!empty($place->admin2)) {
            $placeInformation[(string)$place->admin2['type']]=(string)$place->admin2;
        }
        if (!empty($place->admin3)) {
            $placeInformation[(string)$place->admin3['type']]=(string)$place->admin3;
        }
        if (!empty($place->locality1)) {
            $placeInformation[(string)$place->locality1['type']]=(string)$place->locality1;
        }
        if (!empty($place->locality2)) {
            $placeInformation[(string)$place->locality2['type']]=(string)$place->locality2;
        }
        if (!empty($place->postal)) {
            $placeInformation[(string)$place->postal['type']]=(string)$place->postal;
        }
        $result = array(
            'place'=>$place,
            'placeLabel'=>$placeLabel,
            'placeInformation'=>$placeInformation,
            'defaultDisplayString'=>sprintf("%s (%s)", $placeLabel['name'], $placeLabel['placeTypeName']),
            'defaultLongDisplayString'=>sprintf('%s (%s)%s',
                    $placeLabel['name'],
                    $placeLabel['placeTypeName'],
                    empty($place->country)?'':', '.$place->country)
        );
        return $result;
    }

    public function findBelongsToByWoeid($woeid) {
        $response = $this->yql->executeQuery('SELECT * FROM geo.places.belongtos(0,0) WHERE member_woeid="'.addslashes($woeid).'"');
        $response = simplexml_load_string($response);
        return $this->generatePlacesFromXML($response->results);
    }

    public function findBelongsToByPlace(Explorer_PlaceModel $place) {
        return $this->findBelongsToByWoeid($place->getWoeid());
    }

    public function findNeighborsByWoeid($woeid) {
        $response = $this->yql->executeQuery('SELECT * FROM geo.places.neighbors(0,0) WHERE neighbor_woeid="'.addslashes($woeid).'"');
        $response = simplexml_load_string($response);
        return $this->generatePlacesFromXML($response->results);
    }

    public function findNeighborsByPlace(Explorer_PlaceModel $place) {
        return $this->findNeighborsByWoeid($place->getWoeid());
    }

    public function findChildrenByWoeid($woeid) {
        $response = $this->yql->executeQuery('SELECT * FROM geo.places.children(0,0) WHERE parent_woeid="'.addslashes($woeid).'"');
        $response = simplexml_load_string($response);
        return $this->generatePlacesFromXML($response->results);
    }

    public function findChildrenByPlace($place) {
        return $this->findChildrenByWoeid($place->getWoeid());
    }
}

?>
