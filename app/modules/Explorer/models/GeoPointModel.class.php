<?php
class Explorer_GeoPointModel extends EEExplorerBaseModel
{

    protected $latitude;
    protected $longitude;

    public function initialize(AgaviContext $context, array $parameters = array()) {
        parent::initialize($context, $parameters);
        if (isset($parameters['latitude'])) {
            $this->setLatitude($parameters['latitude']);
        }
        if (isset($parameters['longitude'])) {
            $this->setLongitude($parameters['longitude']);
        }
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLatitude($latitude) {
        if ( ($latitude<-90) || ($latitude>90)) {
            throw new Exception('Latitude out of bounds [-90:90]');
        }
        $this->latitude = $latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLongitude($longitude) {
        if ( ($longitude<-180) || ($longitude>180)) {
            throw new Exception('Longitude out of bounds [-180:180]');
        }
        $this->longitude = $longitude;
    }

    public function __toString() {
        return sprintf("(%s, %s)", $this->getLatitude(), $this->getLongitude());
    }

    
}
?>
