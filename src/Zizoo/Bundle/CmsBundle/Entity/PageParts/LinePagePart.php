<?php

namespace Zizoo\Bundle\CmsBundle\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;

/**
 * LinePagePart
 *
 * @ORM\Table(name="zizoo_cms_bundle_line_page_parts")
 * @ORM\Entity
 */
class LinePagePart extends AbstractPagePart
{
    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
	return 'ZizooCmsBundle:PageParts:LinePagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \Zizoo\Bundle\CmsBundle\Form\PageParts\LinePagePartAdminType
     */
    public function getDefaultAdminType()
    {
	return new \Zizoo\Bundle\CmsBundle\Form\PageParts\LinePagePartAdminType();
    }
}
