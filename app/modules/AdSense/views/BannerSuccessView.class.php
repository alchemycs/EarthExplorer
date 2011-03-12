<?php

class AdSense_BannerSuccessView extends EEAdSenseBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->loadLayout('slot');

		$this->setAttribute('_title', 'AdSense Banner');
	}
}

?>