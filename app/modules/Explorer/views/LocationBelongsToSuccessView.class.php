<?php

class Explorer_LocationBelongsToSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$place = $this->getAttribute('place');

		$this->setAttribute('_title', 'Places '.$place->getLongDisplayName().' belongs to');

		$this->setAttribute('places', $place->getBelongsTo());
		$this->getLayer('content')->setTemplate('IndexClarify');
	}
}

?>