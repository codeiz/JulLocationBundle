<?php

namespace Jul\LyfyBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CityRepository extends EntityRepository
{
	/**
	 * Retrieve a city by its name, statename, countryname
	 * 
	 * @param string $city
	 * @param string $state
	 * @param string $country
	 */
	public function getByCityStateCountry( $city, $state, $country )
	{
		
		// NOT CURRENTLY IN USE ANYWHERE, just good example of join query
		
		$query = $this->getEntityManager()
		->createQuery( "SELECT c FROM Jul\LyfyBundle\Entity\City c JOIN c.state s JOIN c.country y WHERE c.name = :city AND s.name = :state AND y.name = :country");
		
		$query->setParameters(array(
				'city' => $city,
				'state' => $state,
				'country' => $country
		));
	
		return $query->getOneOrNullResult();
	}
}
