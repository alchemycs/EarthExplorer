<?php

class Explorer_LocationErrorView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Location');

		return $this->createForwardContainer(AgaviConfig::get('actions.error_404_module'), AgaviConfig::get('actions.error_404_action'));

	}
}

?>