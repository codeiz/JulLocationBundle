<?php

namespace Jul\LocationBundle\Entity\Repository;

use Jul\LocationBundle\Entity\State;

use Doctrine\ORM\EntityRepository;

/**
 * StateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StateRepository extends EntityRepository
{
	/**
	 * Find a State using a State name and a Country name
	 * 
	 * @param string $stateName
	 * @param string $countryName
	 * 
	 * @return State
	 */
	public function getOneByStateName( $stateName, $countryName )
	{	
		$query = $this->getEntityManager()
		->createQuery( "SELECT s FROM Jul\LocationBundle\Entity\State s JOIN s.country c WHERE ( s.name = :state OR ( s.name IS NULL AND :state IS NULL ) ) AND c.name = :country");
			
		$query->setParameters(array(
				'state' => $stateName,
				'country' => $countryName
		));
		
		return $query->getOneOrNullResult();
	}
}
