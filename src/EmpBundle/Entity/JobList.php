<?php

namespace EmpBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * JobList
 *
 * @ORM\Table(name="job_list")
 * @ORM\Entity(repositoryClass="EmpBundle\Repository\JobListRepository")
 */
class JobList
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="openings", type="string", length=255)
     */
    private $openings;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="EmpBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $skills;

    /**
     *
     *
     *@ORM\ManyToOne(targetEntity="EmpBundle\Entity\Location")
     *@ORM\JoinColumn(nullable=false, name="job_location",referencedColumnName="id")
     */
    private $jobLocation;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Tag")
     * @ORM\JoinColumn(nullable=false, name="job_tag", referencedColumnName="id")
     */
    private $jobTag;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Employee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $addedBy;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\Recruitment")
     *
     */
    private $listRec;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="jobApplied", cascade={"persist", "all"})
     * @ORM\JoinTable(name="user_applied_jobs",
     *     joinColumns={

*     @ORM\JoinColumn(name="job_id", referencedColumnName="id")}, inverseJoinColumns={

*     @ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    private $userApplied;





    /**
     * Set createdIt.
     *
     * @param \DateTime $createdAt
     *
     * @return JobList
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return new \DateTime('now', (new \DateTimeZone('Asia/Kolkata')));
}






    /**
     *
     *
     *
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Set addedBy
     *
     */
    public function setAddedBy(\EmpBundle\Entity\Employee $addedBy = null)
    {
        $this->addedBy = $addedBy;

        return $this;
    }




   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userApplied = new ArrayCollection();


    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUserApplied(User $user)
    {
        $this->userApplied[] = $user;

        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function removeUserApplied(User $user){

        $this->userApplied->removeElement($user);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserApplied()
    {
        return $this->userApplied;
    }

    /**
     * @return mixed
     */
    public function getListRec()
    {
        return $this->listRec;
    }

    /**
     * @param mixed $listRec
     */
    public function setListRec($listRec)
    {
        $this->listRec = $listRec;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return JobList
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set openings
     *
     * @param string $openings
     *
     * @return JobList
     */
    public function setOpenings($openings)
    {
        $this->openings = $openings;

        return $this;
    }

    /**
     * Get openings
     *
     * @return string
     */
    public function getOpenings()
    {
        return $this->openings;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return JobList
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add skill
     *
     * @param \EmpBundle\Entity\Skill $skill
     *
     * @return JobList
     */
    public function addSkill(\EmpBundle\Entity\Skill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \EmpBundle\Entity\Skill $skill
     */
    public function removeSkill(\EmpBundle\Entity\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set jobLocation
     *
     * @param \EmpBundle\Entity\Location $jobLocation
     *
     * @return JobList
     */
    public function setJobLocation(\EmpBundle\Entity\Location $jobLocation)
    {
        $this->jobLocation = $jobLocation;

        return $this;
    }

    /**
     * Get jobLocation
     *
     * @return \EmpBundle\Entity\Location
     */
    public function getJobLocation()
    {
        return $this->jobLocation;
    }

    /**
     * Set jobTag
     *
     * @param \EmpBundle\Entity\Tag $jobTag
     *
     * @return JobList
     */
    public function setJobTag(\EmpBundle\Entity\Tag $jobTag)
    {
        $this->jobTag = $jobTag;

        return $this;
    }

    /**
     * Get jobTag
     *
     * @return \EmpBundle\Entity\Tag
     */
    public function getJobTag()
    {
        return $this->jobTag;
    }




    public function __toString()
    {

        $this->jobTag = [];

        return (string)$this;


    }


}
