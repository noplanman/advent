<?php
/**
 * Challenge for day 15 of Advent of Code.
 * http://adventofcode.com/day/15
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 15.
 */
class Challenge15 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 15;

	/**
	 * List of our available ingredients.
	 *
	 * @var array
	 */
	private $_ingredients = [];

	/**
	 * Highest cookie score.
	 *
	 * @var array
	 */
	private $_highest_score = [ 0 ];

	/**
	 * Get the total score using the passed amount of ingredients.
	 *
	 * @param array $ingredient_counts Array of ingredients and their amount of spoons.
	 * @return integer The total cookie score.
	 */
	private function _get_total_score( $ingredient_counts ) {
		$totals = [
			'capacity'   => 0,
			'durability' => 0,
			'flavor'     => 0,
			'texture'    => 0,
		];

		foreach ( $ingredient_counts as $name => $spoons ) {
			foreach ( $this->_ingredients[ $name ]->get_scores( $spoons ) as $key => $value ) {
		    $totals[ $key ] += $value;
			}
		}

		foreach ( $totals as &$total ) {
			$total = max( 0, $total );
		}

		return array_product( $totals );
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		foreach ( explode( "\n", $this->_input ) as $ingredient_info ) {
			list( $name, $properties ) = explode( ': ', $ingredient_info );
			$ingredient = [ 'name' => $name ];
			foreach ( explode( ', ', $properties ) as $property ) {
				list( $property_name, $property_value ) = explode( ' ', $property );
				$ingredient[ $property_name ] = $property_value;
			}
			$this->_ingredients[ $name ] = new Challenge15_Ingredient( $ingredient );
		}

		for ( $i = 0; $i <= 100; $i++ ) {
			for ( $j = 0; $j <= 100; $j++ ) {
				for ( $k = 0; $k <= 100; $k++ ) {
					for ( $l = 0; $l <= 100; $l++ ) {
						if ( $i + $j + $k + $l > 100 ) break;
						if ( $i + $j + $k + $l < 100 ) continue;

						$combo = [
							'Sprinkles'    => $i,
							'PeanutButter' => $j,
							'Frosting'     => $k,
							'Sugar'        => $l,
						];
						$total = $this->_get_total_score( $combo );
						if ( $total > max( $this->_highest_score ) ) {
							$recipe = [];
							foreach ( $combo as $key => $value ) {
								$recipe[] = $value . 'x ' . $key;
							}
							$this->_highest_score = [ implode( ', ', $recipe ) => $total ];
						}
					}
				}
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		echo 'Highest score: ' . max( $this->_highest_score ) . "\n";
		echo 'Recipe: ' . array_keys( $this->_highest_score )[0] . "\n";
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}

/**
 * Ingredient class that describes the properties of an ingredient.
 */
class Challenge15_Ingredient {

	private $_name;
	private $_capacity;
	private $_durability;
	private $_flavor;
	private $_texture;
	private $_calories;

	/**
	 * Constructor to set properties.
	 *
	 * @param string  $name
	 * @param integer $capacity
	 * @param integer $durability
	 * @param integer $flavor
	 * @param integer $texture
	 * @param integer $calories
	 */
	public function __construct( $properties ) {
		foreach ( $properties as $property_name => $property_value ) {
			$this->{"_$property_name"} = $property_value;
		}
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
	 * Get the ingredient score for the number of passed spoons.
	 *
	 * @param integer $spoons Number of spoons to account for.
	 * @return integer Ingredient score for the passed number of spoons.
	 */
	public function get_scores( $spoons ) {
		return [
			'capacity'   => $spoons * $this->_capacity,
			'durability' => $spoons * $this->_durability,
			'flavor'     => $spoons * $this->_flavor,
			'texture'    => $spoons * $this->_texture,
		];
	}
}
