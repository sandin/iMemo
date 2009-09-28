<?php
require_once ('../application/models/Stats.php');

class Model_StatsTest extends ControllerTestCase 
{
	
	/**
	 * @var Model_Stats
	 */
	protected $stats;
	
	public function setUp()
	{
		parent::setUp();		
		$this->stats = new Model_Stats();
	}
	
	public function testCanAddCountry()
	{
		$testCountry = "Canada";
		$this->stats->AddCountry($testCountry);
		$countries = $this->stats->GetCountries();
		foreach ($countries as $country)
		{
			if ($testCountry == $country)
			{
				$this->assertEquals($country , $testCountry);			
				break;
			}
				
		}
	}
	


}