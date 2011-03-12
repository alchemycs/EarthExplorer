<?php

class Contact_IndexErrorView extends EEContactBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Contact');

                $this->getLayer('content')->setTemplate('IndexInput');

                $reCaptcha = $this->getContext()->getModel('ReCaptcha', 'reCaptcha');
            $this->setAttribute('reCaptcha', $reCaptcha);
                
	}
}

?>