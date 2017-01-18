<?php

namespace Zizoo\Bundle\CmsBundle\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LinkPagePart
 *
 * @ORM\Table(name="zizoo_cms_bundle_link_page_parts")
 * @ORM\Entity
 */
class LinkPagePart extends AbstractPagePart
{
    /**
     * @ORM\Column(name="url", type="string", nullable=true)
     * @Assert\NotBlank()
     */
    private $url;

    /**
     * @ORM\Column(name="text", type="string", nullable=true)
     * @Assert\NotBlank()
     */
    private $text;

    /**
     * @ORM\Column(name="open_in_new_window", type="boolean", nullable=true)
     */
    private $openInNewWindow;

    /**
     * @param string $url
     *
     * @return LinkPagePart
     */
    public function setUrl($url)
    {
	$this->url = $url;

	return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
	return $this->url;
    }

    /**
     * @return boolean
     */
    public function getOpenInNewWindow()
    {
	return $this->openInNewWindow;
    }

    /**
     * @param boolean $openInNewWindow
     *
     * @return LinkPagePart
     */
    public function setOpenInNewWindow($openInNewWindow)
    {
	$this->openInNewWindow = $openInNewWindow;

	return $this;
    }

    /**
     * @param string $text
     *
     * @return LinkPagePart
     */
    public function setText($text)
    {
	$this->text = $text;

	return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
	return $this->text;
    }

    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
	return 'ZizooCmsBundle:PageParts:LinkPagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \Zizoo\Bundle\CmsBundle\Form\PageParts\LinkPagePartAdminType
     */
    public function getDefaultAdminType()
    {
	return new \Zizoo\Bundle\CmsBundle\Form\PageParts\LinkPagePartAdminType();
    }
}
