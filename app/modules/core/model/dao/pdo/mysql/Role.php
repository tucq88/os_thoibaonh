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
 * @version 	$Id: Role.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Role
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Role
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_Role($entity); 
	}
	
	public function getAclRoles()
	{
		$select = $this->_conn->select()
            		//->from(array('r' => $this->_prefix.'core_role'), array('r.name', 'r.role_id'))
            		->from(array('r' => $this->_prefix.'core_role'))
            		->joinLeft(array('i' => $this->_prefix.'core_role_inheritance'), 'r.role_id = i.child_id')
            		->order(array('role_id', 'ordering'));
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getRoles()
	{
		$select = $this->_conn->select()
            		->from(array('r' => $this->_prefix.'core_role'))
            		->order('role_id DESC');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getRoleById($id) 
	{
		$select = $this->_conn
					->select()
					->from(array('r' => $this->_prefix.'core_role'))
					->where('r.role_id = ?', $id)
					->limit(1);
		$row = $select->query()->fetchAll();
		$roles = new Tomato_Core_Model_RecordSet($row, $this);
		return (count($roles) == 0) ? null : $roles[0]; 
	}
	
	public function add($role) 
	{
		$this->_conn->insert($this->_prefix.'core_role', array(
			'name' 			=> $role->name,
			'description' 	=> $role->description,
			'locked' 		=> $role->locked,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_role');
	}
	
	public function toggleLock($id) 
	{
		$sql = 'UPDATE '.$this->_prefix.'core_role SET locked = 1 - locked WHERE role_id = '.$this->_conn->quote($id);
		return $this->_conn->query($sql);
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'role_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_role', $where);	
	}
	
	public function getRolesIncludeUser()
	{
		$sql = 'SELECT r.*, u2.num_users
				FROM '.$this->_prefix.'core_role AS r
				LEFT JOIN
				(
					SELECT role_id, COUNT(*) AS num_users
					FROM '.$this->_prefix.'core_user AS u
					WHERE role_id IN (SELECT role_id FROM '.$this->_prefix.'core_role)
					GROUP BY role_id
				) AS u2 ON r.role_id = u2.role_id';
		$rs = $this->_conn->query($sql)->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
	
	public function countUsers($roleId)
	{
		$select = $this->_conn->select()
						->from(array('u' => $this->_prefix.'core_user'), array('num_users' => 'COUNT(user_id)'))
						->where('u.role_id = ?', $roleId)
						->limit(1);
		return $select->query()->fetch()->num_users;
	}
}
