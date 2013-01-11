<?php

namespace Jul\LocationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LocationRepository
 *
 * @author julien
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
	 * @return Location
	 */
	public function getOneByLocationName( $locationName = NULL, $locationAddress = NULL, $locationPostcode = NULL, $cityName = NULL, $stateName = NULL, $countryName = NULL )
	{
		$query = $this->getEntityManager()
		->createQuery( "SELECT l FROM Jul\LocationBundle\Entity\Location l JOIN l.city c JOIN c.state s JOIN s.country y WHERE ( l.name = :location OR ( l.name IS NULL AND :location IS NULL ) ) AND ( l.address = :address OR ( l.address IS NULL AND :address IS NULL ) ) AND ( l.postcode = :postcode OR ( l.postcode IS NULL AND :postcode IS NULL ) ) AND ( c.name = :city OR ( c.name IS NULL AND :city IS NULL ) ) AND ( s.name = :state OR ( s.name IS NULL AND :state IS NULL ) ) AND ( y.name = :country OR ( y.name IS NULL AND :country IS NULL ) )");
		
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
