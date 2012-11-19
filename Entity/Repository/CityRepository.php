<?php

namespace Jul\LocationBundle\Entity\Repository;

use Jul\LocationBundle\Entity\City;

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
	 * Find a City using a City name, State name, and a Country name
	 * 
	 * @param string $cityName
	 * @param string $stateName
	 * @param string $countryName
	 * 
	 * @return City
	 */
	public function getOneByCityName( $cityName, $stateName, $countryName )
	{	
		$query = $this->getEntityManager()
		->createQuery( "SELECT c FROM Jul\LocationBundle\Entity\City c JOIN c.state s JOIN s.country y WHERE c.name = :city AND ( s.name = :state OR ( s.name IS NULL AND :state IS NULL ) ) AND y.name = :country");
			
		$query->setParameters(array(
				'city' => $cityName,
				'state' => $stateName,
				'country' => $countryName
		));
		
		return $query->getOneOrNullResult();
	}
}
