<?php

class TimeZones_ZoneSuccessView extends EETimeZonesBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Zone');
	}
}

?>