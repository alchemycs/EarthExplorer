<?php

class Contact_IndexInputView extends EEContactBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Contact');
            $reCaptcha = $this->getContext()->getModel('ReCaptcha', 'reCaptcha');
            $this->setAttribute('reCaptcha', $reCaptcha);

	}
}

?>