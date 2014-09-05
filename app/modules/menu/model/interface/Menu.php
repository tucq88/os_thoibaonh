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
 * @version 	$Id: Menu.php 2113 2010-04-07 16:55:31Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Menu_Model_Interface_Menu
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Menu_Model_Menu
	 */
	public function getMenuById($id);
	
	/**
	 * @param Tomato_Modules_Menu_Model_Menu $menu
	 * @return int
	 */
	public function add($menu);
	
	/**
	 * @param Tomato_Modules_Menu_Model_Menu $menu
	 */
	public function update($menu);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getMenus($start = null, $count = null);
	
	/**
	 * @return int
	 */
	public function count();
}
