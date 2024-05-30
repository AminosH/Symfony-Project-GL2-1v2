<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordUpgradableUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, PasswordUpgradableUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50, choices={"ROLE_USER", "ROLE_JOURNALIST", "ROLE_ADMIN"})
     */
    private $role;

    /**
     * @var string
     */
    private $plainPassword;

    public function __construct(?string $username)
    {
        $this->username = $username;
        // for security purposes we will initialize password to a random string
        $this->password = uniqid();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for encoded passwords, as we are using bcrypt
        return null;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * @see PasswordUpgradableUserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     * @return string[] The user roles
     */
    public function getRoles(): array
    {
        return [$this->role];
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function equals(UserInterface $user)
    {
        return $user->getUsername() === $this->getUsername();
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
}


