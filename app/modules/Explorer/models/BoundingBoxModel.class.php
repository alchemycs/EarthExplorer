<?php
require_once('GeoPointModel.class.php');

class Explorer_BoundingBoxModel extends EEExplorerBaseModel
{

    protected $southWest;
    protected $northEast;

    public function initialize(AgaviContext $context, array $parameters = array()) {
        parent::initialize($context, $parameters);
        if (isset($parameters['southWest'])) {
            $this->setSouthWest($parameters['southWest']);
        }
        if (isset($parameters['northEast'])) {
            $this->setNorthEast($parameters['northEast']);
        }
    }

    public function getSouthWest() {
        return $this->southWest;
    }

    public function setSouthWest(Explorer_GeoPointModel $southWest) {
        $this->southWest = $southWest;
    }

    public function getNorthEast() {
        return $this->northEast;
    }

    public function setNorthEast(Explorer_GeoPointModel $northEast) {
        $this->northEast = $northEast;
    }

    public function getNorth() {
        return $this->northEast->getLatitude();
    }
    
    public function getSouth() {
        return $this->southWest->getLatitude();
    }
    
    public function getEast() {
        return $this->northEast->getLongitude();
    }
    
    public function getWest() {
        return $this->southWest->getLongitude();
    }

    public function __toString() {
        return sprintf("[%s, %s]", $this->getSouthWest(), $this->getNorthEast());
    }

    
}
?>
