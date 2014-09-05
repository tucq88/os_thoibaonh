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
 * @version 	$Id: Privilege.php 2079 2010-04-07 09:14:52Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Core_Model_Interface_Privilege
{
	/**
	 * Get all privileges
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getPrivileges();
	
	/**
	 * @param int $id
	 * @return Tomato_Modules_Core_Model_Privilege
	 */
	public function getPrivilegeById($id);

	/**
	 * @param Tomato_Modules_Core_Model_Privilege $privilege
	 * @return int
	 */
	public function add($privilege);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * For view helper
	 * 
	 * @param Tomato_Modules_Core_Model_Resource $resource
	 * @param int $roleId
	 */
	public function getPrivilegesByRole($resource, $roleId);
	
	/**
	 * For view helper
	 * 
	 * @param Tomato_Modules_Core_Model_Resource $resource
	 * @param int $userId
	 */
	public function getPrivilegesByUser($resource, $userId);
}
