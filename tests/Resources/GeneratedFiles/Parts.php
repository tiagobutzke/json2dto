<?php
/**
 * ================================================
 * DTO Generated by Json2Dto
 *
 * @author Tiago Butzke <tiago.butzke@gmail.com>
 * ================================================
 */
 namespace Json2Dto;

 use Json2Dto\Departure;
use Json2Dto\Arrival;
use Json2Dto\Buscompany;
use Json2Dto\Bus;
use Json2Dto\Waypoints;
use Json2Dto\Seattypes;
use Json2Dto\Products;


 class Parts
 {
    
    /**
     * @var string
     */
     protected $tripId;
    
    /**
     * @var Departure
     */
     protected $departure;
    
    /**
     * @var Arrival
     */
     protected $arrival;
    
    /**
     * @var Buscompany
     */
     protected $buscompany;
    
    /**
     * @var Bus
     */
     protected $bus;
    
    /**
     * @var Waypoints
     */
     protected $waypoints = array();
    
    /**
     * @var Seattypes
     */
     protected $seattypes = array();
    
    /**
     * @var Products
     */
     protected $products = array();
    
    /**
     * @var string
     */
     protected $availableseats;
    
    
    /**
     * Get trip_id
     *
     * @return integer
     */
     public function getTripId()
     {
        return $this->trip_id;
     }
    
    /**
     * Set trip_id
     *
     * @param integer $trip_id
     */
     public function setTripId($trip_id)
     {
        $this->trip_id = $trip_id;
     }
     
    /**
     * Get departure
     *
     * @return Departure
     */
     public function getDeparture()
     {
        return $this->departure;
     }
    
    /**
     * Set departure
     *
     * @param Departure $departure
     */
     public function setDeparture(Departure $departure)
     {
        $this->departure = $departure;
     }
    
    /**
     * Get arrival
     *
     * @return Arrival
     */
     public function getArrival()
     {
        return $this->arrival;
     }
    
    /**
     * Set arrival
     *
     * @param Arrival $arrival
     */
     public function setArrival(Arrival $arrival)
     {
        $this->arrival = $arrival;
     }
    
    /**
     * Get busCompany
     *
     * @return Buscompany
     */
     public function getBuscompany()
     {
        return $this->busCompany;
     }
    
    /**
     * Set busCompany
     *
     * @param Buscompany $busCompany
     */
     public function setBuscompany(Buscompany $busCompany)
     {
        $this->busCompany = $busCompany;
     }
    
    /**
     * Get bus
     *
     * @return Bus
     */
     public function getBus()
     {
        return $this->bus;
     }
    
    /**
     * Set bus
     *
     * @param Bus $bus
     */
     public function setBus(Bus $bus)
     {
        $this->bus = $bus;
     }
    
    /**
     * Get waypoints
     *
     * @return Waypoints
     */
     public function getWaypoints()
     {
        return $this->waypoints;
     }
    
    /**
     * Add waypoints
     *
     * @param $waypoints
     */
     public function addWaypoints(Waypoints $waypoints)
     {
        $this->waypoints[] = $waypoints;
     }
    
    /**
     * Get seatTypes
     *
     * @return Seattypes
     */
     public function getSeattypes()
     {
        return $this->seatTypes;
     }
    
    /**
     * Add seatTypes
     *
     * @param $seatTypes
     */
     public function addSeattypes(Seattypes $seatTypes)
     {
        $this->seatTypes[] = $seatTypes;
     }
    
    /**
     * Get products
     *
     * @return Products
     */
     public function getProducts()
     {
        return $this->products;
     }
    
    /**
     * Add products
     *
     * @param $products
     */
     public function addProducts(Products $products)
     {
        $this->products[] = $products;
     }
    
    /**
     * Get availableSeats
     *
     * @return integer
     */
     public function getAvailableseats()
     {
        return $this->availableSeats;
     }
    
    /**
     * Set availableSeats
     *
     * @param integer $availableSeats
     */
     public function setAvailableseats($availableSeats)
     {
        $this->availableSeats = $availableSeats;
     }
     
 }