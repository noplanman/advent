<?php
/**
 * Challenge for day 14 of Advent of Code.
 * http://adventofcode.com/day/14
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 14.
 */
class Challenge14 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 14;

	/**
	 * All the reindeers in the race.
	 *
	 * This is an array of Challenge14_Reindeer objects.
	 *
	 * @var array
	 */
	private $_reindeers = [];

	/**
	 * Reward the leading reindeers.
	 */
	private function _reward_leaders() {
		$ranking = [];
		foreach ( $this->_reindeers as $reindeer ) {
			$ranking[ $reindeer->get_distance() ][] = $reindeer;
		}
		krsort( $ranking );

		foreach ( reset( $ranking ) as $reindeer ) {
			$reindeer->reward();
		}
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		//$this->quicker = [];
		foreach ( explode( "\n", $this->_input ) as $reindeer_info ) {
			// (Jahnny) can fly (10) km/s for (20) seconds, but then must rest for (2) seconds.
			preg_match( '/(?P<name>\w+) .+ (?P<speed>\d+) .+ (?P<flytime>\d+) .+ (?P<resttime>\d+) .+/', $reindeer_info, $reindeer_infos );
			extract( $reindeer_infos );
			$this->_reindeers[ $name ] = new Challenge14_Reindeer( $name, $speed, $flytime, $resttime );

			// There is also a much quicker way to simply get the distance!
			//$this->quicker[ $name ] = $speed * ( $flytime * ( floor( 2503 / ( $flytime + $resttime ) ) ) + min( $flytime, 2503 % ( $flytime + $resttime ) ) );
		}

		for ( $i = 0; $i < 2503; $i++ ) {
			foreach ( $this->_reindeers as $reindeer ) {
				$reindeer->fly();
			}
			// For part 2, we reward the reindeers that are in the lead.
			$this->_reward_leaders();
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		// Find the reindeer thats in the lead.
		$reindeers = $this->_reindeers;
		usort( $reindeers, function( $a, $b ) {
			return $a->get_distance() <=> $b->get_distance();
		} );
		$winner = end( $reindeers );

		printf( 'In the lead after 2503 seconds: %s, currently at %dkms.', $winner->get_name(), $winner->get_distance() );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		// Find the reindeer with the most reward points.
		$reindeers = $this->_reindeers;
		usort( $reindeers, function( $a, $b ) {
			return $a->get_reward_points() <=> $b->get_reward_points();
		} );
		$winner = end( $reindeers );

		printf( 'Most reward points after 2503 seconds: %s, with %d reward points.', $winner->get_name(), $winner->get_reward_points() );
	}
}

/**
 * Reindeer class that describes the feats of a reindeer.
 */
class Challenge14_Reindeer {

	/**
	 * The reindeers name.
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Reward points for being in the lead.
	 *
	 * @var integer
	 */
	private $_reward_points = 0;

	/**
	 * Flying speed.
	 *
	 * @var integer
	 */
	private $_speed;

	/**
	 * Total distance flown.
	 *
	 * @var integer
	 */
	private $_distance = 0;

	/**
	 * If this reindeer is flying or resting.
	 *
	 * @var boolean
	 */
	private $_is_flying = true;

	/**
	 * Flying time between rests.
	 *
	 * @var integer
	 */
	private $_flytime;

	/**
	 * Flying time elapsed in this flight.
	 *
	 * @var integer
	 */
	private $_flytime_elapsed = 0;

	/**
	 * Resting duration.
	 *
	 * @var integer
	 */
	private $_resttime;

	/**
	 * Resting time elapsed in this rest.
	 *
	 * @var integer
	 */
	private $_resttime_elapsed = 0;

	/**
	 * The total seconds flown so far.
	 *
	 * @var integer
	 */
	private $_current_time = 0;

	/**
	 * Constructor to set properties.
	 *
	 * @param string  $name     The reindeers name.
	 * @param integer $speed    Flying speed.
	 * @param integer $flytime  Flying time between rests.
	 * @param integer $resttime Resting duration.
	 */
	public function __construct( $name, $speed, $flytime, $resttime ) {
		$this->_name     = $name;
		$this->_speed    = $speed;
		$this->_flytime  = $flytime;
		$this->_resttime = $resttime;
	}

	/**
	 * Get the name of this reindeer.
	 *
	 * @return integer The name of this reindeer.
	 */
	public function get_name() {
		return $this->_name;
	}

	/**
	 * Get the flown distance.
	 *
	 * @return integer The distance flown.
	 */
	public function get_distance() {
		return $this->_distance;
	}

	/**
	 * Fly for another second.
	 */
	public function fly() {
		$this->_current_time++;
		if ( $this->_is_flying ) {
			$this->_distance += $this->_speed;
			if ( ++$this->_flytime_elapsed >= $this->_flytime ) {
				$this->_is_flying = false;
				$this->_flytime_elapsed = 0;
			}
		} else {
			if ( ++$this->_resttime_elapsed >= $this->_resttime ) {
				$this->_is_flying = true;
				$this->_resttime_elapsed = 0;
			}
		}
	}

	/**
	 * Reward this reindeer for being in the lead.
	 */
	public function reward() {
		$this->_reward_points++;
	}

	/**
	 * Get the number of reward points this reindeer has earned.
	 *
	 * @return integer Number of reward points earned.
	 */
	public function get_reward_points() {
		return $this->_reward_points;
	}
}
