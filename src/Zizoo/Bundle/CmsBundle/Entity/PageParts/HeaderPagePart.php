<?php

namespace Zizoo\Bundle\CmsBundle\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HeaderPagePart
 *
 * @ORM\Table(name="zizoo_cms_bundle_header_page_parts")
 * @ORM\Entity
 */
class HeaderPagePart extends AbstractPagePart
{
    /**
     * @ORM\Column(name="niv", type="integer", nullable=true)
     * @Assert\NotBlank(message="headerpagepart.niv.not_blank")
     */
    private $niv;

    /**
     * @ORM\Column(name="title", type="string", nullable=true)
     * @Assert\NotBlank(message="headerpagepart.title.not_blank")
     */
    private $title;

    /**
     * @var array Supported header sizes
     */
    public static $supportedHeaders = array(1, 2, 3, 4, 5, 6);

    /**
     * Set niv
     *
     * @param int $niv
     *
     * @return HeaderPagePart
     */
    public function setNiv($niv)
    {
	$this->niv = $niv;

	return $this;
    }

    /**
     * Get niv
     *
     * @return int
     */
    public function getNiv()
    {
	return $this->niv;
    }

    /**
     * @param string $title
     *
     * @return HeaderPagePart
     */
    public function setTitle($title)
    {
	$this->title = $title;

	return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
	return $this->title;
    }

    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
	return 'ZizooCmsBundle:PageParts:HeaderPagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \Zizoo\Bundle\CmsBundle\Form\PageParts\HeaderPagePartAdminType
     */
    public function getDefaultAdminType()
    {
	return new \Zizoo\Bundle\CmsBundle\Form\PageParts\HeaderPagePartAdminType();
    }
}
