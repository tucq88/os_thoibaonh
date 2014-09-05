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
 * @version 	$Id: Resource.php 2064 2010-04-07 04:29:45Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Core_Model_Interface_Resource
{
	/**
	 * For ACL
	 */
	public function getResources($module = null);
	
	/**
	 * @param int $id
	 * @return Tomato_Modules_Core_Model_Resource
	 */
	public function getResourceById($id);
	
	/**
	 * @param Tomato_Modules_Core_Model_Resource $resource
	 * @return int
	 */
	public function add($resource);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
}
