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
 * @version 	$Id: Hook.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Hook 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Hook
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Core_Model_Hook($entity); 
	}
	
	public function getHooks()
	{
		$select = $this->_conn->select()
						->from(array('h' => $this->_prefix.'core_hook'))
						->order('h.name ASC');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getModules()
	{
		$select = $this->_conn->select()
					->from(array('h' => $this->_prefix.'core_hook'), array('module'))
					->distinct()
					->order('module');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function add($hook) 
	{
		$this->_conn->insert($this->_prefix.'core_hook', array(
			'module' 		=> $hook->module,
			'name' 			=> $hook->name,
			'description' 	=> $hook->description,
			'thumbnail' 	=> $hook->thumbnail,
			'author' 		=> $hook->author,
			'email' 		=> $hook->email,
			'version' 		=> $hook->version,
			'license' 		=> $hook->license,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_hook');
	}
	
	public function exist($hook) 
	{ 
		$select = $this->_conn
					->select()
					->from(array('h' => $this->_prefix.'core_hook'), array('num_hooks' => 'COUNT(*)'))
					->where('h.name = ?', $hook->name);
		if ($hook->module && $hook->module != '') {
			$select->where('h.module = ?', $hook->module);
		} else {
			$select->where('h.module IS NULL');
		}
		$rs = $select->query()->fetch();
		return ($rs->num_hooks > 0) ? true : false;
	}
	
	public function delete($id) 
	{
		$where = array();
		$where[] = 'hook_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_hook', $where);	
	}
	
	public function install($hook) 
	{
		$id = $this->add($hook);
				
		// Perform the action when hook is activated
		$hookClass = (null == $hook->module || '' == $hook->module) 
					? 'Tomato_Hooks_'.$hook->name.'_Hook'
					: 'Tomato_Modules_'.$hook->module.'_Hooks_'.$hook->name.'_Hook';
		// TODO: Make this as service
		if (class_exists($hookClass)) {
			$hookInstance = new $hookClass();
			if ($hookInstance instanceof Tomato_Core_Hook) {
				$hookInstance->activate();
			}
		}
		
		return $id;
	}
	
	public function uninstall($hook) 
	{
		// Delete hook
		$this->delete($hook->hook_id);
		
		// Perform the action when hook is deactivated
		// TODO: Make this as service
		$hookClass = (null == $hook->module || '' == $hook->module) 
					? 'Tomato_Hooks_'.$hook->name.'_Hook'
					: 'Tomato_Modules_'.$hook->module.'_Hooks_'.$hook->name.'_Hook';
		if (class_exists($hookClass)) {
			$hookInstance = new $hookClass();
			if ($hookInstance instanceof Tomato_Core_Hook) {
				$hookInstance->deactivate();
			}
		}
		
		// Remove hook from targets if any
		$where = array();
		$where[] = 'hook_name = '.$this->_conn->quote($hook->name);
		$this->_conn->delete($this->_prefix.'core_target', $where);
	}	
}
