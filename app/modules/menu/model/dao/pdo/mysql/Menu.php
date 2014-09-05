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
 * @version 	$Id: Menu.php 2207 2010-04-11 14:36:52Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Menu_Model_Dao_Pdo_Mysql_Menu
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Menu_Model_Interface_Menu
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Menu_Model_Menu($entity); 
	}
	
	public function getMenuById($id) 
	{
		$select = $this->_conn
					->select()
					->from(array('m' => $this->_prefix.'menu'))
					->where('m.menu_id = ?', $id)
					->limit(1);
		$row = $select->query()->fetchAll();
		$menus = new Tomato_Core_Model_RecordSet($row, $this);
		return (count($menus) == 0) ? null : $menus[0];
	}
	
	public function add($menu) 
	{
		$this->_conn->insert($this->_prefix.'menu', array(
				'name'			=> $menu->name,
				'description'	=> $menu->description,
				'json_data'		=> $menu->json_data,
				'user_id'		=> $menu->user_id,
				'user_name'		=> $menu->user_name,
				'created_date'	=> $menu->created_date,
			));
		return $this->_conn->lastInsertId($this->_prefix.'menu');
	}
	
	public function update($menu) 
	{
		$where[] = 'menu_id = '.$this->_conn->quote($menu->menu_id);
		return $this->_conn->update($this->_prefix.'menu', array(
										'name'			=> $menu->name,
										'description'	=> $menu->description,
										'json_data'		=> $menu->json_data,
									), $where);
	}
	
	public function delete($id) 
	{
		$where[] = 'menu_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'menu', $where);
	}
	
	public function getMenus($start = null, $count = null)
	{
		$select = $this->_conn
				->select()
				->from(array('m' => $this->_prefix.'menu'))
				->order('m.menu_id DESC');
		if (is_int($start) && is_int($count)) {
			$select->limit($count, $start);
		}
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count() 
	{
		$select = $this->_conn
				->select()
				->from(array('m' => $this->_prefix.'menu'), array('num_menus' => 'COUNT(*)'))
				->limit(1);
		$row = $select->query()->fetch();
		return $row->num_menus;
	}
}
