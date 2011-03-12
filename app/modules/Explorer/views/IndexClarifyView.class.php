<?php

class Explorer_IndexClarifyView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Clarify search for: '.$rd->getParameter('location'));

	}
}

?>