<?php
/**
 * TomatoCMS
 * 
 * LICENSE
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE Version 2 
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-2.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@tomatocms.com so we can send you a copy immediately.
 * 
 * @copyright	Copyright (c) 2009-2010 TIG Corporation (http://www.tig.vn)
 * @license		http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE Version 2
 * @version 	$Id: Rate.php 2181 2010-04-08 10:46:25Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_News_Model_Dao_Pdo_Mysql_Rate
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_News_Model_Interface_Rate
{
	public function convert($entity) 
	{
		return new Tomato_Modules_News_Model_Rate($entity); 
	}
	
	public function addRating($rate)
	{
		$this->_conn->insert($this->_prefix.'news_article_rate', array(
								'article_id' => $rate->article_id,
								'rate'	=> $rate->rate,
								'ip' => $rate->ip,
								'created_date' => $rate->created_date,
							));		
	}
	
	public function countRating($articleId)
	{
		$select = $this->_conn->select()
						->from(array('r' => $this->_prefix.'news_article_rate'), array('total' => 'SUM(r.rate)'))
						->where('article_id = ?', $articleId)
						->group('r.article_id')
						->limit(1);
		return $select->query()->fetch()->total;
	}
}
