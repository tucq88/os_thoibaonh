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
 * @version 	$Id: TagItem.php 2216 2010-04-11 18:00:41Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Tag_Model_Dao_Pdo_Mysql_TagItem
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Tag_Model_Interface_TagItem
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Tag_Model_TagItem($entity);
	}
	
	public function delete($item)
	{
		return $this->_conn->delete($this->_prefix.'tag_item_assoc', array(
									'item_id = '.$this->_conn->quote($item->item_id),
									'item_name = '.$this->_conn->quote($item->item_name),
									'route_name = '.$this->_conn->quote($item->route_name),
									'details_route_name = '.$this->_conn->quote($item->details_route_name),
								));
	}
	
	public function add($item)
	{
		$this->_conn->insert($this->_prefix.'tag_item_assoc', array(
								'tag_id' => $item->tag_id,
								'item_id' => $item->item_id,
								'item_name' => $item->item_name,
								'route_name' => $item->route_name,
								'details_route_name' => $item->details_route_name,
								'params' => $item->item_name.':'.$item->item_id,
							));
	}
	
	public function getTagCloud($routeName, $limit = null)
	{
		$select = $this->_conn->select()
						->from(array('ti' => $this->_prefix.'tag_item_assoc'), array('details_route_name'))
						->joinInner(array('t' => $this->_prefix.'tag'), 'ti.tag_id = t.tag_id', array('tag_id', 'tag_text', 'num_items' => 'COUNT(*)'))
						->where('ti.route_name = ?', $routeName)
						->group('tag_text');
		if (is_int($limit)) {
			$select->limit($limit);		
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
}
