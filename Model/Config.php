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
 * @author     Vadim Justus <v.justus@techdivision.com>
 */

namespace Magenerds\Smtp\Model;

use Magenerds\Smtp\Api\ConfigInterface;
use Magento\Framework\App\DeploymentConfig;

/**
 * Class Transport
 * @package Magenerds\Smtp\Model
 */
class Config implements ConfigInterface
{
    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    /**
     * Config constructor.
     * @param DeploymentConfig $deploymentConfig
     */
    public function __construct(
        DeploymentConfig $deploymentConfig
    ) {
        $this->deploymentConfig = $deploymentConfig;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->deploymentConfig->get(
            ConfigInterface::CONFIG_KEY_HOST,
            ConfigInterface::DEFAULT_HOST
        );
    }

    /**
     * @return array
     */
    public function getConfigData()
    {
        $config = [
            'auth' => $this->deploymentConfig->get(
                ConfigInterface::CONFIG_KEY_AUTH,
                ConfigInterface::DEFAULT_AUTH
            ),
            'ssl' => $this->deploymentConfig->get(
                ConfigInterface::CONFIG_KEY_TLS,
                ConfigInterface::DEFAULT_TLS
            ),
            'port' => $this->deploymentConfig->get(
                ConfigInterface::CONFIG_KEY_PORT,
                ConfigInterface::DEFAULT_PORT
            ),
            'username' => $this->deploymentConfig->get(
                ConfigInterface::CONFIG_KEY_USERNAME,
                ConfigInterface::DEFAULT_USERNAME
            ),
            'password' => $this->deploymentConfig->get(
                ConfigInterface::CONFIG_KEY_PASSWORD,
                ConfigInterface::DEFAULT_PASSWORD
            ),
        ];

        // supress Zend_Mail_Protocol_Exception:  is unsupported SSL
        if (strlen(trim($config['ssl'])) === 0) {
            unset($config['ssl']);
        }

        return $config;
    }
}
