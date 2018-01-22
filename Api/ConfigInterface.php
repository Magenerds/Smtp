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
 * @copyright  Copyright (c) 2018 TechDivision GmbH (http://www.techdivision.com)
 * @link       http://www.techdivision.com/
 * @author     Vadim Justus <v.justus@techdivision.com>
 * @author     Julian Schlarb <j.schlarb@techdivision.com>
 */
interface ConfigInterface
{
    /**
     * deployment configuration path
     */
    const CONFIG_KEY_HOST = 'smtp/host';
    const CONFIG_KEY_AUTH = 'smtp/auth';
    const CONFIG_KEY_SSL = 'smtp/ssl';
    const CONFIG_KEY_PORT = 'smtp/port';
    const CONFIG_KEY_USERNAME = 'smtp/username';
    const CONFIG_KEY_PASSWD = 'smtp/password';

    /**
     * default values
     */
    const DEFAULT_HOST = 'localhost';
    const DEFAULT_AUTH = '';
    const DEFAULT_SSL = '';
    const DEFAULT_PORT = '25';
    const DEFAULT_USERNAME = '';
    const DEFAULT_PASSWD = '';

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return array
     */
    public function getConfigData();
}
