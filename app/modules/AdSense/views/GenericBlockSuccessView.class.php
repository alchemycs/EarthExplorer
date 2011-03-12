<?php

class AdSense_GenericBlockSuccessView extends EEAdSenseBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->loadLayout('slot');

		$this->setAttribute('_title', 'AdSense Generic Block');
	}
}

?>