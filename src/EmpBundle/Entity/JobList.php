<?php

namespace EmpBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\Column(type="boolean", nullable=true, name="is_featured")
     */
    private $isFeatured;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="featured_until")
     */
    private $featuredUntil;

    /**
     * @ORM\Column(type="boolean", nullable=true, name="is_published")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="published_until")
     */
    private $publishedUntil;




    /**
     * @return mixed
     */
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param mixed $isFeatured
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @return mixed
     */
    public function getFeaturedUntil()
    {
        return $this->featuredUntil;
    }

    /**
     * @param mixed $featuredUntil
     */
    public function setFeaturedUntil($featuredUntil)
    {
        $this->featuredUntil = $featuredUntil;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getPublishedUntil()
    {
        return $this->publishedUntil;
    }

    /**
     * @param mixed $publishedUntil
     */
    public function setPublishedUntil($publishedUntil)
    {
        $this->publishedUntil = $publishedUntil;
    }

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

//

    /**
     *@ORM\OneToMany(targetEntity="AppBundle\Entity\UserApplied", mappedBy="job")
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

//

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
     * @Groups({"searchable"})
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
     * @Groups({"searchable"})
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
     * @Groups({"searchable"})
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
     *@Groups({"searchable"})
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
     *@Groups({"searchable"})
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



    /**
     * @param mixed $userApplied
     */
    public function setUserApplied(\AppBundle\Entity\UserApplied $userApplied = null)
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
