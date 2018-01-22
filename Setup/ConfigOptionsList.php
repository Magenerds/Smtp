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
 * @subpackage Setup
 * @copyright  Copyright (c) 2018 TechDivision GmbH (http://www.techdivision.com)
 * @link       http://www.techdivision.com/
 * @author     Vadim Justus <v.justus@techdivision.com>
 * @author     Julian Schlarb <j.schlarb@techdivision.com>
 */

namespace Magenerds\Smtp\Setup;

use Magenerds\Smtp\Api\ConfigInterface;
use Magento\Framework\Config\Data\ConfigData;
use Magento\Framework\Config\File\ConfigFilePool;
use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Setup\ConfigOptionsListInterface;
use Magento\Framework\Setup\Option\AbstractConfigOption;
use Magento\Framework\Setup\Option\SelectConfigOption;
use Magento\Framework\Setup\Option\TextConfigOption;

/**
 * Class ConfigOptionsList
 * @package Magenerds\Smtp\Setup
 */
class ConfigOptionsList implements ConfigOptionsListInterface
{
    /**
     * Input key for the options
     */
    const INPUT_KEY_ENABLED = 'smtp-enable';
    const INPUT_KEY_HOST = 'smtp-host';
    const INPUT_KEY_AUTH = 'smtp-auth';
    const INPUT_KEY_SSL = 'smtp-ssl';
    const INPUT_KEY_PORT = 'smtp-port';
    const INPUT_KEY_USERNAME = 'smtp-username';
    const INPUT_KEY_PASSWD = 'smtp-password';

    /**
     * Gets a list of input options so that user can provide required
     * information that will be used in deployment config file
     *
     * @return AbstractConfigOption[]
     */
    public function getOptions()
    {
        return [
            new TextConfigOption(
                static::INPUT_KEY_HOST,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                ConfigInterface::CONFIG_KEY_HOST,
                'External SMTP host for mail transport',
                ConfigInterface::DEFAULT_HOST
            ),
            new SelectConfigOption(
                static::INPUT_KEY_AUTH,
                SelectConfigOption::FRONTEND_WIZARD_SELECT,
                ['', 'login', 'plain', 'cramm5'],
                ConfigInterface::CONFIG_KEY_AUTH,
                'Authentification method for SMTP transport',
                ConfigInterface::DEFAULT_AUTH
            ),
            new SelectConfigOption(
                static::INPUT_KEY_SSL,
                SelectConfigOption::FRONTEND_WIZARD_SELECT,
                ['', 'tls', 'ssl'],
                ConfigInterface::CONFIG_KEY_SSL,
                'Use ssl or tls to secure SMTP transport',
                ConfigInterface::DEFAULT_SSL
            ),
            new TextConfigOption(
                static::INPUT_KEY_PORT,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                ConfigInterface::CONFIG_KEY_PORT,
                'SMTP port',
                ConfigInterface::DEFAULT_PORT
            ),
            new TextConfigOption(
                static::INPUT_KEY_USERNAME,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                ConfigInterface::CONFIG_KEY_USERNAME,
                'SMTP usename',
                ConfigInterface::DEFAULT_USERNAME
            ),
            new TextConfigOption(
                static::INPUT_KEY_PASSWD,
                TextConfigOption::FRONTEND_WIZARD_PASSWORD,
                ConfigInterface::CONFIG_KEY_PASSWD,
                'SMTP password',
                ConfigInterface::DEFAULT_PASSWD
            ),
        ];
    }

    /**
     * Creates array of ConfigData objects from user input data.
     * Data in these objects will be stored in array form in deployment config file.
     *
     * @param array $options
     * @param DeploymentConfig $deploymentConfig
     * @return ConfigData[]
     */
    public function createConfig(array $options, DeploymentConfig $deploymentConfig)
    {
        $configData = new ConfigData(ConfigFilePool::APP_ENV);

        if (isset($options[static::INPUT_KEY_HOST])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_HOST,
                $options[static::INPUT_KEY_HOST]
            );
        }
        if (isset($options[static::INPUT_KEY_AUTH])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_AUTH,
                $options[static::INPUT_KEY_AUTH]
            );
        }
        if (isset($options[static::INPUT_KEY_SSL]) &&
            !empty($options[static::INPUT_KEY_SSL])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_SSL,
                $options[static::INPUT_KEY_SSL]
            );
        }
        if (isset($options[static::INPUT_KEY_PORT])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_PORT,
                $options[static::INPUT_KEY_PORT]
            );
        }
        if (isset($options[static::INPUT_KEY_USERNAME])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_USERNAME,
                $options[static::INPUT_KEY_USERNAME]
            );
        }
        if (isset($options[static::INPUT_KEY_PASSWD])) {
            $configData->set(
                ConfigInterface::CONFIG_KEY_PASSWD,
                $options[static::INPUT_KEY_PASSWD]
            );
        }

        return [$configData];
    }

    /**
     * Validates user input option values and returns error messages
     *
     * @param array $options
     * @param DeploymentConfig $deploymentConfig
     * @return string[]
     */
    public function validate(array $options, DeploymentConfig $deploymentConfig)
    {
        return [];
    }
}
