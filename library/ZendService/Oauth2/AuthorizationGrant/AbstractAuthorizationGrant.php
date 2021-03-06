<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 */
namespace ZendService\Oauth2\AuthorizationGrant;

use Traversable;
use Zend\Stdlib\ArrayUtils;
use ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface;

/**
 *
 * @category Zend
 * @package ZendService_Oauth2
 * @subpackage AuthorizationGrant
 */
abstract class AbstractAuthorizationGrant implements AuthorizationGrantInterface
{

    /**
     * Convenience placeholder for options that are passed to the constructor
     *
     * @var mixed
     */
    protected $_options = null;

    /**
     * Default constructor
     *
     * @param array|Traversable $options
     */
    public function __construct ($options = array())
    {
        
        // Call setters for all options that have a setter
        $this->setOptions($options);
        
        // Store options in placeholder so items that don't have setter can also be accessed if necessary
        $this->_options = $options;
    }

    /**
     * Set options
     *
     * @param array|\Traversable $options
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @return ViewModel
     */
    public function setOptions ($options)
    {
        
        // Convert options to array if traversable
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }
        
        // Handle invalid options
        if (! is_array($options)) {
            throw new Exception\Exception(sprintf('%s: expects an array, or Traversable argument; received "%s"', __METHOD__, (is_object($options) ? get_class($options) : gettype($options))));
        }
        
        // Set all options
        foreach ($options as $name => $value) {
            $this->setOption($name, $value);
        }
        
        return $this;
    }

    /**
     * Set single option
     *
     * Calls a setter and does nothing if setter doesn't exist
     *
     * Normalizes underscores in option names to uppercase
     *
     * Example:
     *
     * setOption('client_id', '1234')
     *
     * will run setClientId('1234')
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function setOption ($name = '', $value = null)
    {
        // Assemble setter name
        $setter = 'set' . $this->_underscoreToUpperCase($name);
        
        // Handle unexisting setter
        if (! method_exists($this, $setter)) {
            return $this;
        }
        
        return $this->$setter($value);
    }

    /**
     * Get single option
     *
     * Calls a getter and returns null if getter does not exist
     *
     * Normalizes underscores in option names to uppercase
     *
     * Example:
     *
     * getOption('client_id')
     *
     * will run getClientId()
     *
     * @param string $name
     * @param mixed $params
     * @return self
     */
    public function getOption ($name = '')
    {
        // Assemble setter name
        $getter = 'get' . $this->_underscoreToUpperCase($name);
        
        // Handle unexisting setter
        if (! method_exists($this, $getter)) {
            return $this;
        }
        
        return $this->$getter();
    }

    /**
     * Convert all underscores in string to upper case
     *
     * @param string $name
     * @return string String with underscores replaced by upper case
     */
    protected function _underscoreToUpperCase ($name = '')
    {
        $result = '';
        $words = explode('_', strtolower($name));
        foreach ($words as $word) {
            $result .= ucfirst(trim($word));
        }
        return $result;
    }
}
