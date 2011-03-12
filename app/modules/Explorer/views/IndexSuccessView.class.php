<?php

class Explorer_IndexSuccessView extends EEExplorerBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
//		$this->setupHtml($rd);

//		$this->setAttribute('_title', 'Explore');

                $place = $this->getAttribute('place');
//                $slug_name = $place['defaultLongDisplayString'];
//
//                $slug_name = preg_replace('/[^a-zA-Z0-9_\-]{1,}/', '-', $slug_name);
//                //die($slug_name);
//
//                $location = $this->getContext()->getRouting()->gen('Explore.Location', array(
//                    'woeid'=>$place['place']->woeid,
//                    'slug_name'=>$slug_name
//                ));

//                $this->getContainer()->getResponse()->setRedirect($location);
                $this->getContainer()->getResponse()->setRedirect($place->getUrl());
//                die($location);
                return;

	}
}

?>