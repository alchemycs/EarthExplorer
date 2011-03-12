<?php

class YQLModel extends AgaviModel {
    protected $endpoint = 'https://query.yahooapis.com/v1/public/yql?';

    /**
     * 
     * YQL Tables used by the query.
     * @var array
     */
    protected $uses = null;
    /**
     * 
     * Options used by the YQL query
     * @var array
     */
    protected $options = null;
    /**
     * 
     * Environment files used by the YQL query
     * @var array
     */
    protected $environment;

    /**
     * Initialize the model. $parameters are uses and options
     * @see AgaviModel::initialize()
     */
    public function initialize(AgaviContext $context, array $parameters = array()) {
        parent::initialize($context, $parameters);
        $this->uses = array();
        $this->options = array();
        if (isset($parameters['uses'])) {
            $this->uses = array_merge($this->uses, (array)$parameters['uses']);
        }
        if (isset($parameters['options'])) {
            $this->options = array_merge($this->options, (array)$parameters['options']);
        }
    }

    /**
     * 
     * Options to be appended to the end of the YQL query URL.
     * @param string $parameter
     * @param string $value
     */
    public function setOption($parameter, $value) {
        $this->options[$parameter] = $value;
    }

    /**
     * 
     * Checks to see if a parameter already exists
     * @param string $parameter
     * @return boolean
     */
    public function hasOption($parameter) {
        return isset($this->options[$parameter]);
    }

    /**
     * 
     * Returns the value associated with the option. Returns NULL if nothing is set
     * @param string $parameter
     * @return string or null
     */
    public function getOption($parameter) {
        if ($this->hasOption($parameter)) {
            return $this->options[$paramater];
        } else {
            return null;
        }
    }

    /**
     * 
     * Removes all the options currently set
     */
    public function clearOptions() {
        $this->options = array();
    }

    /**
     * 
     * Returns an array of the currently set options
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * 
     * Sets the definition file for a table.
     * @param string $definition The URL of the definition file
     * @param string $tableName The alias for the table name
     * @return YQLModel
     */
    public function setTable($definition, $tableName) {
        $this->uses[$tableName] = $definition;
        return $this;
    }

    /**
     * 
     * Removes the table from  list of 'use' tables
     * @param string $tableName
     */
    public function removeTable($tableName) {
        unset($this->uses[$tableName]);
        return $this;
    }

    /**
     * 
     * Clears the use of tables being used
     */
    public function clearTables() {
        $this->uses = array();
        return $this;
    }

    /**
     * 
     * Returns the table definitions as an array
     * @return array
     */
    public function getTables() {
        return $this->uses;
    }

	/**
	 * 
	 * Takes all the parameters and return the URL for the YQL query. Argument substution comes from the $arguments array
	 * and replaces ${argument} with the associated value from the $arguments array.
	 * @param string $query The SELECT statement
	 * @param array $arguments Array of the arguments to expanded into the SELECT query
	 * @return string
	 */
    protected function buildQueryUrl($query, array $arguments = array()) {
        $arguments = array_map('addslashes', $arguments);
        $query = AgaviToolkit::expandVariables($query, $arguments);

        $url = $this->endpoint;
        if (count($this->uses)) {
            $use = '';
            foreach ($this->uses as $table=>$definition) {
                $use .= sprintf("USE '%s' AS %s;\n", $definition, $table);
            }
            $query = $use.$query;
        }
        $url .= sprintf("q=%s",urlencode($query));
        if (count($this->options)) {
            foreach($this->options as $option=>$value) {
                $url .= sprintf("&%s=%s", urlencode($option), urlencode($value));
            }
        }
        return $url;
    }


    /**
     * 
     * Executes a YQL query with argument substitution so ${argument} in the query is replaced by the
     * associated value from the $arguments array.
     * @param string $query The SELECT statement
     * @param array $arguments Array of the arguments to be expanded into the SELECT query
     * @return mixed
     */
    public function executeQuery($query, array $arguments = array()) {

        $queryUrl = $this->buildQueryUrl($query, $arguments);
//		die($url);

        $hCurl = curl_init($queryUrl);
        curl_setopt($hCurl, CURLOPT_HEADER, false);
        curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($hCurl);
        curl_close($hCurl);

        return $result;

    }
}

?>