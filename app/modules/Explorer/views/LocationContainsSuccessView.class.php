<?php

class Explorer_LocationContainsSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$place = $this->getAttribute('place');

		$this->setAttribute('_title', 'Places contained by '.$place->getLongDisplayName());

		$this->setAttribute('places', $place->getChildren());
		$this->getLayer('content')->setTemplate('IndexClarify');
	}
}

?>