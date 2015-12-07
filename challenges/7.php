<?php
/**
 * Challenge for day 7 of Advent of Code.
 * http://adventofcode.com/day/7
 *
 * @package AOC_Solutions
 */

/**
 * Challenge for day 7.
 */
class Challenge7 extends Challenge {

	/**
	 * The current challenge day.
	 *
	 * @var integer
	 */
	protected static $_day = 7;

	/**
	 * All the wire data.
	 *
	 * @var array
	 */
	private $_wires = [];

	/**
	 * Extract the step info from the current step.
	 *
	 * @param string $step The current step.
	 * @return array An array containing the step info.
	 */
	private function _get_step_info( $step ) {
		if ( empty( $step ) ) {
			return null;
		}
		list( $in, $out ) = explode( ' -> ', $step );
		$op_parts = explode( ' ', $in );
		if ( false !== strpos( $in, ' AND ' ) || false !== strpos( $in, ' OR ' ) ) {
			list( $in1, $op, $in2 ) = $op_parts;
			if ( isset( $this->_wires[ $in1 ] ) && isset( $this->_wires[ $in2 ] ) ) {
				$in1 = $this->_wires[ $in1 ];
				$in2 = $this->_wires[ $in2 ];
				return compact( 'op', 'out', 'in1', 'in2' );
			} elseif ( is_numeric( $in1 ) && isset( $this->_wires[ $in2 ] ) ) {
				$in2 = $this->_wires[ $in2 ];
				return compact( 'op', 'out', 'in1', 'in2' );
			}
		} elseif ( false !== strpos( $in, ' LSHIFT ' ) || false !== strpos( $in, ' RSHIFT ' ) ) {
			list( $in, $op, $by ) = $op_parts;
			if ( isset( $this->_wires[ $in ] ) ) {
				$in = $this->_wires[ $in ];
				return compact( 'op', 'out', 'in', 'by' );
			}
		} elseif ( false !== strpos( $in, 'NOT ' ) ) {
			list( $op, $in ) = $op_parts;
			if ( isset( $this->_wires[ $in ] ) ) {
				$in = $this->_wires[ $in ];
				return compact( 'op', 'out', 'in' );
			}
		} else {
			$op = 'SET';
			if ( is_numeric( $in ) ) {
				return compact( 'op', 'out', 'in' );
			} elseif ( isset( $this->_wires[ $in ] ) ) {
				$in = $this->_wires[ $in ];
				return compact( 'op', 'out', 'in' );
			}
		}

		return null;
	}

	/**
	 * The main method where the challenge gets solved.
	 */
	public function solve() {
		$steps = explode( "\n", $this->_input );
		// We need to re-loop all steps until they've all been done.
		$finished = false;
		while ( ! $finished ) {
			$finished = true;
			foreach ( $steps as &$step ) {
				if ( $_step = $this->_get_step_info( $step ) ) {
					extract( $_step );
					switch ( $op ) {
						case 'SET':    $this->_wires[ $out ] = $in;         break;
						case 'AND':    $this->_wires[ $out ] = $in1 & $in2; break;
						case 'OR':     $this->_wires[ $out ] = $in1 | $in2; break;
						case 'LSHIFT': $this->_wires[ $out ] = $in << $by;  break;
						case 'RSHIFT': $this->_wires[ $out ] = $in >> $by;  break;
						case 'NOT':    $this->_wires[ $out ] = ~ $in;       break;
					}
					$finished = false;
					$step = null;
				}
			}
		}
	}

	/**
	 * Output the solution for part 1.
	 */
	public function output_part_1() {
		printf( 'Value of wire a: %s', ( isset( $this->_wires['a'] ) ) ? $this->_wires['a'] : 'Unknown' );
	}

	/**
	 * Output the solution for part 2.
	 */
	public function output_part_2() {
		echo '';
	}
}
