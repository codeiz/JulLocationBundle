<?php

namespace Jul\LocationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LocationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LocationRepository extends EntityRepository
{
	/**
	 * Find a Location using a Location address&postcode, City name, State name, and a Country name
	 *
	 * @param string $locationName
	 * @param string $locationAddress
	 * @param string $locationPostcode
	 * @param string $cityName
	 * @param string $stateName
	 * @param string $countryName
	 *
	 * @return City
	 */
	public function getOneByLocationName( $locationName, $locationAddress, $locationPostcode, $cityName, $stateName, $countryName )
	{
		$query = $this->getEntityManager()
		->createQuery( "SELECT l FROM Jul\LocationBundle\Entity\Location l JOIN l.city c JOIN c.state s JOIN s.country y WHERE ( l.name = :location OR ( l.name IS NULL AND :location IS NULL ) ) AND l.address = :address AND ( l.postcode = :postcode OR ( l.postcode IS NULL AND :postcode IS NULL ) ) AND c.name = :city AND ( s.name = :state OR ( s.name IS NULL AND :state IS NULL ) ) AND y.name = :country");
		
		$query->setParameters(array(
				'location' => $locationName,
				'address' => $locationAddress,
				'postcode' => $locationPostcode,
				'city' => $cityName,
				'state' => $stateName,
				'country' => $countryName
		));
	
		return $query->getOneOrNullResult();
	}
}
