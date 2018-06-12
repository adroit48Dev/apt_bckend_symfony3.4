<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="tag_title", type="string", length=255)
     */
    private $tagTitle;



//    /**
//     * @ORM\OneToMany(targetEntity="EmpBundle\Entity\Recruitment", mappedBy="tags")
//     *
//     */
//    private $tagList;
//
//    /**
//     * @return mixed
//     */
//    public function getTagList()
//    {
//        return $this->tagList;
//    }
//
//    /**
//     * @param mixed $tagList
//     */
//    public function setTagList($tagList)
//    {
//        $this->tagList = $tagList;
//    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tagTitle
     *
     * @param string $tagTitle
     *
     * @return Tag
     */
    public function setTagTitle($tagTitle)
    {
        $this->tagTitle = $tagTitle;

        return $this;
    }

    /**
     * Get tagTitle
     *
     * @return string
     */
    public function getTagTitle()
    {
        return $this->tagTitle;
    }
}

