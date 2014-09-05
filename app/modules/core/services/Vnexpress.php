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
 * @version 	$Id$
 */

class Tomato_Modules_Core_Services_Vnexpress
{
	public function save($folder, $params = array())
	{
		if (null == $folder) {
			return;
		}
		
		$website = $params['website'];
		$categoryIds = explode('-', $params['category_ids']);
		$categoryId = (count($categoryIds) > 0) ? $categoryIds[0] : 0;
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		
		$imageSmall = $folder->find('img', 0);
		if (isset($imageSmall->src)) {
			$crawlerLink = $folder->find('a', 1);
		} else {
			$crawlerLink = $folder->find('a', 0);
		}
					
		// get article link
//		$a = $folder->find('a', 0);
		if (!isset($crawlerLink->href)) {
			return;
		}
		
		$articleLink = $crawlerLink->href;
		
		$select = $conn->select()
						->from(array('a' => Tomato_Core_Db_Connection::getDbPrefix().'news_article'))
						->where('a.link_source = ?', $website . $articleLink)
						->limit(1)
						->query()
						->fetch();
		if ($select != null) {
//			$articleDao->addArticleToCategory($select->article_id, $categoryId, true);
//			if ($categoryIds) {
//				for ($i = 0; $i < count($categoryIds); $i++) {
//					if ($categoryIds[$i] != $categoryId) {
//						$articleDao->addArticleToCategory($select->article_id, $categoryIds[$i]);
//					}
//				}
//			}
			return;
		}
	
		if (!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $website . $articleLink)) {
			return;
		}
		$html = file_get_html($website . $articleLink);
				
		$container = $html->find('.content', 0);
		$div = $container->find('div', 0);
		
		$imageGeneral = $div->find('img', 0);
		
		$data = $div->children();
		$content = null;
		for ($i = 2; $i < count($data); $i++) {
			$content .= $data[$i]->outertext;
		}
		$content = preg_replace('/(img|src)(\"|\'|\=\"|\=\')(.*)/i',"$1$2".$website."$3",$content);
		$content = str_replace('href="', 'href="'.$website.'', $content);
		
		$title = $crawlerLink->innertext;
		$description = $html->find('p', 1)->innertext;
		$description = str_replace('href="', 'href="'.$website.'', $description);

		$article = new Tomato_Modules_News_Model_Article(array(
					'category_id' 		=> $categoryId,
					'title' 			=> $title,	
					'slug' 				=> Tomato_Core_Utility_String::removeSign($title, '-', true),
					'description' 		=> $description,
					'content' 			=> utf8_encode($content),
					'created_date' 		=> $params['date_time'],
					'created_user_id' 	=> 1,
					'created_user_name' => 'admin',
					'activate_date' 	=> $params['date_time'],
					'activate_user_id' 	=> 1,
					'activate_user_name' => 'admin',
					'author' 			=> 'Theo Vnexpress.net',
					'sticky' 			=> false,
					'status'			=> 'active',
					'link_source'		=> $website . $articleLink,
		));
		if (isset($imageSmall->src)) {
			$article->image_square = $website . '/' . $imageSmall->src;
			$article->image_small = $website . '/' . $imageSmall->src;
			$article->image_general = $website . '/' . $imageSmall->src;
		}
		if (isset($imageGeneral->src)) {
			$article->image_general = $website . '/' . $imageGeneral->src;
			$article->image_medium = $website . '/' . $imageGeneral->src;
		}
		$articleId = $articleDao->add($article);
		for ($i = 0; $i < count($categoryIds); $i++) {
			$articleDao->addArticleToCategory($articleId, $categoryIds[$i]);
		}
	}
}