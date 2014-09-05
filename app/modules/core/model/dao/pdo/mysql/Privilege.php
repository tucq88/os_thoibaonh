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
 * @version 	$Id: Privilege.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Privilege 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Privilege
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_Privilege($entity); 
	}
	
	public function getPrivileges()
	{
		$select = $this->_conn
					->select()
					->from(array('p' => $this->_prefix.'core_privilege'));
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getPrivilegeById($id) 
	{
		$select = $this->_conn
					->select()
					->from(array('p' => $this->_prefix.'core_privilege'))
					->where('p.privilege_id = ?', $id)
					->limit(1);
		$row = $select->query()->fetchAll();
		$privileges = new Tomato_Core_Model_RecordSet($row, $this);
		return (count($privileges) == 0) ? null : $privileges[0]; 
	}
	
	public function add($privilege) 
	{
		$this->_conn->insert($this->_prefix.'core_privilege', array(
			'name' 				=> $privilege->name,
			'description' 		=> $privilege->description,
			'module_name' 		=> $privilege->module_name,
			'controller_name' 	=> $privilege->controller_name,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_privilege');
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'privilege_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_privilege', $where);
	}
	
	public function getPrivilegesByRole($resource, $roleId) 
	{
		$module = $resource->module_name;
		$controller = $resource->controller_name;
		$select = $this->_conn->select()
						->from(array('p' => $this->_prefix.'core_privilege'), array('privilege_id', 'name', 'description'))
						->joinLeft(array('r' => $this->_prefix.'core_rule'), 'r.obj_type = "role" AND r.obj_id = '.$this->_conn->quote($roleId).' AND ((r.privilege_id IS NULL AND r.resource_name IS NULL) OR (r.privilege_id IS NULL AND (r.resource_name = '.$this->_conn->quote($module.':'.$controller).')) OR ((r.resource_name = '.$this->_conn->quote($module.':'.$controller).') AND (r.privilege_id = p.privilege_id)))', array('allow'))
						->where('p.module_name = ?', $module)
						->where('p.controller_name = ?', $controller);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getPrivilegesByUser($resource, $userId) 
	{
		$module = $resource->module_name;
		$controller = $resource->controller_name;
		$select = $this->_conn->select()
						->from(array('p' => $this->_prefix.'core_privilege'), array('privilege_id', 'name', 'description'))
						->joinLeft(array('r' => $this->_prefix.'core_rule'), 'r.obj_type = "user" AND r.obj_id = '.$this->_conn->quote($userId).' AND ((r.privilege_id IS NULL AND r.resource_name IS NULL) OR (r.privilege_id IS NULL AND (r.resource_name = '.$this->_conn->quote($module.':'.$controller).')) OR ((r.resource_name = '.$this->_conn->quote($module.':'.$controller).') AND (r.privilege_id = p.privilege_id)))', array('allow'))
						->where('p.module_name = ?', $module)
						->where('p.controller_name = ?', $controller);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
}
