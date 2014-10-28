<?php
namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="orgs")
 */
class Organization {

	/**
	 * @Id @GeneratedValue
	 * @Column(name="id", type="integer")
	 */
	private $id;

	/** @Column(name="nome", type="string") */
	private $name;

	/**
	 * @OneToOne(targetEntity="User")
	 * @JoinColumn(name="usuario_id", referencedColumnName="id")
	 */
	private $owner;

	/** @OneToMany(targetEntity="Entities\Organizations\Admin", mappedBy="organization") */
	private $admins;

	public function __construct() {
		$this->admins = new ArrayCollection;
	}

	public function getId() {
		return $this->id;
	}

	public function getOwner() {
		return $this->owner;
	}

	public function setOwner(User $user) {
		$this->owner = $user;
	}

	public function transferOwnership(Organizations\Admin $admin) {
		$old = $this->getOwner();
		$new = $admin->getUser();

		$this->setOwner($new);
		
		/**
		 * The call to $old->getName() stops the UPDATE query for some reason.
		 * Comment the $log line to see it working
		 */
		$log = "Transfering from " . $old->getName() . " to " . $new->getName();
	}
}
