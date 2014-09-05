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
 * @version 	$Id: Session.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Session
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Session
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_Session($entity);
	}	
	
	public function delete($id)
	{
		$where[] = 'session_id = ' . $this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_session', $where);
		return true;
	}

	public function destroy($time)
	{
		$where[] = 'modified + lifetime < ' . $this->_conn->quote($time);
		$this->_conn->delete($this->_prefix.'core_session', $where);		
	}
	
	public function getSessionById($id)
	{
		$select = $this->_conn->select()
						->from(array('s' => $this->_prefix.'core_session'))
						->where('s.session_id = ?', $id)
						->limit(1);
		$row = $select->query()->fetch();
		if (null == $row) {
			return null;
		}
		return new Tomato_Modules_Core_Model_Session($row);
	}
	
	public function insert($session)
	{
		return $this->_conn->insert($this->_prefix.'core_session', array(
										'session_id'	=> $session->session_id,
										'data' 			=> $session->data,
										'modified' 		=> time(),
										'lifetime' 		=> $session->lifetime,
									));
	}
	
	public function update($session)
	{
		$where = array('session_id = '.$this->_conn->quote($session->session_id));
		return $this->_conn->update($this->_prefix.'core_session', array(
										'data' 		=> $session->data,
										'modified' 	=> time(),
										'lifetime' 	=> $session->lifetime,
									), $where);
	}
}
