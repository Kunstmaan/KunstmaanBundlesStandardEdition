<?php

namespace Zizoo\Bundle\CmsBundle\Entity\Pages;

use Zizoo\Bundle\CmsBundle\Form\Pages\HomePageAdminType;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\NodeBundle\Entity\HomePageInterface;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;

/**
 * HomePage
 *
 * @ORM\Entity()
 * @ORM\Table(name="zizoo_cms_bundle_home_pages")
 */
class HomePage extends AbstractPage implements HasPageTemplateInterface, SearchTypeInterface, HomePageInterface
{
    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new HomePageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name'  => 'ContentPage',
                'class' => 'Zizoo\Bundle\CmsBundle\Entity\Pages\ContentPage'
            ),
            array(
                'name'  => 'BehatTestPage',
                'class' => 'Zizoo\Bundle\CmsBundle\Entity\Pages\BehatTestPage'
            )
        );
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
	    return array('ZizooCmsBundle:main');
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
    	return array('ZizooCmsBundle:homepage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'ZizooCmsBundle:Pages\HomePage:view.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
	    return 'Home';
    }
}
