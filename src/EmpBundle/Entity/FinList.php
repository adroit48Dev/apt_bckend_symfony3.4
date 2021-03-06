<?php

namespace EmpBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinList
 *
 * @ORM\Table(name="fin_list")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\FinListRepository")
 */
class FinList
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
     * @ORM\Column(name="fin_title", type="string", length=255)
     */
    private $finTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="fin_description", type="text")
     */
    private $finDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="fin_plan", type="string", length=500)
     */
    private $finPlan;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\FinCategory", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     *
     *
     */
    private $finType;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Location")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $finLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_created_at", type="datetime")
     */
    private $finCreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Employee")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $finAddedBy;

    /**
     *@ORM\ManyToOne(targetEntity="EmpBundle\Entity\Finance")
     *
     */
    private $listFin;

    /**
     *@ORM\OneToMany(targetEntity="AppBundle\Entity\UserAppliedFinance", mappedBy="fPlan")
     */
    private $userApplied;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * Set finTitle
     *
     * @param string $finTitle
     * @Groups({"searchable"})
     *
     * @return FinList
     */
    public function setFinTitle($finTitle)
    {
        $this->finTitle = $finTitle;

        return $this;
    }

    /**
     * Get finTitle
     *
     * @return string
     */
    public function getFinTitle()
    {
        return $this->finTitle;
    }

    /**
     * Set finDescription
     *
     * @param string $finDescription
     *
     * @return FinList
     */
    public function setFinDescription($finDescription)
    {
        $this->finDescription = $finDescription;

        return $this;
    }

    /**
     * Get finDescription
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getFinDescription()
    {
        return $this->finDescription;
    }

    /**
     * Set finPlan
     *
     * @param string $finPlan
     *
     * @return FinList
     */
    public function setFinPlan($finPlan)
    {
        $this->finPlan = $finPlan;

        return $this;
    }

    /**
     * Get finPlan
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getFinPlan()
    {
        return $this->finPlan;
    }

    /**
     * Set finType
     *
     * @param string $finType
     *
     * @return FinList
     */
    public function setFinType($finType)
    {
        $this->finType = $finType;

        return $this;
    }

    /**
     * Get finType
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getFinType()
    {
        return $this->finType;
    }


    /**
     *
     * @param Employee
     */
    public function setFinAddedBy(\EmpBundle\Entity\Employee $finAddedBy = null)
    {
        $this->finAddedBy = $finAddedBy;


    }

    /**
     *@return \EmpBundle\Entity\Employee|null
     */
    public function getFinAddedBy()
    {
        return $this->finAddedBy;
    }

    /**
     * @return \DateTime
     */
    public function getFinCreatedAt()
    {
        return new \DateTime('now', (new \DateTimeZone('Asia/Kolkata')));
    }

    /**
     * @param \DateTime $finCreatedAt
     */
    public function setFinCreatedAt($finCreatedAt)
    {
        $this->finCreatedAt = $finCreatedAt;
    }



    /**
     * Set finLocation
     *
     * @param \EmpBundle\Entity\Location $finLocation
     *
     *
     * @return FinList
     */
    public function setFinLocation(\EmpBundle\Entity\Location $finLocation)
    {
        $this->finLocation = $finLocation;

        return $this;
    }

    /**
     * Get finLocation
     * @Groups({"searchable"})
     *
     * @return \EmpBundle\Entity\Location
     */
    public function getFinLocation()
    {
        return $this->finLocation;
    }

    /**
     * Set listFin
     *
     * @param \EmpBundle\Entity\Finance $listFin
     *
     * @return FinList
     */
    public function setListFin(\EmpBundle\Entity\Finance $listFin)
    {
        $this->listFin = $listFin;

        return $this;
    }

    /**
     * Get listFin
     *
     * @return \EmpBundle\Entity\Finance
     */
    public function getListFin()
    {
        return $this->listFin;
    }

    public function __construct()
    {
        $this->userApplied = new ArrayCollection();
    }

    /**
     * @param mixed $userApplied
     */
    public function setUserApplied(\AppBundle\Entity\UserAppliedFinance $userApplied = null)
    {
        $this->userApplied = $userApplied;


    }

    /**
     * @return mixed
     */
    public function getUserApplied()
    {
        return $this->userApplied;
    }

    public function isAppliedByUser($user)
    {
        if ($user) {
            foreach ($this->userApplied as $userApplied) {
                if ($userApplied->getUser() == $user) {
                    return true;
                }
            }
        }

        return false;
    }



}
