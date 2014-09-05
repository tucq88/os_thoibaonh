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
 * @version 	$Id: Set.php 2120 2010-04-07 19:40:03Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Multimedia_Model_Dao_Pdo_Mysql_Set
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Multimedia_Model_Interface_Set
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Multimedia_Model_Set($entity); 
	}
	
	public function getSetById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('s' => $this->_prefix.'multimedia_set'))
						->where('s.set_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetch();
		return (null == $rs) ? null : new Tomato_Modules_Multimedia_Model_Set($rs);	
	}
	
	public function add($set) 
	{
		$this->_conn->insert($this->_prefix.'multimedia_set', array(
			'title' 			=> $set->title,
			'slug' 				=> $set->slug,
			'description' 		=> $set->description,
			'created_date' 		=> $set->created_date,
			'created_user_id' 	=> $set->created_user_id,
			'created_user_name' => $set->created_user_name,
			'image_medium' 		=> $set->image_medium,
			'image_square' 		=> $set->image_square,
			'image_general' 	=> $set->image_general,
			'image_small' 		=> $set->image_small,
			'image_crop' 		=> $set->image_crop,
			'image_large' 		=> $set->image_large,
			'is_active' 		=> $set->is_active,
		));
		return $this->_conn->lastInsertId($this->_prefix.'multimedia_set');
	}
	
	public function update($set) 
	{
		$where[] = 'set_id = '.$this->_conn->quote($set->set_id);
		return $this->_conn->update($this->_prefix.'multimedia_set', array(
				'title'      		=> $set->title,
				'slug' 				=> $set->slug,
				'description' 		=> $set->description,
				'image_medium' 		=> $set->image_medium,
				'image_square' 		=> $set->image_square,
				'image_general' 	=> $set->image_general,
				'image_small' 		=> $set->image_small,
				'image_crop' 		=> $set->image_crop,
				'image_large' 		=> $set->image_large,
			), $where);			
	}
	
	public function find($start = null, $count = null, $exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('s' => $this->_prefix.'multimedia_set'));
		if ($exp) {
			if (isset($exp['created_user_id'])) {
				$select->where('s.created_user_id = ?', $exp['created_user_id']);
			}
			if (isset($exp['keyword'])) {
				$select->where('s.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
			if (isset($exp['is_active'])) {
				$select->where('s.is_active = ?', (int)$exp['is_active']);
			}
		}
		$select->order('s.set_id DESC');
		if (is_int($start) && is_int($count)) {
			$select->limit($count, $start);
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('s' => $this->_prefix.'multimedia_set'), array('num_sets' => 'COUNT(*)'));
		if ($exp) {
			if (isset($exp['created_user'])) {
				$select->where('s.created_user_id = ?', $exp['created_user']);
			}
			if (isset($exp['keyword'])) {
				$select->where('s.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
		}
		$row = $select->query()->fetch();
		return $row->num_sets;
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'set_id = '.$this->_conn->quote($id);
		$this->_conn->delete($this->_prefix.'multimedia_file_set_assoc', $where);
		return $this->_conn->delete($this->_prefix.'multimedia_set', $where);
	}

	public function updateDescription($setId, $title, $description = null) 
	{
		$where[] = 'set_id = '.$this->_conn->quote($setId);
		$data = array();
		if (null != $title) {
			$data['title'] = $title;
			$data['slug'] = Tomato_Core_Utility_String::removeSign($title, '-', true);
		}
		if (null != $description) {
			$data['description'] = $description;
		} 
		return $this->_conn->update($this->_prefix.'multimedia_set', $data, $where);
	}
	
	public function toggleStatus($id) 
	{
		$sql = 'UPDATE '.$this->_prefix.'multimedia_set SET is_active = 1 - is_active WHERE set_id = '.$this->_conn->quote($id);
		return $this->_conn->query($sql);
	}
	
	public function getSetsByTag($tagId, $start, $count)
	{
		$select = $this->_conn->select()
					->from(array('s' => $this->_prefix.'multimedia_set'), array('set_id', 'title', 'description', 'image_general', 'image_medium', 'image_large'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 's.set_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'set_id')
					->where('s.is_active = ?', 1)
					//->group('s.set_id')
					->order('s.set_id DESC')
					->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function countSetsByTag($tagId)
	{
		$select = $this->_conn->select()
					->from(array('s' => $this->_prefix.'multimedia_set'), array('num_sets' => 'COUNT(set_id)'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 's.set_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'set_id')
					->where('s.is_active = ?', 1);
		return $select->query()->fetch()->num_sets;
	}
	
	public function getSetsHavingFile($fileId, $limit)
	{
		$select = $this->_conn->select()
					->from(array('s' => $this->_prefix.'multimedia_set'), 
					array('set_id', 'slug', 'title', 'description', 'image_square', 'image_general', 'image_small', 'image_crop', 'image_medium', 'image_large'))
					->joinInner(array('fs' => $this->_prefix.'multimedia_file_set_assoc'), 's.set_id = fs.set_id AND fs.file_id = '.$this->_conn->quote($fileId))
					->where('s.is_active = ?', 1)
					->order('s.set_id DESC')
					->limit($limit);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
}
