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
 * @version 	$Id: Zone.php 2355 2010-04-17 19:01:52Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Ad_Model_Dao_Pdo_Mysql_Zone
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Ad_Model_Interface_Zone
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Ad_Model_Zone($entity); 
	}
	
	public function getZoneById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('z' => $this->_prefix.'ad_zone'))
						->where('z.zone_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$zones = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($zones) == 0) ? null : $zones[0];	
	}
	
	public function getZones() 
	{
		$select = $this->_conn
					->select()
					->from(array('z' => $this->_prefix.'ad_zone'));
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'zone_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'ad_zone', $where);
	}
	
	public function update($zone) 
	{
		$where[] = 'zone_id = '.$this->_conn->quote($zone->zone_id);
		return $this->_conn->update($this->_prefix.'ad_zone', 
						array(
							'name' 			=> $zone->name,
							'description' 	=> $zone->description,
							'width' 		=> $zone->width,
							'height' 		=> $zone->height,
						), $where);			
	}
	
	public function add($zone) 
	{
		$this->_conn->insert($this->_prefix.'ad_zone', array(
								'name' 			=> $zone->name,
								'description' 	=> $zone->description,
								'width' 		=> $zone->width,
								'height' 		=> $zone->height,
							));
		return $this->_conn->lastInsertId($this->_prefix.'ad_zone');
	}
	
	public function exist($name)
	{
		$select = $this->_conn->select()
					->from(array('z' => $this->_prefix.'ad_zone'), array('num_zones' => 'COUNT(*)'))
					->where('z.name = ?', $name)
				   	->limit(1);
		$numZones = $select->query()->fetch()->num_zones;
		return ($numZones == 0) ? false : true;
	}
}
