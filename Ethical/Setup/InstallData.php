<?php
namespace Kirill\Ethical\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'ethical',
            [
                'label' => 'Ethical Icons',
                'type' => 'varchar',
                'input' => 'multiselect',
                'source' => 'Kirill\Ethical\Model\Config\Product\Extensionoption',
                'required' => false,
                'sort_order' => 30,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'default' => 'ecccaas',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'visible_on_front' => true
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'isswitch',
            [
                'label' => 'Show Attribute Ethical',
                'type' => 'int',
                'input' => 'boolean',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'sort_order' => 30,
                'is_user_defined' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'visible_on_front' => true
            ]
        );
        $setup->endSetup();

    }
}
