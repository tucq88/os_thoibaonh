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
 * @version 	$Id: File.php 2165 2010-04-08 08:15:47Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Multimedia_Model_Dao_Pdo_Mysql_File
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Multimedia_Model_Interface_File
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Multimedia_Model_File($entity); 
	}
	
	public function getFileById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('f' => $this->_prefix.'multimedia_file'))
						->where('f.file_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$files = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($files) == 0) ? null : $files[0];	
	}
	
	public function add($file) 
	{
		$this->_conn->insert($this->_prefix.'multimedia_file', array(
			'title' 			=> $file->title,
			'slug' 				=> $file->slug,
			'description' 		=> $file->description,
			'content' 			=> $file->content,
			'created_date' 		=> $file->created_date,
			'created_user' 		=> $file->created_user,
			'created_user_name' => $file->created_user_name,
			'image_medium' 		=> $file->image_medium,
			'image_square' 		=> $file->image_square,
			'image_general' 	=> $file->image_general,
			'image_small' 		=> $file->image_small,
			'image_crop' 		=> $file->image_crop,
			'image_large' 		=> $file->image_large,
			'image_original' 	=> $file->image_original,
			'url' 				=> $file->url,
			'html_code' 		=> $file->html_code,
			'file_type' 		=> $file->file_type,
			'is_active' 		=> $file->is_active,
		));
		return $this->_conn->lastInsertId($this->_prefix.'multimedia_file');
	}
	
	public function find($start, $count, $exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('f' => $this->_prefix.'multimedia_file'));
		if ($exp) {
			if (isset($exp['file_id'])) {
				$select->where('f.file_id = ?', $exp['file_id']);
			}
			if (isset($exp['created_user'])) {
				$select->where('f.created_user = ?', $exp['created_user']);
			}
			if (isset($exp['file_type'])) {
				$select->where('f.file_type = ?', $exp['file_type']);
			}
			// TODO: Make a simpler check
			if ((isset($exp['photo']) && '1' == $exp['photo']) && (isset($exp['clip']) && '1' == $exp['clip'])) {
				$select->where('(f.file_type = \'image\' OR f.file_type = \'video\')');
			} elseif (isset($exp['photo']) && '1' == $exp['photo']) {
				$select->where('f.file_type = ?', 'image');
			} elseif (isset($exp['clip']) && '1' == $exp['clip']) {
				$select->where('f.file_type = ?', 'video');
			}
			if (isset($exp['keyword'])) {
				$select->where('f.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
			if (isset($exp['is_active'])) {
				$select->where('f.is_active = ?', (int)$exp['is_active']);
			}
		}
		$select->order('f.file_id DESC')
				->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('f' => $this->_prefix.'multimedia_file'), array('num_files' => 'COUNT(*)'));
		if ($exp) {
			if (isset($exp['file_id'])) {
				$select->where('f.file_id = ?', $exp['file_id']);
			}
			if (isset($exp['created_user'])) {
				$select->where('f.created_user = ?', $exp['created_user']);
			}
			if (isset($exp['file_type'])) {
				$select->where('f.file_type = ?', $exp['file_type']);
			}
			// TODO: Make a simpler check
			if ((isset($exp['photo']) && '1' == $exp['photo']) && (isset($exp['clip']) && '1' == $exp['clip'])) {
				$select->where('(f.file_type = \'image\' OR f.file_type = \'video\')');
			} elseif (isset($exp['photo']) && '1' == $exp['photo']) {
				$select->where('f.file_type = ?', 'image');
			} elseif (isset($exp['clip']) && '1' == $exp['clip']) {
				$select->where('f.file_type = ?', 'video');
			}
			if (isset($exp['keyword'])) {
				$select->where('f.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
			if (isset($exp['is_active'])) {
				$select->where('f.is_active = ?', (int)$exp['is_active']);
			}
		}
		$row = $select->query()->fetch();
		return $row->num_files;
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'file_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'multimedia_file', $where);
	}

	public function updateDescription($fileId, $title, $description = null) 
	{
		$where[] = 'file_id = '.$this->_conn->quote($fileId);
		$data = array();
		if (null != $title) {
			$data['title'] = $title;
			$data['slug'] = Tomato_Core_Utility_String::removeSign($title, '-', true);
		}
		if (null != $description) {
			$data['description'] = $description;
		} 
		return $this->_conn->update($this->_prefix.'multimedia_file', $data, $where);
	}
	
	public function toggleStatus($id) 
	{
		$sql = 'UPDATE '.$this->_prefix.'multimedia_file SET is_active = 1 - is_active WHERE file_id = '.$this->_conn->quote($id);
		return $this->_conn->query($sql);
	}
	
	public function update($file) 
	{
		$where[] = 'file_id = '.$this->_conn->quote($file->file_id);
		return $this->_conn->update($this->_prefix.'multimedia_file', 
					array(
						'title' 			=> $file->title,
						'slug' 				=> $file->slug,
						'description' 		=> $file->description,
						'content' 			=> $file->content,
						'image_medium' 		=> $file->image_medium,
						'image_square' 		=> $file->image_square,
						'image_general' 	=> $file->image_general,
						'image_small' 		=> $file->image_small,
						'image_crop' 		=> $file->image_crop,
						'image_large' 		=> $file->image_large,
						'image_original'	=> $file->image_original,
						'url' 				=> $file->url,
						'html_code' 		=> $file->html_code,
						'file_type' 		=> $file->file_type,
					), $where);		
	}
	
	public function getFilesInSet($setId, $start = null, $count = null, $isActive = null)
	{
		$select = $this->_conn->select()
					->from(array('f' => $this->_prefix.'multimedia_file'))
					->joinInner(array('fs' => $this->_prefix.'multimedia_file_set_assoc'), 'fs.file_id = f.file_id AND fs.set_id = '.$this->_conn->quote($setId), array());
		if (is_bool($isActive)) {
			$select->where('f.is_active = ?', (int)$isActive);
		}
		$select->order('f.file_id DESC');
		if (is_int($start) && is_int($count)) {
			$select->limit($count, $start);
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function countFilesInSet($setId, $isActive = null)
	{
		$select = $this->_conn->select()
					->from(array('f' => $this->_prefix.'multimedia_file'), array('num_files' => 'COUNT(*)'))
					->joinInner(array('fs' => $this->_prefix.'multimedia_file_set_assoc'), 'fs.file_id = f.file_id AND fs.set_id = '.$this->_conn->quote($setId), array());
		if (is_bool($isActive)) {
			$select->where('f.is_active = ?', (int)$isActive);
		}
		$select->limit(1);
		return $select->query()->fetch()->num_files;
	}
	
	public function removeFilesFromSet($setId, $fileId = null)
	{
		$where = array('set_id = '.$this->_conn->quote($setId));
		if ($fileId != null) {
			$where[] = 'file_id = '.$this->_conn->quote($fileId);
		}
		return $this->_conn->delete($this->_prefix.'multimedia_file_set_assoc', $where);
	}
	
	public function addFileToSet($setId, $fileId)
	{
		$this->_conn->insert($this->_prefix.'multimedia_file_set_assoc', array(
								'file_id' => $fileId,
								'set_id' => $setId,
							));
	}
	
	public function getFilesByTag($tagId, $start, $count)
	{
		$select = $this->_conn->select()
					->from(array('f' => $this->_prefix.'multimedia_file'), array('file_id', 'title', 'description', 'image_general', 'image_medium', 'image_large', 'url'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 'f.file_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'file_id')
					->where('f.is_active = ?', 1)
					//->group('f.file_id')
					->order('f.file_id DESC')
					->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function countFilesByTag($tagId)
	{
		$select = $this->_conn->select()
					->from(array('f' => $this->_prefix.'multimedia_file'), array('num_files' => 'COUNT(file_id)'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 'f.file_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'file_id')
					->where('f.is_active = ?', 1);
		return $select->query()->fetch()->num_files;
	}	
}
