<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Form")
     * @ORM\JoinColumn(nullable=false)
     */
    private $form;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormData", mappedBy="parent", orphanRemoval=true)
     */
    private $formData;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->formData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function setForm(?Form $form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return Collection|FormData[]
     */
    public function getFormData(): Collection
    {
        return $this->formData;
    }

    public function addFormData(FormData $formData): self
    {
        if (!$this->formData->contains($formData)) {
            $this->formData[] = $formData;
            $formData->setParent($this);
        }

        return $this;
    }

    public function removeFormData(FormData $formData): self
    {
        if ($this->formData->contains($formData)) {
            $this->formData->removeElement($formData);
            // set the owning side to null (unless already changed)
            if ($formData->getParent() === $this) {
                $formData->setParent(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
