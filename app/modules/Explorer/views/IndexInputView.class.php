<?php

class Explorer_IndexInputView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);

		$this->setAttribute('_title', 'Index');
	}
}

?>