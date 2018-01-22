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
 * @copyright  Copyright (c) 2018 TechDivision GmbH (http://www.techdivision.com)
 * @link       http://www.techdivision.com/
 * @author     Johann Zelger <j.zelger@techdivision.com>
 * @author     Vadim Justus <v.justus@techdivision.com>
 * @author     Simon Sippert <s.sippert@techdivision.com>
 */

namespace Magenerds\Smtp\Model;

use Exception;
use InvalidArgumentException;
use Magenerds\Smtp\Api\ConfigInterface;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\Phrase;
use Zend_Mail;
use Zend_Mail_Transport_Smtp;

/**
 * Class Transport
 * @package Magenerds\Smtp\Model
 */
class Transport extends Zend_Mail_Transport_Smtp implements TransportInterface
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * Transport constructor.
     *
     * @param MessageInterface $message
     * @param ConfigInterface $config
     */
    public function __construct(
        MessageInterface $message,
        ConfigInterface $config
    )
    {
        // check if message is correct object
        if (!$message instanceof Zend_Mail) {
            throw new InvalidArgumentException('The message should be an instance of Zend_Mail');
        }

        // set smtp configurations
        $smtpHost = $config->getHost();
        $smtpConf = $config->getConfigData();

        // set message to internal property
        $this->message = $message;

        // call parent constructor
        parent::__construct($smtpHost, $smtpConf);
    }

    /**
     * Send a mail using this transport
     *
     * @return void
     * @throws MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->message);
        } catch (Exception $exception) {
            throw new MailException(new Phrase($exception->getMessage()), $exception);
        }
    }

    /**
     * Get message
     *
     * @return MessageInterface
     */
    public function getMessage()
    {
        return $this->message;
    }
}
