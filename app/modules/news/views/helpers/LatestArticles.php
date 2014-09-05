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
 * @version 	$Id: LatestArticles.php 2137 2010-04-08 04:17:41Z huuphuoc $
 */

class News_View_Helper_LatestArticles extends Zend_View_Helper_Abstract 
{
	public function latestArticles($categoryId, $limit = 5, $mainCategoryId = false) 
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		return $articleDao->getArticlesByCategory($categoryId, 0, $limit, $mainCategoryId);
	}
}