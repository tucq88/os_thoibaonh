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
 * @version 	$Id: User.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_User 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_User
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_User($entity); 
	}
	
	public function authenticate($username, $password)
	{
		$select = $this->_conn->select()
						->from(array('u' => $this->_prefix.'core_user'))
						->joinLeft(array('r' => $this->_prefix.'core_role'), 'u.role_id = r.role_id', array('role_name' => 'name'))
						->where('u.user_name = ?', $username)
						->where('u.password = ?', $password)
						->limit(1);
    	$rs = $select->query()->fetch();
    	return (0 == count($rs)) ? null : new Tomato_Modules_Core_Model_User($rs);
	}
	
	public function getUserById($id) 
	{
		$select = $this->_conn
					->select()
					->from(array('u' => $this->_prefix.'core_user'))
					->where('u.user_id = ?', $id)
					->limit(1);
		$row = $select->query()->fetchAll();
		$users = new Tomato_Core_Model_RecordSet($row, $this);
		return (count($users) == 0) ? null : $users[0]; 
	}
	
	public function toggleStatus($id) 
	{
		$sql = 'UPDATE '.$this->_prefix.'core_user SET is_active = 1 - is_active WHERE user_id = '.$this->_conn->quote($id);
		return $this->_conn->query($sql);
	}
	
	public function add($user) 
	{
		$this->_conn->insert($this->_prefix.'core_user', array(
			'user_name' 		=> $user->user_name,
			'password' 			=> md5($user->password),
			'full_name' 		=> $user->full_name,
			'email' 			=> $user->email,
			'is_active' 		=> $user->is_active,
			'created_date' 		=> $user->created_date,
			'logged_in_date' 	=> $user->logged_in_date,
			'is_online' 		=> $user->is_online,
			'role_id' 			=> $user->role_id,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_user');
	}
	
	public function update($user) 
	{
		$where[] = 'user_id = '.$this->_conn->quote($user->user_id);
		$data = array(
			'user_name' => $user->user_name,
			'full_name' => $user->full_name,
			'email' 	=> $user->email,
			'role_id' 	=> $user->role_id,
		);
		if (null != $user->password && $user->password != '') {
			$data['password'] = md5($user->password);
		} 
		return $this->_conn->update($this->_prefix.'core_user', $data, $where);
	}
	
	public function updatePassword($user) 
	{
		$where[] = 'user_id = '.$this->_conn->quote($user->user_id);
		return $this->_conn->update($this->_prefix.'core_user', array(
										'password' => md5($user->password),
									), $where);
	}
	
	public function updatePasswordFor($username, $password)
	{
		$where[] = 'user_name = '.$this->_conn->quote($username);
		return $this->_conn->update($this->_prefix.'core_user', array(
										'password' => md5($password),
									), $where);
	}
	
	public function find($start, $count, $exp)
	{
		$select = $this->_conn->select()
						->from(array('u' => $this->_prefix.'core_user'));
		if (isset($exp['username'])) {
			$select->where('u.user_name = ?', $exp['username']);
		}
		if (isset($exp['email'])) {
			$select->where('u.email = ?', $exp['email']);
		}
		if (isset($exp['role']) && $exp['role'] != '') {
			$select->where('u.role_id = ?', $exp['role']);
		}
		if (isset($exp['status']) && ($exp['status'] == '0' || $exp['status'] == 1)) {
			$select->where('u.is_active = ?', $exp['status']);
		}
		$select->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($exp)
	{
		$select = $this->_conn->select()
						->from(array('u' => $this->_prefix.'core_user'), array('num_users' => 'COUNT(*)'));
		if (isset($exp['username'])) {
			$select->where('u.user_name = ?', $exp['username']);
		}
		if (isset($exp['email'])) {
			$select->where('u.email = ?', $exp['email']);
		}
		if (isset($exp['role']) && $exp['role'] != '') {
			$select->where('u.role_id = ?', $exp['role']);
		}
		if (isset($exp['status']) && ($exp['status'] == '0' || $exp['status'] == 1)) {
			$select->where('u.is_active = ?', $exp['status']);
		}
		$select->limit(1);
		return $select->query()->fetch()->num_users;
	}
	
	public function exist($checkFor, $value)
	{
		$select = $this->_conn->select()
					->from(array('u' => $this->_prefix.'core_user'), array('num_users' => 'COUNT(*)'));
		switch ($checkFor) {
			case 'username':
				$select->where('u.user_name = ?', $value);
				break;
			case 'email':
				$select->where('u.email = ?', $value);
				break;
		}
		$numUsers = $select->limit(1)->query()->fetch()->num_users;
		return ($numUsers == 0) ? false : true;
	}
}
