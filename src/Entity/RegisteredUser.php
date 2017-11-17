<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RegisteredUser
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
     * @Assert\NotNull(message="Please let us know when you are available to volunteer")
     */
    private $availability;
    /**
     * @var null|array
     * @Assert\NotNull(message="Please select at least one sector you are interested in")
     * @Assert\Count(min=1, minMessage="Please select at least one sector you are interested in")
     */
    private $sectors;

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
    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    /**
     * @param null|string $availability
     */
    public function setAvailability(string $availability = null)
    {
        $this->availability = $availability;
    }

    /**
     * @return array|null
     */
    public function getSectors(): ?array
    {
        return $this->sectors;
    }

    /**
     * @param array|null $sectors
     */
    public function setSectors(array $sectors = null)
    {
        $this->sectors = $sectors;
    }
}
