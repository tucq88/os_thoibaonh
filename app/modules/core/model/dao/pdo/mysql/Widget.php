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
 * @version 	$Id: Widget.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Widget 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Widget
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_Widget($entity); 
	}
	
	public function add($widget) 
	{
		$this->_conn->insert($this->_prefix.'core_widget', array(
			'name' 			=> $widget->name,
			'title' 		=> $widget->title,
			'module' 		=> $widget->module,
			'description' 	=> $widget->description,
			'thumbnail' 	=> $widget->thumbnail,
			'author' 		=> $widget->author,
			'email' 		=> $widget->email,
			'version' 		=> $widget->version,
			'license' 		=> $widget->license,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_widget');
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'widget_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_widget', $where);	
	}
	
	public function getWidgets($start = null, $count = null, $module = null)
	{
		$select = $this->_conn->select()
					->from(array('w' => $this->_prefix.'core_widget'));
		if ($module) {
			$select->where('w.module = ?', $module);
		}
		$select->order('w.module ASC')->order('w.name ASC');
		if (is_int($start) && is_int($count)) {
			$select->limit($count, $start);
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($module = null)
	{
		$select = $this->_conn->select()
					->from(array('w' => $this->_prefix.'core_widget'), array('num_widgets' => 'COUNT(widget_id)'));
		if ($module) {
			$select->where('w.module = ?', $module);
		}
		$select->limit(1);
		return $select->query()->fetch()->num_widgets;	
	}
}
