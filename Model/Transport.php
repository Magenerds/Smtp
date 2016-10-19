<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * @category   Magenerds
 * @package    Magenerds_Smtp
 * @subpackage Model
 * @copyright  Copyright (c) 2016 TechDivision GmbH (http://www.techdivision.com)
 * @version    ${release.version}
 * @link       http://www.techdivision.com/
 * @author     Johann Zelger <j.zelger@techdivision.com>
 */
namespace Magenerds\Smtp\Model;

/**
 * Class Transport
 * @package Magenerds\Smtp\Model
 */
class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\Mail\MessageInterface $message
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @throws \InvalidArgumentException
     */
    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        // get module enabled flag
        $moduleEnabled = $scopeConfig->getValue(
            'smtp/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        // if module is enabled
        if ($moduleEnabled) {
            // check if message is correct object
            if (!$message instanceof \Zend_Mail) {
                throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
            }

            // set smtp configurations
            $smtpHost = $scopeConfig->getValue('smtp/general/host', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $smtpConf = [
                'auth' => $scopeConfig->getValue('smtp/general/auth', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
                'tls' => $scopeConfig->getValue('smtp/general/tls', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
                'port' => $scopeConfig->getValue('smtp/general/port', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
                'username' => $scopeConfig->getValue('smtp/general/username', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
                'password' => $scopeConfig->getValue('smtp/general/password', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            ];

            // set message to internal property
            $this->_message = $message;
            // set instance to internal property
            $this->_scopeConfig = $scopeConfig;
        }

        // call parent constructor
        parent::__construct($smtpHost, $smtpConf);
    }

    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }
}
