<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ProjectSuggestion
{
    /**
     * @var null|string
     * @Assert\NotNull(message="Please enter your name")
     */
    private $fullName;
    /**
     * @var null|string
     * @Assert\NotNull(message="Please enter your email")
     * @Assert\Email()
     */
    private $email;
    /**
     * @var null|string
     * @Assert\NotNull(message="Please enter your phone number")
     * @Assert\Length(min=10, max=40)
     */
    private $phone;
    /**
     * @var null|string
     * @Assert\NotNull(message="Please let us know your project suggestion")
     * @Assert\Length(min=1, max=1000)
     */
    private $suggestion;

    /**
     * @return null|string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param null|string $fullName
     */
    public function setFullName(string $fullName = null)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
    }

    /**
     * @return null|string
     */
    public function getSuggestion(): ?string
    {
        return $this->suggestion;
    }

    /**
     * @param null|string $availability
     */
    public function setSuggestion(string $suggestion = null)
    {
        $this->suggestion = $suggestion;
    }
}