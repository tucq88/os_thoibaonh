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
 * @version 	$Id: User.php 2085 2010-04-07 10:00:49Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Core_Model_Interface_User
{
	public function authenticate($username, $password);
	
	/**
	 * Get user by given Id 
	 * 
	 * @param int $id
	 * @return Tomato_Modules_Core_Model_User
	 */
	public function getUserById($id);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function toggleStatus($id);
	
	/**
	 * Add new user
	 * 
	 * @param Tomato_Modules_Core_Model_User $user
	 * @return int
	 */
	public function add($user);
	
	/**
	 * Update user information
	 * 
	 * @param Tomato_Modules_Core_Model_User $user
	 * @return int
	 */
	public function update($user);
	
	/**
	 * Update password
	 * 
	 * @param Tomato_Modules_Core_Model_User $user
	 * @return int
	 */
	public function updatePassword($user);
	
	public function updatePasswordFor($username, $password);
	
	public function find($start, $count, $exp);
	
	public function count($exp);
	
	/**
	 * @param string $checkFor Field to check. Can be username or email
	 * @param string $value
	 * @return bool
	 */
	public function exist($checkFor, $value);	
}
