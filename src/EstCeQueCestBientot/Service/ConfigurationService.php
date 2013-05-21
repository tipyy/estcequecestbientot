<?php

namespace EstCeQueCestBientot\Service;

use Symfony\Component\Yaml\Yaml;

/**
 * Service handling the app configuration
 */
class ConfigurationService {

    /**
     * @var array
     */
    private $yamlParser;

    /**
     * @param $configFile
     */
    public function __construct($configFile) {
        $this->yamlParser = Yaml::parse($configFile);
    }

    /**
     * @return string
     */
    public function getAppTitle() {
        return $this->yamlParser['app_title'];
    }
    
    /**
     * @return string
     */
    public function getExtraMessage() {
        return $this->yamlParser['extraMessage'];
    }
    
    /**
     * @return string
     */
    public function getDefaultMessage() {
        return $this->yamlParser['defaultMessage'];
    }
    
    /**
     * @return array
     */
    public function getMessages() {
        return $this->yamlParser['messages'];
    }
}
