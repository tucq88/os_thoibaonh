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
 * @version 	$Id: Tag.php 2215 2010-04-11 17:50:07Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Tag_Model_Dao_Pdo_Mysql_Tag
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Tag_Model_Interface_Tag
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Tag_Model_Tag($entity);
	}
	
	public function getTagById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('t' => $this->_prefix.'tag'))
						->where('t.tag_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$tags = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($tags) == 0) ? null : $tags[0];	
	}
	
	public function exist($text)
	{
		$select = $this->_conn
						->select()
						->from(array('t' => $this->_prefix.'tag'), array('num_tags' => 'COUNT(*)'))
						->where('t.tag_text = ?', $text)
						->limit(1);
		return ($select->query()->fetch()->num_tags > 0);
	}
	
	public function add($tag) 
	{
		$this->_conn->insert($this->_prefix.'tag', array(
			'tag_text' => $tag->tag_text,
		));	
		return $this->_conn->lastInsertId($this->_prefix.'tag');
	}
	
	public function delete($tagId) 
	{
		$where = array('tag_id = '.$this->_conn->quote($tagId));
		$this->_conn->delete($this->_prefix.'tag_item_assoc', $where);
		return $this->_conn->delete($this->_prefix.'tag', $where);
	}
	
	public function find($keyword, $start, $count)
	{
		$select = $this->_conn
						->select()
						->from(array('t' => $this->_prefix.'tag'));
		if ($keyword != '') {
			$select->where('t.tag_text LIKE \'%'.addslashes($keyword).'%\'');
		}
		$select->order('tag_id');
		if (is_int($start) && is_int($count)) {
			$select->limit($count, $start);
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($keyword)
	{
		$select = $this->_conn
						->select()
						->from(array('t' => $this->_prefix.'tag'), array('num_tags' => 'COUNT(*)'));
		if ($keyword != '') {
			$select->where('t.tag_text LIKE \'%'.addslashes($keyword).'%\'');
		}
		$select->limit(1);
		return $select->query()->fetch()->num_tags;
	}
	
	public function getTagsByItem($item)
	{
		$select = $this->_conn->select()
						->from(array('t' => $this->_prefix.'tag'), array('tag_id', 'tag_text'))
						->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 't.tag_id = ti.tag_id', array('details_route_name'))
						->where('ti.item_id = ?', $item->item_id)
						->where('ti.item_name = ?', $item->item_name)
						->where('ti.route_name = ?', $item->route_name)
						->where('ti.details_route_name = ?', $item->details_route_name)
						->group('t.tag_id');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
	
	public function getTagsByRoute($item, $limit = null)
	{
		$select = $this->_conn->select()
						->from(array('t' => $this->_prefix.'tag'), array('tag_id', 'tag_text'))
						->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 't.tag_id = ti.tag_id', array('details_route_name'))
						->where('ti.route_name = ?', $item->route_name)
						->where("LOCATE(CONCAT('|', ti.params, '|'), '".addslashes($item->params)."') > 0");
		if (is_int($limit)) {
			$select->limit($limit);		
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
}
