<?php

namespace Zizoo\Bundle\CmsBundle\Entity\Pages;

use Zizoo\Bundle\CmsBundle\Form\Pages\BehatTestPageAdminType;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;

/**
 * BehatTestPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="zizoo_cms_bundle_behat_test_pages")
 */
class BehatTestPage extends AbstractPage  implements HasPageTemplateInterface
{

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new BehatTestPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name'  => 'HomePage',
                'class' => 'Zizoo\Bundle\CmsBundle\Entity\Pages\HomePage'
            ),
            array(
                'name'  => 'ContentPage',
                'class' => 'Zizoo\Bundle\CmsBundle\Entity\Pages\ContentPage'
            ),
        );
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
        return array('ZizooCmsBundle:behat-test-page');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return '';
    }
}
