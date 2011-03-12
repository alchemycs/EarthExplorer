<?php

class Explorer_WeatherAction extends EEExplorerBaseAction
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

            $arguments = $this->getContainer()->getArguments();

            $place = $arguments->getParameter('place');

            if (stristr((string)$place->getWeather()->results->rss->channel->title, 'error')) {
                return 'Error';
            }

            $this->setAttribute('place', $place);

            return 'Success';

	}
}

?>