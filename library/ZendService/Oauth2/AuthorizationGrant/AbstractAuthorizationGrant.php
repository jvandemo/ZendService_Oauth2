<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 */
namespace ZendService\Oauth2\AuthorizationGrant;

use Traversable;
use Zend\Stdlib\ArrayUtils;
use ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage AuthorizationGrant
 */
abstract class AbstractAuthorizationGrant implements AuthorizationGrantInterface
{
    
    /**
     * Default constructor
     *
     * @param array|Traversable $options
     */
    public function __construct ($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * Set options
     *
     * @param array|\Traversable $options
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @return ViewModel
     */
    public function setOptions($options)
    {
        
        // Convert options to array if traversable
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }
        
        // Handle invalid options
        if (! is_array($options)) {
            throw new Exception\Exception(
                    sprintf(
                            '%s: expects an array, or Traversable argument; received "%s"',
                            __METHOD__,
                            (is_object($options) ? get_class($options) : gettype(
                                    $options))));
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
     * array(
     *     'client_id' => '1234'
     * )
     *
     * will run setClientId('1234')
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function setOption($name = '', $value = null)
    {
        // Assemble setter name
        $setter = 'set';
        $words = explode('_', strtolower($name));
        foreach ($words as $word) {
            $setter .= ucfirst(trim($word));
        }
        
        // Handle unexisting setter
        if (! method_exists($this, $setter)) {
            return $this;
        }
        
        return $this->$setter($value);
    }
}
