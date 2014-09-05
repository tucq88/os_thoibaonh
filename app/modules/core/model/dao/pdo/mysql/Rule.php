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
 * @version 	$Id: Rule.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Rule
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Rule
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_Rule($entity); 
	}
	
	public function getAclRules()
	{
		$sql = "SELECT CONCAT(ru.obj_type, '_', ru.obj_id) AS role_name, ru.allow, ru.resource_name AS resource_name_2, NULL AS privilege_name
				FROM ".$this->_prefix."core_rule AS ru
				WHERE ru.privilege_id IS NULL
				
				UNION 
				
				SELECT CONCAT(ru.obj_type, '_', ru.obj_id) AS role_name, ru.allow, CONCAT(p.module_name, ':', p.controller_name) AS resource_name_2, p.name AS privilege_name 
				FROM ".$this->_prefix."core_rule AS ru
				INNER JOIN ".$this->_prefix."core_privilege AS p ON ru.privilege_id = p.privilege_id";
		$rs = $this->_conn->query($sql)->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function removeRules($privilegeId)
	{
		$where = array();
		$where[] = 'privilege_id = '.$this->_conn->quote($privilegeId);
		return $this->_conn->delete($this->_prefix.'core_rule', $where);		
	}
	
	public function add($rule)
	{
		$this->_conn->insert($this->_prefix.'core_rule', array(
								'obj_id' 		=> $rule->obj_id,
								'obj_type' 		=> $rule->obj_type,
								'privilege_id' 	=> $rule->privilege_id,
								'allow' 		=> $rule->allow,
								'resource_name' => $rule->resource_name,
							));
		return $this->_conn->lastInsertId($this->_prefix.'core_rule');	
	}
	
	public function removeFromUser($userId)
	{
		$where = array();
		$where[] = 'obj_id = '.$this->_conn->quote($userId);
		$where[] = 'obj_type = '.$this->_conn->quote('user');
		return $this->_conn->delete($this->_prefix.'core_rule', $where);
	}
	
	public function removeFromRole($roleId)
	{
		$where = array();
		$where[] = 'obj_id = '.$this->_conn->quote($roleId);
		$where[] = 'obj_type = '.$this->_conn->quote('role');
		return $this->_conn->delete($this->_prefix.'core_rule', $where);
	}
	
	public function removeByResource($name)
	{
		$where = array();
		$where[] = 'resource_name = '.$this->_conn->quote($name);
		return $this->_conn->delete($this->_prefix.'core_rule', $where);
	}
}
