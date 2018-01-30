<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $introText;

    /**
     * @ORM\Column(type="text")
     */
    private $bodyTextFirst;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bodyTextSecond;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bodyTextThird;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $outroText;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIntroText()
    {
        return $this->introText;
    }

    public function setIntroText($introText)
    {
        $this->introText = $introText;
    }

    public function getBodyTextFirst()
    {
        return $this->bodyTextFirst;
    }

    public function setBodyTextFirst($bodyTextFirst)
    {
        $this->bodyTextFirst = $bodyTextFirst;
    }

    public function getBodyTextSecond()
    {
        return $this->bodyTextSecond;
    }

    public function setBodyTextSecond($bodyTextSecond)
    {
        $this->bodyTextSecond = $bodyTextSecond;
    }

    public function getBodyTextThird()
    {
        return $this->bodyTextThird;
    }

    public function setBodyTextThird($bodyTextThird)
    {
        $this->bodyTextThird = $bodyTextThird;
    }

    public function getOutroText()
    {
        return $this->outroText;
    }

    public function setOutroText($outroText)
    {
        $this->outroText = $outroText;
    }
}
