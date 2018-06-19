<?php

namespace EmpBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EduList
 *
 * @ORM\Table(name="edu_list")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\EduListRepository")
 */
class EduList
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
     * @ORM\Column(name="ed_title", type="string", length=255)
     */
    private $edTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="ed_description", type="text")
     */
    private $edDescription;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\EdCategory"  )
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $edCategory;

    /**
     *@ORM\ManyToOne(targetEntity="EmpBundle\Entity\Location")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $edLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ed_created_at", type="datetime")
     */
    private $edCreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Employee")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $eduAddedBy;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Education")
     *
     */
    private $listEdu;

    /**
     *@ORM\OneToMany(targetEntity="AppBundle\Entity\UserAppliedEdu", mappedBy="education")
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
     *
     * @return \EmpBundle\Entity\Employee|null
     *
     */
    public function getAddedBy()
    {
        return $this->eduAddedBy;
    }

    /**
     * @param Employee
     */
    public function setAddedBy(\EmpBundle\Entity\Employee $eduAddedBy = null)
    {
        $this->eduAddedBy = $eduAddedBy;
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
     * Set edTitle
     *
     * @param string $edTitle
     *
     * @return EduList
     */
    public function setEdTitle($edTitle)
    {
        $this->edTitle = $edTitle;

        return $this;
    }

    /**
     * Get edTitle
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getEdTitle()
    {
        return $this->edTitle;
    }

    /**
     * Set edDescription
     *
     * @param string $edDescription
     *
     * @return EduList
     */
    public function setEdDescription($edDescription)
    {
        $this->edDescription = $edDescription;

        return $this;
    }

    /**
     * Get edDescription
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getEdDescription()
    {
        return $this->edDescription;
    }

    /**
     * Set edCategory
     *
     * @param string $edCategory
     *
     * @return EduList
     */
    public function setEdCategory($edCategory)
    {
        $this->edCategory = $edCategory;

        return $this;
    }

    /**
     * Get edCategory
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getEdCategory()
    {
        return $this->edCategory;
    }

    /**
     * Set edLocation
     *
     * @param string $edLocation
     *
     *
     * @return EduList
     */
    public function setEdLocation($edLocation)
    {
        $this->edLocation = $edLocation;

        return $this;
    }

    /**
     * Get edLocation
     * @Groups({"searchable"})
     *
     * @return string
     */
    public function getEdLocation()
    {
        return $this->edLocation;
    }

    /**
     * Set edCreatedAt
     *
     * @param \DateTime $edCreatedAt
     *
     * @return EduList
     */
    public function setEdCreatedAt($edCreatedAt)
    {
        $this->edCreatedAt = $edCreatedAt;

        return $this;
    }

    /**
     * Get edCreatedAt
     *
     * @return \DateTime
     */
    public function getEdCreatedAt()
    {
        return new \DateTime('now', (new \DateTimeZone('Asia/Kolkata')));
    }
   

    /**
     * Set eduAddedBy
     *
     * @param \EmpBundle\Entity\Employee $eduAddedBy
     *
     * @return EduList
     */
    public function setEduAddedBy(\EmpBundle\Entity\Employee $eduAddedBy)
    {
        $this->eduAddedBy = $eduAddedBy;

        return $this;
    }

    /**
     * Get eduAddedBy
     *
     * @return \EmpBundle\Entity\Employee
     */
    public function getEduAddedBy()
    {
        return $this->eduAddedBy;
    }

    /**
     * Set listEdu
     *
     * @param \EmpBundle\Entity\Education $listEdu
     *
     * @return EduList
     */
    public function setListEdu(\EmpBundle\Entity\Education $listEdu)
    {
        $this->listEdu = $listEdu;

        return $this;
    }

    /**
     * Get listEdu
     *
     * @return \EmpBundle\Entity\Education
     */
    public function getListEdu()
    {
        return $this->listEdu;
    }

    public function __construct()
    {
        $this->userApplied = new ArrayCollection();
    }

    /**
     * @param mixed $userApplied
     */
    public function setUserApplied(\AppBundle\Entity\UserAppliedEdu $userApplied = null)
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
