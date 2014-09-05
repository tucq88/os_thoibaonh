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
 * @version 	$Id: Zone.php 2099 2010-04-07 13:33:27Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Ad_Model_Interface_Zone
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Ad_Model_Zone
	 */
	public function getZoneById($id);
	
	/**
	 * Get all zones
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getZones();
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);

	/**
	 * Update zone
	 * 
	 * @param Tomato_Modules_Ad_Model_Zone $zone
	 * @return int
	 */
	public function update($zone);

	/**
	 * Add new zone
	 * 
	 * @param Tomato_Modules_Ad_Model_Zone $zone
	 * @return int
	 */
	public function add($zone);
	
	/**
	 * Check whether a zone exists or not
	 * 
	 * @param string $name
	 * @return bool
	 */
	public function exist($name);
}
