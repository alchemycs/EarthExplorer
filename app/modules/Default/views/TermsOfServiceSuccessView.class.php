<?php

class Default_TermsOfServiceSuccessView extends EEDefaultBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Terms Of Service');
	}
}

?>