<?php

class AdSense_LeaderboardSuccessView extends EEAdSenseBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->loadLayout('slot');

		$this->setAttribute('_title', 'AdSense Leaderboard');
	}
}

?>