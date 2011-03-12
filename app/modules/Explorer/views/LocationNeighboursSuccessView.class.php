<?php

class Explorer_LocationNeighboursSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$place = $this->getAttribute('place');

		$this->setAttribute('_title', 'Places neighboured by '.$place->getLongDisplayName());

		$this->setAttribute('places', $place->getNeighbors());
		$this->getLayer('content')->setTemplate('IndexClarify');
	}
}

?>