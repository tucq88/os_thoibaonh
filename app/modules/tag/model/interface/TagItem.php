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
 * @version 	$Id: TagItem.php 2130 2010-04-08 03:12:27Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Tag_Model_Interface_TagItem
{
	/**
	 * @param Tomato_Modules_Tag_Model_TagItem $item
	 */
	public function delete($item);
	
	/**
	 * @param Tomato_Modules_Tag_Model_TagItem $item
	 */
	public function add($item);
	
	/**
	 * Build a tag cloud
	 * 
	 * @param string $routeName
	 * @param int $limit
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getTagCloud($routeName, $limit = null);
}
