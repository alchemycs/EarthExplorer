<?php

class Default_PrivacyPolicySuccessView extends EEDefaultBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Privacy Policy');
	}
}

?>