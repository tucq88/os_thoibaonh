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
 * @version 	$Id: Role.php 2081 2010-04-07 09:20:11Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Core_Model_Interface_Role
{
	/**
	 * For ACL
	 */
	public function getAclRoles();
	
	/**
	 * Get all roles
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getRoles();
	
	/**
	 * @param int $id
	 * @return Tomato_Modules_Core_Model_Role
	 */
	public function getRoleById($id);
	
	/**
	 * @param Tomato_Modules_Core_Model_Role $role
	 * @return int
	 */
	public function add($role);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function toggleLock($id);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	public function getRolesIncludeUser();
	
	/**
	 * Count the number of users who have given role
	 * 
	 * @param int $roleId
	 * @return int
	 */
	public function countUsers($roleId);
}
