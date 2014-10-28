<?php
namespace Entities\Organizations;

/**
 * @Entity
 * @Table(name="admins")
 */
class Admin {

	/**
	 * @Id @GeneratedValue
	 * @Column(type="integer", name="id")
	 */
	private $id;

    /**
	 * @OneToOne(targetEntity="Entities\Organization")
	 * @JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	private $organization;

    /**
	 * @OneToOne(targetEntity="Entities\User")
	 * @JoinColumn(name="usuario_id", referencedColumnName="id")
	 */
	private $user;

	/** @Column(name="created_at", type="datetime") */
	private $created_at;
	
	public function __construct() {
		$this->created_at = new \DateTime();
	}

	function getId() {
		return $this->id;
	}

	function getOrg() {
		return $this->organization;
	}

	function getUser() {
		return $this->user;
	}

	public function setOrg(E\Organization $org) {
		$this->organization = $org;
	}

	public function setUser(E\User $user) {
		$this->user = $user;
	}

	public function isOwner() {
		return $this->getUser()->getId() === $this->getOrg()->getOwner()->getId();
	}

	public function notOwner() {
		return ! $this->isOwner();
	}
}
