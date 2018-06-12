<?php

namespace EmpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReList
 *
 * @ORM\Table(name="re_list")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\ReListRepository")
 */
class ReList
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
     * @ORM\Column(name="real_title", type="string", length=255)
     */
    private $realTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="real_available", type="string", length=255)
     */
    private $realAvailable;

    /**
     * @var string
     *
     * @ORM\Column(name="real_description", type="text")
     */
    private $realDescription;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\RealCategory")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $realType;

    /**
     *@ORM\ManyToOne(targetEntity="EmpBundle\Entity\Location")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $realLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="real_created_at", type="datetime")
     */
    private $realCreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Employee")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $realAddedBy;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Reality")
     *
     */
    private $listReal;


    /**
     *
     * @return \EmpBundle\Entity\Employee|null
     *
     */
    public function getAddedBy()
    {
        return $this->realAddedBy;
    }

    /**
     * @param Employee
     */
    public function setAddedBy(\EmpBundle\Entity\Employee $realAddedBy = null)
    {
        $this->realAddedBy = $realAddedBy;
    }





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
     * Set realTitle
     *
     * @param string $realTitle
     *
     * @return ReList
     */
    public function setRealTitle($realTitle)
    {
        $this->realTitle = $realTitle;

        return $this;
    }

    /**
     * Get realTitle
     *
     * @return string
     */
    public function getRealTitle()
    {
        return $this->realTitle;
    }

    /**
     * Set realAvailable
     *
     * @param string $realAvailable
     *
     * @return ReList
     */
    public function setRealAvailable($realAvailable)
    {
        $this->realAvailable = $realAvailable;

        return $this;
    }

    /**
     * Get realAvailable
     *
     * @return string
     */
    public function getRealAvailable()
    {
        return $this->realAvailable;
    }

    /**
     * Set realDescription
     *
     * @param string $realDescription
     *
     * @return ReList
     */
    public function setRealDescription($realDescription)
    {
        $this->realDescription = $realDescription;

        return $this;
    }

    /**
     * Get realDescription
     *
     * @return string
     */
    public function getRealDescription()
    {
        return $this->realDescription;
    }

    /**
     * Set realLocation
     *
     * @param string $realLocation
     *
     * @return ReList
     */
    public function setRealLocation($realLocation)
    {
        $this->realLocation = $realLocation;

        return $this;
    }

    /**
     * Get realLocation
     *
     * @return string
     */
    public function getRealLocation()
    {
        return $this->realLocation;
    }

    /**
     * Set realCreatedAt
     *
     * @param \DateTime $realCreatedAt
     *
     * @return ReList
     */
    public function setRealCreatedAt($realCreatedAt)
    {
        $this->realCreatedAt = $realCreatedAt;

        return $this;
    }

    /**
     * Get realCreatedAt
     *
     * @return \DateTime
     */
    public function getRealCreatedAt()
    {
        return new \DateTime('now', (new \DateTimeZone('Asia/Kolkata')));
    }
    

    /**
     * Set realType
     *
     * @param \EmpBundle\Entity\RealCategory $realType
     *
     * @return ReList
     */
    public function setRealType(\EmpBundle\Entity\RealCategory $realType)
    {
        $this->realType = $realType;

        return $this;
    }

    /**
     * Get realType
     *
     * @return \EmpBundle\Entity\RealCategory
     */
    public function getRealType()
    {
        return $this->realType;
    }

    /**
     * Set realAddedBy
     *
     * @param \EmpBundle\Entity\Employee $realAddedBy
     *
     * @return ReList
     */
    public function setRealAddedBy(\EmpBundle\Entity\Employee $realAddedBy)
    {
        $this->realAddedBy = $realAddedBy;

        return $this;
    }

    /**
     * Get realAddedBy
     *
     * @return \EmpBundle\Entity\Employee
     */
    public function getRealAddedBy()
    {
        return $this->realAddedBy;
    }

    /**
     * Set listReal
     *
     * @param \EmpBundle\Entity\Reality $listReal
     *
     * @return ReList
     */
    public function setListReal(\EmpBundle\Entity\Reality $listReal)
    {
        $this->listReal = $listReal;

        return $this;
    }

    /**
     * Get listReal
     *
     * @return \EmpBundle\Entity\Reality
     */
    public function getListReal()
    {
        return $this->listReal;
    }
}
