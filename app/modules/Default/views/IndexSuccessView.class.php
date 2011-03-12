<?php

class Default_IndexSuccessView extends EEDefaultBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Welcome');
	}
}

?>