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
 * @version 	$Id: Client.php 2096 2010-04-07 12:24:06Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Ad_Model_Interface_Client
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Ad_Model_Client
	 */
	public function getClientById($id);

	/**
	 * Get all clients
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getClients();
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * Update client
	 * 
	 * @param Tomato_Modules_Ad_Model_Client $client
	 * @return int
	 */
	public function update($client);
	
	/**
	 * Add new client
	 * 
	 * @param Tomato_Modules_Ad_Model_Client $client
	 * @return int
	 */
	public function add($client);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param array $exp Search expression. An array contain various conditions, keys including:
	 * 'name', 'email', 'address'
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function find($start, $count, $exp = null);
	
	/**
	 * @param array $exp Search expression (@see find)
	 * @return int
	 */
	public function count($exp = null);
}
