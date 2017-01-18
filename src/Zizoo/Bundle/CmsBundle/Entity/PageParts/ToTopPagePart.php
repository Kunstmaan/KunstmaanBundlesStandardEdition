<?php

namespace Zizoo\Bundle\CmsBundle\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;

/**
 * ToTopPagePart
 *
 * @ORM\Table(name="zizoo_cms_bundle_to_top_page_parts")
 * @ORM\Entity
 */
class ToTopPagePart extends AbstractPagePart
{
    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
	return 'ZizooCmsBundle:PageParts:ToTopPagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \Zizoo\Bundle\CmsBundle\Form\PageParts\ToTopPagePartAdminType
     */
    public function getDefaultAdminType()
    {
	return new \Zizoo\Bundle\CmsBundle\Form\PageParts\ToTopPagePartAdminType();
    }
}
