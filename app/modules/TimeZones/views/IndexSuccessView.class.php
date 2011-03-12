<?php

class TimeZones_IndexSuccessView extends EETimeZonesBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'TimeZones');
	}
}

?>