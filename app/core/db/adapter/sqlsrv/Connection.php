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
 * @version 	$Id: Connection.php 2282 2010-04-16 03:12:03Z huuphuoc $
 */

class Tomato_Core_Db_Adapter_Sqlsrv_Connection extends Tomato_Core_Db_ConnectionAbstract
{
	protected function _connect($config)
	{
		$db = Zend_Db::factory('Sqlsrv', $config);
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		return $db;
	}
	
	public function getVersion()
	{
		$conn = $this->getSlaveConnection();
		return $conn->getServerVersion();
	}
}
