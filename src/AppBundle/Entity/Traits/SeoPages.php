<?php
namespace AppBundle\Entity\Traits;

use Symfony\Component\Validator\Constraints as Assert;

trait SeoPages
{
    /**
     * @var string
     * @ORM\Column(name="urlpage", type="string", length=255)
     */
    public $urlpage;

    /**
     * @var string
     * @ORM\Column(name="titlepage", type="string", length=255)
     */
    public $titlepage;


    /**
     * @var string
     * @ORM\Column(name="descriptionpage", type="string", length=255)
     */
    public $descriptionpage;

    /**
     * @var string
     * @ORM\Column(name="keywordpage", type="string", length=255)
     */
    public $keywordpage;

    /**
     * @var string
     * @ORM\Column(name="facebookpage", type="string", length=255)
     */
    public $facebookpage;

    /**
     * @var string
     * @ORM\Column(name="twitterpage", type="string", length=255)
     */
    public $twitterpage;

    /**
     * @var string
     * @ORM\Column(name="googlepage", type="string", length=255)
     */
    public $googlepage;


    /**
     * @return mixed
     */
    public function getUrlpage()
    {
        return $this->urlpage;
    }

    /**
     * @param mixed $urlpage
     */
    public function setUrlpage($urlpage)
    {
        if(isset($this->folder))
        {
            $this->urlpage = $this->folder.'/'.$urlpage;
        }
        else
        {
            $this->urlpage = $urlpage;
        }
    }

    /**
     * @return string
     */
    public function getTitlepage()
    {
        return $this->titlepage;
    }

    /**
     * @param string $titlepage
     */
    public function setTitlepage($titlepage)
    {
        $this->titlepage = $titlepage;
    }

    /**
     * @return string
     */
    public function getDescriptionpage()
    {
        return $this->descriptionpage;
    }

    /**
     * @param string $descriptionpage
     */
    public function setDescriptionpage($descriptionpage)
    {
        $this->descriptionpage = $descriptionpage;
    }

    /**
     * @return string
     */
    public function getKeywordpage()
    {
        return $this->keywordpage;
    }

    /**
     * @param string $keywordpage
     */
    public function setKeywordpage($keywordpage)
    {
        $this->keywordpage = $keywordpage;
    }

    /**
     * @return string
     */
    public function getFacebookpage()
    {
        return $this->facebookpage;
    }

    /**
     * @param string $facebookpage
     */
    public function setFacebookpage($facebookpage)
    {
        $this->facebookpage = $facebookpage;
    }

    /**
     * @return string
     */
    public function getTwitterpage()
    {
        return $this->twitterpage;
    }

    /**
     * @param string $twitterpage
     */
    public function setTwitterpage($twitterpage)
    {
        $this->twitterpage = $twitterpage;
    }

    /**
     * @return string
     */
    public function getGooglepage()
    {
        return $this->googlepage;
    }

    /**
     * @param string $googlepage
     */
    public function setGooglepage($googlepage)
    {
        $this->googlepage = $googlepage;
    }


}