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
 * @version 	$Id: Article.php 2395 2010-04-18 06:43:22Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_News_Widgets_MostRated_Model_Dao_Pdo_Mysql_Article
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_News_Widgets_MostRated_Model_Interface_Article
{
	public function convert($entity)
	{
		return new Tomato_Modules_News_Model_Article($entity);
	}
	
	public function getMostRatedArticles($limit, $categoryId = null)
	{
		$sql = 'SELECT a.*, COUNT(r.article_id) AS num_rates, SUM(r.rate) AS num_points, c.name AS category_name
				FROM '.$this->_prefix.'news_article AS a
				INNER JOIN '.$this->_prefix.'news_article_rate AS r ON a.article_id = r.article_id
				INNER JOIN '.$this->_prefix.'category AS c ON a.category_id = c.category_id';
		if ($categoryId != null && $categoryId != '') {
			$sql .= ' WHERE a.category_id = '.$conn->quote($categoryId);
		}
		$sql .= ' GROUP BY r.article_id ORDER BY SUM(r.rate) DESC LIMIT '.$limit;
		$rs = $this->_conn->query($sql)->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
}
