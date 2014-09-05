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
 * @version 	$Id: BannerPageAssoc.php 2355 2010-04-17 19:01:52Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Ad_Model_Dao_Pdo_Mysql_BannerPageAssoc
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Ad_Model_Interface_BannerPageAssoc
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Ad_Model_BannerPageAssoc($entity); 
	}
	
	public function removeByBanner($bannerId)
	{
		$where = array('banner_id = '.$this->_conn->quote($bannerId));
		return $this->_conn->delete($this->_prefix.'ad_page_assoc', $where);
	}

	public function add($bannerPageAssoc)
	{
		$this->_conn->insert($this->_prefix.'ad_page_assoc', array(
			'page_name' => $bannerPageAssoc->page_name,
			'page_url' 	=> $bannerPageAssoc->page_url,
			'zone_id' 	=> $bannerPageAssoc->zone_id,
			'banner_id' => $bannerPageAssoc->banner_id,
		));
	}
	
	public function getBannerPageAssoc($bannerId)
	{
		$select = $this->_conn->select()
					   ->from(array('pa' => $this->_prefix.'ad_page_assoc'))
					   ->where('pa.banner_id = ?', $bannerId);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
}
