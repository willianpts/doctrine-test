<?php
namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="usuarios")
 * @HasLifecycleCallbacks
 */
class User {
	/**
	 * @Id @GeneratedValue
	 * @Column(type="integer")
	 */
	private $id;

	/** @Column(name="usuario_nome",type="string") */
	private $name;
	
	/**
	 * @OneToOne(targetEntity="Organization", mappedBy="owner")
	 */
	private $org;

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getOrg() {
		return $this->org;
	}
}
