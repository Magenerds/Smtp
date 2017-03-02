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
 * @copyright  Copyright (c) 2017 TechDivision GmbH (http://www.techdivision.com)
 * @link       http://www.techdivision.com/
 * @author     Julian Scharb <j.schlarb@techdivision.com>
 */
namespace Magenerds\Smtp\Setup;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Config\File\ConfigFilePool;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\App\DeploymentConfig\Reader;
use Magento\Framework\App\DeploymentConfig\Writer;

/**
 * Class UpgradeSchema
 * @package Magenerds\Smtp\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    /**
     * @var Writer
     */
    private $deploymentConfigWriter;

    /**
     * Config constructor.
     * @param DeploymentConfig $deploymentConfig
     * @param Writer $deploymentConfigWriter
     */
    public function __construct(
        DeploymentConfig $deploymentConfig,
        Writer $deploymentConfigWriter
    )
    {
        $this->deploymentConfig = $deploymentConfig;
        $this->deploymentConfigWriter = $deploymentConfigWriter;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '3.0.0', '<')) {
            $this->renameEnvConfigKeyFromTlsToSsl();
        }

        $installer->endSetup();
    }

    protected function renameEnvConfigKeyFromTlsToSsl()
    {
        $data = $this->deploymentConfig->get('smtp');

        if (isset($data['tls'])) {
            $data['ssl'] = strlen(trim($data['tls'])) > 0 ? $data['tls'] : null;
            unset($data['tls']);

            $this->deploymentConfigWriter->saveConfig([ConfigFilePool::APP_ENV => ['smtp' => $data]], true);
        }
    }


}
