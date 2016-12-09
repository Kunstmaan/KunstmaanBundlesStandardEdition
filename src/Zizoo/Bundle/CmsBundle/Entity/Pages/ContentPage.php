<?php

namespace Zizoo\Bundle\CmsBundle\Entity\Pages;

use Zizoo\Bundle\CmsBundle\Form\Pages\ContentPageAdminType;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="zizoo_cms_bundle_content_pages")
 */
class ContentPage extends AbstractPage  implements HasPageTemplateInterface, SearchTypeInterface
{
    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ContentPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name'  => 'ContentPage',
                'class' => 'Zizoo\Bundle\CmsBundle\Entity\Pages\ContentPage'
            ),
	);
    }


    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
    	return 'Page';
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
	    return array('ZizooCmsBundle:contentpage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'ZizooCmsBundle:Pages\ContentPage:view.html.twig';
    }
}
