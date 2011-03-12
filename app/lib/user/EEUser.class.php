<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EEUserclass
 *
 * @author michael
 */
class EEUser extends AgaviRbacSecurityUser {

    const AUTOLOCATION_NAMESPACE = 'info.earthexplorer.AutoLocation';
    const GEOAPILOCATION_NAMESPACE = 'info.earthexplorer.GeoApi';

    protected $hasAutoLocation = true;

    public function startup() {
        parent::startup();

        if (AgaviConfig::get('core.debug')) {
//            $this->removeAttributeNamespace(AUTOLOCATION_NAMESPACE);
        }

        if (!$this->hasAttributeNamespace(EEUser::AUTOLOCATION_NAMESPACE)) {
            $this->getPublicIPAddress();
        }
    }

    public function hasAutoLocation() {
        return $this->hasAutoLocation;
    }

    public function hasWoeid() {
        return $this->hasAttribute('woeid', EEUser::AUTOLOCATION_NAMESPACE);
    }

    public function setWoeid($woeid) {
        $this->hasAutoLocation = false;
        $this->setAttribute('woeid', $woeid, EEUser::AUTOLOCATION_NAMESPACE);
        return $this;
    }

    public function getWoeid() {
        if (!$this->hasAttribute('woeid', EEUser::AUTOLOCATION_NAMESPACE)) {
            if ($this->getPublicIPAddress()==null) {
                if (AgaviConfig::get('core.debug')) {
                    $this->setAttribute('woeid', '1094172', EEUser::AUTOLOCATION_NAMESPACE);
//                    $this->setAttribute('woeid', '1', EEUser::AUTOLOCATION_NAMESPACE);
                } else {
                    $this->setAttribute('woeid', 1, EEUser::AUTOLOCATION_NAMESPACE);
                }
            } else {
                $placeFinder = $this->getContext()->getModel('PlaceFinder', 'Explorer');
                $place = $placeFinder->findByIPAddress($this->getPublicIPAddress());
                $this->setAttribute('woeid', $place->getWoeid(), EEUser::AUTOLOCATION_NAMESPACE);
            }
        }
        return $this->getAttribute('woeid', EEUser::AUTOLOCATION_NAMESPACE);
    }

    public function getPlace() {
        $placeFinder = $this->getContext()->getModel('PlaceFinder', 'Explorer');
        $place = $placeFinder->findByWoeid($this->getWoeid());
        return $place;
   }

    public function getPublicIPAddress() {
        if (!$this->hasAttribute('publicIPAddress', EEUser::AUTOLOCATION_NAMESPACE)) {
            $rd = $this->getContext()->getRequest()->getRequestData();
            $ipAddresses = array($_SERVER['REMOTE_ADDR']);
//            if (AgaviConfig::get('core.debug')) {
//                $ipAddresses[] = '203.2.75.2';
//            }
            if ($rd->hasHeader('x-forwarded-for')) {
                $forwards = split(",", preg_replace("/\s*/", "",$rd->getHeader('x-forwarded-for')));
                $ipAddresses = array_merge($ipAddresses, $forwards);
            }
//            var_dump($ipAddresses);die();
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
                    //Break out of address loop, we found the most distant real IP address
                    break 2;
                }
            }
            $this->setAttribute('publicIPAddress', $publicAddress, EEUser::AUTOLOCATION_NAMESPACE);
        }
        return $this->getAttribute('publicIPAddress', EEUser::AUTOLOCATION_NAMESPACE);
    }
}
?>
