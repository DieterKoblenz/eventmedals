<?php
/**
*
* EventMedals test
*
* @copyright (c) 2014 Stanislav Atanasov
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\eventmedals\tests\functional;

/**
* @group functional
*/
class eventmedals_acp_add_test extends eventmedals_base
{

	public function test_install()
	{
		$this->clean_medals_db();
	}

	/**
     * @depends test_install
     */
	public function test_ucp_add_medals()
	{
		//add medals
		$this->login();
		
		$this->add_lang_ext('anavaro/eventmedals', 'event_medals');
		
		$crawler = self::request('GET', 'app.php/eventmedals/add/' . $this->get_user_id('testuser') . '&sid=' . $this->sid);
		
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$form['day'] = 2;
		$form['month'] = 5;
		$form['year'] = 2014;
		$form['link'] = $this->get_topic_id('Test Topic 1');
		
		$crawler = self::submit($form);
		
		$this->assertContainsLang('SUCCESS_ADD_INFO', $crawler->text());
		
		$this->logout();

	}
	/**
     * @depends test_ucp_add_medals
     */
	public function test_ucp_add_medals_unique()
	{
		//add medals
		$this->login();
		
		$this->add_lang_ext('anavaro/eventmedals', 'event_medals');
		
		$crawler = self::request('GET', 'app.php/eventmedals/add/' . $this->get_user_id('testuser') . '&sid=' . $this->sid);
		
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$form['day'] = 2;
		$form['month'] = 5;
		$form['year'] = 2014;
		$form['link'] = $this->get_topic_id('Test Topic 1');
		
		$crawler = self::submit($form);
		$this->assertContainsLang('ERR_DUPLICATE_MEDAL', $crawler->text());
		$this->logout();
	}
	/**
     * @depends test_ucp_add_medals_unique
     */
	public function test_ucp_add_medals_unique()
	{
		//add medals
		$this->login();
		
		$this->add_lang_ext('anavaro/eventmedals', 'event_medals');
		
		$crawler = self::request('GET', 'app.php/eventmedals/add/' . $this->get_user_id('testuser') . '&sid=' . $this->sid);
		
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$form['day'] = 2;
		$form['month'] = 5;
		$form['year'] = 2014;
		$form['link'] = 9999;
		
		$crawler = self::submit($form);
		
		$this->assertContainsLang('ERR_TOPIC_ERR', $crawler->text());
		$this->logout();
	}
}
