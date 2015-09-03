<?php

namespace CarnetAdressesAppartoo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use CarnetAdressesAppartoo\UserBundle\Entity\User;


/**
 * AsdressBook
 *
 * @ORM\Table(name="addressbook_table")
 * @ORM\Entity(repositoryClass="CarnetAdressesAppartoo\AppBundle\Entity\AddressBookRepository")
 * @ExclusionPolicy("all")
 */
class AddressBook {
	
    /**
     * @ORM\Id
     * @ORM\Column(name="id_addressbook", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="CarnetAdressesAppartoo\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(name="id_owner", referencedColumnName="id_user", nullable=false)
     * @Expose
     */
    private $owner;
    
    /**
     * @ORM\ManyToMany(targetEntity="CarnetAdressesAppartoo\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinTable(name="address_contacts_table",
     *          joinColumns={@ORM\JoinColumn(name="id_addressbook", referencedColumnName="id_addressbook")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="id_contact", referencedColumnName="id_user")}
     * )
     * @Expose
     */
    private $contacts;
    
    public function __construct(User $owner) {
        $this->owner = $owner;
        $this->contacts = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getContacts() {
        return $this->contacts;
    }
	
    public function getContact($id) {
        foreach($this->contacts as $contact) {
            if ($contact->getId() === $id) {
                return $contact;
            }
        }
        return null;
    }

    public function setOwner(User $owner) {
        $this->owner = $owner;
        return $this;
    }

    public function addContact(User $contact) {
        $this->contacts[] = $contact;
        return $this;
    }

    public function removeContact(User $contact) {
        $this->contacts->removeElement($contact);
    }
        
    public function isEmpty() {
        return $this->contacts->isEmpty();
    }
    
    public function contains(User $user) {
        return $this->contacts->contains($user);
    }

}