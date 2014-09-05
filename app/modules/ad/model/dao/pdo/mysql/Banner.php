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
 * @version 	$Id: Banner.php 2163 2010-04-08 07:55:09Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Ad_Model_Dao_Pdo_Mysql_Banner
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Ad_Model_Interface_Banner
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Ad_Model_Banner($entity); 
	}
	
	public function loadBanners()
	{
		$select = $this->_conn->select()
						->from(array('b' => $this->_prefix.'ad_banner'))
						->joinInner(array('pa' => $this->_prefix.'ad_page_assoc'),
							'b.banner_id = pa.banner_id', array('banner_zone_id' => 'zone_id', 'page_name', 'page_url'))
						->where('b.status = ?', 'active');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}

	public function getBannerById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('b' => $this->_prefix.'ad_banner'))
						->where('b.banner_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$banners = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($banners) == 0) ? null : $banners[0];	
	}
	
	public function add($banner) 
	{
		$this->_conn->insert($this->_prefix.'ad_banner', array(
			'name'			=> $banner->name,
			'text' 			=> $banner->text,
			'created_date' 	=> $banner->created_date,
			'start_date' 	=> $banner->start_date,
			'expired_date' 	=> $banner->expired_date,
			'code' 			=> $banner->code,
			'click_url' 	=> $banner->click_url,
			'target' 		=> $banner->target,
			'format' 		=> $banner->format,
			'image_url' 	=> $banner->image_url,
			'mode' 			=> $banner->mode,
			'timeout' 		=> $banner->timeout,
			'client_id' 	=> $banner->client_id,
			'status' 		=> $banner->status,
		));
		return $this->_conn->lastInsertId($this->_prefix.'ad_banner');
	}
	
	public function update($banner) 
	{
		$where[] = 'banner_id = '.$this->_conn->quote($banner->banner_id);
		return $this->_conn->update($this->_prefix.'ad_banner', array(
					'name'			=> $banner->name,
					'text' 			=> $banner->text,
					'start_date' 	=> $banner->start_date,
					'expired_date' 	=> $banner->expired_date,
					'code' 			=> $banner->code,
					'click_url' 	=> $banner->click_url,
					'target' 		=> $banner->target,
					'format' 		=> $banner->format,
					'image_url' 	=> $banner->image_url,
					'mode' 			=> $banner->mode,
					'timeout' 		=> $banner->timeout,
					'client_id' 	=> $banner->client_id,
					'status' 		=> $banner->status,
				), $where);			
	}
	
	public function find($start, $count, $exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('b' => $this->_prefix.'ad_banner'));
		if ($exp) {
			if (isset($exp['page_name'])) {
				$select->joinInner(array('pa' => $this->_prefix.'ad_page_assoc'), 'b.banner_id = pa.banner_id', array('')); 
				$select->where('pa.page_name = ?', $exp['page_name']);
			}
			if (isset($exp['banner_id'])) {
				$select->where('b.banner_id = ?', $exp['banner_id']);
			}
			if (isset($exp['status'])) {
				$select->where('b.status = ?', $exp['status']);
			}
			if (isset($exp['keyword'])) {
				$select->where('b.name LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
		}
		$select->order('b.banner_id DESC')
				->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('b' => $this->_prefix.'ad_banner'), array('num_banners' => 'COUNT(*)'));
		if ($exp) {
			if (isset($exp['page_name'])) {
				$select->joinInner(array('pa' => $this->_prefix.'ad_page_assoc'), 'b.banner_id = pa.banner_id', array('')); 
				$select->where('pa.page_name = ?', $exp['page_name']);
			}
			if (isset($exp['banner_id'])) {
				$select->where('b.banner_id = ?', $exp['banner_id']);
			}
			if (isset($exp['status'])) {
				$select->where('b.status = ?', $exp['status']);
			}
			if (isset($exp['keyword'])) {
				$select->where('b.name LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
		}
		$row = $select->query()->fetch();
		return $row->num_banners;
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'banner_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'ad_banner', $where);
	}
	
	public function updateStatus($id, $status) 
	{
		$where[] = 'banner_id = '.$this->_conn->quote($id);
		return $this->_conn->update($this->_prefix.'ad_banner', array('status' => $status), $where);			
	}
}
