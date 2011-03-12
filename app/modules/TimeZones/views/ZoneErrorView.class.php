<?php

class TimeZones_ZoneErrorView extends EETimeZonesBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Zone');
	}
}

?>