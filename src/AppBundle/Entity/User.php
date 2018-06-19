<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EmpBundle\Entity\JobList;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\AccessorOrder("custom", custom = {"id", "username", "email", "mobile"})
 *
 */
class User extends BaseUser
{
    const ROLE_USER = 'ROLE_USER';

    /**
     *
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     *
     *
     * @ORM\Column(name="mobile", type="bigint", unique=true)
     */
    protected $mobile;


    /**
     * @var string The username of the author.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $username;

    /**
     * @var string The email of the user.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $email;

    /**
     * @var string Plain password. Used for model validation. Must not be persisted.
     */
    protected $plainPassword;

    /**
     * @var boolean Shows that the user is enabled
     */
    protected $enabled;

    /**
     * @var array Array, role(s) of the user
     */
    protected $roles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserApplied", mappedBy="user")
     *
     */
    private $jobApplied;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserAppliedReal", mappedBy="user")
     */
    private $realApplied;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserAppliedFinance", mappedBy="user")
     */
    private $finApplied;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserAppliedEdu", mappedBy="user")
     */
    private $eduApplied;

    /**
     * @return mixed
     */
    public function getEduApplied()
    {
        return $this->eduApplied;
    }

    /**
     * @param mixed $eduApplied
     */
    public function setEduApplied($eduApplied)
    {
        $this->eduApplied = $eduApplied;
    }

    /**
     * @return mixed
     */
    public function getFinApplied()
    {
        return $this->finApplied;
    }

    /**
     * @param mixed $finApplied
     */
    public function setFinApplied($finApplied)
    {
        $this->finApplied = $finApplied;
    }

    /**
     * @return mixed
     */
    public function getRealApplied()
    {
        return $this->realApplied;
    }

    /**
     * @param mixed $realApplied
     */
    public function setRealApplied($realApplied)
    {
        $this->realApplied = $realApplied;
    }



    /**
     * @return mixed
     */
    public function getJobApplied()
    {
        return $this->jobApplied;
    }

    /**
     * @param mixed $jobApplied
     */
    public function setJobApplied($jobApplied)
    {
        $this->jobApplied = $jobApplied;
    }

    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     **/
    private $profile;

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }





   public function __construct()
    {
        parent::__construct();
        $this->jobApplied = new ArrayCollection();
        $this->eduApplied = new ArrayCollection();
        $this->finApplied = new ArrayCollection();
        $this->realApplied = new ArrayCollection();


    }


//
//    /**
//     * @param JobList $jobList
//     * @return $this
//     */
//    public function addJobApplied(JobList $jobList){
//        $this->jobApplied->add($jobList);
//        $jobList->setUserApplied($this);
//
//        return $this;
//    }
//
//    /**
//     * @param JobList $jobList
//     * @return $this
//     */
//    public function removeJobApplied(JobList $jobList){
//        $this->jobApplied->removeElement($jobList);
//        $jobList->removeUserApplied($this);
//
//        return $this;
//    }
//
//    /**
//     * @return ArrayCollection
//     *
//     */
//    public function getJobApplied(){
//        return $this->jobApplied;
//    }


    /**
     *
     */
    function jsonSerialize()
    {
        return [
            'id'       => $this->id,
            'username' => $this->username,

            'mobile'    => $this->mobile
        ];
    }



    /**
     * Set mobile
     *
     * @param integer $mobile
     *
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return integer
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    public function getId()
    {
        return $this->id;
    }
}
