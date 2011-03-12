<?php

class Explorer_LocationSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$place = $this->getAttribute('place');

		$this->setAttribute('_title', $place->getLongDisplayName());
	}
}

?>
