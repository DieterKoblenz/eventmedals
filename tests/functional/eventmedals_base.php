<?php
/**
*
* Zebra enhance 
*
* @copyright (c) 2014 Stanislav Atanasov
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\eventmedals\tests\functional;

/**
* @group functional
*/
class eventmedals_base extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('anavaro/eventmedals');
	}

	public function setUp()
	{
		parent::setUp();
	}
}