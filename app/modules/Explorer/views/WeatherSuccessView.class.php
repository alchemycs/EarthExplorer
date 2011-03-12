<?php

class Explorer_WeatherSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

	
		$this->setAttribute('_title', 'Weather');

	}
}

?>