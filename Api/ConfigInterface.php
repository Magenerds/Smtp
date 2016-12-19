<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

namespace Magenerds\Smtp\Api;

/**
 * @category   Magenerds
 * @package    Magenerds_Smtp
 * @subpackage Model
 * @copyright  Copyright (c) 2016 TechDivision GmbH (http://www.techdivision.com)
 * @version    ${release.version}
 * @link       http://www.techdivision.com/
 * @author     Vadim Justus <v.justus@techdivision.com>
 */
interface ConfigInterface
{
    /**
     * deployment configuration path
     */
    const CONFIG_KEY_HOST = 'smtp/host';
    const CONFIG_KEY_AUTH = 'smtp/auth';
    const CONFIG_KEY_TLS = 'smtp/tls';
    const CONFIG_KEY_PORT = 'smtp/port';
    const CONFIG_KEY_USERNAME = 'smtp/username';
    const CONFIG_KEY_PASSWORD = 'smtp/password';

    /**
     * default values
     */
    const DEFAULT_HOST = 'localhost';
    const DEFAULT_AUTH = '';
    const DEFAULT_TLS = '';
    const DEFAULT_PORT = '25';
    const DEFAULT_USERNAME = '';
    const DEFAULT_PASSWORD = '';

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return array
     */
    public function getConfigData();
}