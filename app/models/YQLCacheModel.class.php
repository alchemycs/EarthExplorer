<?php

require_once('YQLModel.class.php');

class YQLCacheModel extends YQLModel
{

    protected $cacheOptions = null;

	public function initialize(AgaviContext $context, array $parameters = array())
	{
		parent::initialize($context, $parameters);
                $this->cacheOptions = array(
                    'enabled'=>AgaviConfig::get('YQL.cache.enabled', true),
                    'path'=>AgaviConfig::get('YQL.cache.path')
                );

                if (isset($parameters['cache'])) {
			$this->cacheOptions = array_merge($this->cacheOptions, (array)$parameters['cache']);
		}

//                if ($this->cacheOptions['enabled'] && !is_writable($this->cacheOptions['path'])) {
//                    throw new Exception('YQLCache Model has caching enabled but the cache path is not writable ('.print_r($this->cacheOptions['path'], true).')');
//                }
	}

	public function executeQuery($query, array $arguments = array()) {

            $queryUrl = $this->buildQueryUrl($query, $arguments);
            
            if (!$this->cacheOptions['enabled']) {
                return parent::executeQuery($query, $arguments);
            }
            
            $cacheFile = $this->cacheOptions['path'].DIRECTORY_SEPARATOR.md5($queryUrl).'.xml';
//die($cacheFile);
            if (is_readable($cacheFile)) {
                return file_get_contents($cacheFile);
            }

            $result = parent::executeQuery($query, $arguments);
            file_put_contents($cacheFile, $result);
            
            return $result;


	}
}

?>
