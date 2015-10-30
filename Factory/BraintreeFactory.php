<?php

namespace CometCult\BraintreeBundle\Factory;

use CometCult\BraintreeBundle\Exception\InvalidServiceException;
use Braintree_Configuration;


/**
 * Factory for creating Braintree services
 */
class BraintreeFactory
{
    /**
     * Constructor with Braintree configuration
     *
     * @param string $environment
     * @param string $merchantId
     * @param string $publicKey
     * @param string $privateKey
     */
    
    private $merchantAccountId;
    
    public function __construct($environment, $merchantId, $publicKey, $privateKey, $merchantAccountId)
    {
        Braintree_Configuration::environment($environment);
        Braintree_Configuration::merchantId($merchantId);
        Braintree_Configuration::publicKey($publicKey);
        Braintree_Configuration::privateKey($privateKey);
        $this->merchantAccountId = $merchantAccountId;
    }

    /**
     * Factory method for creating and getting Braintree services
     *
     * @param string $serviceName braintree service name
     * @param array $attributes   attribures for braintree service creation
     *
     * @return mixed
     */
    public function get($serviceName, array $attributes = array())
    {
        $className = 'Braintree_' . ucfirst($serviceName);
        if(class_exists($className) && method_exists($className, 'factory') && $serviceName != 'WebhookNotification') {
            return $className::factory($attributes);
        } else {
            //throw new InvalidServiceException('Invalid service ' . $serviceName);
            //edited by Matias Penela to fix service invalid error. 
            return $className;
        }
        
    
    }
    
    public function getMerchantAccountId(){
        return $this->merchantAccountId;
    }
    
}
