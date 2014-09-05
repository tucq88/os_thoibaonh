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
 * @version 	$Id: Banner.php 2091 2010-04-07 11:17:26Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Ad_Model_Interface_Banner
{
	public function loadBanners();
	
	/**
	 * Get banner
	 * 
	 * @param int $id
	 * @return Tomato_Modules_Ad_Model_Banner
	 */
	public function getBannerById($id);

	/**
	 * Add new banner
	 * 
	 * @param Tomato_Modules_Ad_Model_Banner $banner
	 * @return int
	 */
	public function add($banner);
	
	/**
	 * Update banner
	 * 
	 * @param Tomato_Modules_Ad_Model_Banner $banner
	 * @return int
	 */
	public function update($banner);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param array $exp Search expression. An array contain various conditions, keys including:
	 * 'keyword', 'banner_id', 'page_id', 'status'
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function find($start, $count, $exp = null);
	
	/**
	 * @param array $exp Search expression (@see find)
	 * @return int
	 */
	public function count($exp = null);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * @param int $id
	 * @param string $status
	 * @return int
	 */
	public function updateStatus($id, $status);
}
