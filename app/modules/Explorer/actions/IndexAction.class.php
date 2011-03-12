<?php

class Explorer_IndexAction extends EEExplorerBaseAction
{
	/**
	 * Returns the default view if the action does not serve the request
	 * method used.
	 *
	 * @return     mixed <ul>
	 *                     <li>A string containing the view name associated
	 *                     with this action; or</li>
	 *                     <li>An array with two indices: the parent module
	 *                     of the view to be executed and the view to be
	 *                     executed.</li>
	 *                   </ul>
	 */
	public function getDefaultViewName()
	{
            $user = $this->getContext()->getUser();

            if ($user->hasAutoLocation()) {
                return 'Input'; //If we have auto location then we want to try and get it manually
            } else {
                return 'Success'; //Otherwise it is already set so we handle it gracefully
            }

            $this->setAttribute('place', $this->getContext()->getUser()->getPlace());

            return 'Input';
	}

        public function executeWrite(AgaviRequestDataHolder $rd) {
            $placeFinder = $this->getContext()->getModel('PlaceFinder', 'Explorer');
            $places = $placeFinder->findByText($rd->getParameter('location'));
            if (empty($places)) {
                $place = $placeFinder->findByWoeid(1); //Just get earth
                $this->setAttribute('place', $place);
                return 'Success';
            } else if (count($places)>1) {
                $this->setAttribute('places', $places);
                return 'Clarify';
            }
            
            $this->setAttribute('place', $places[0]);
            return 'Success';
        }
}

?>