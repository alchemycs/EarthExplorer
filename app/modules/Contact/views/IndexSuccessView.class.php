<?php

class Contact_IndexSuccessView extends EEContactBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Contact');
	}
}

?>