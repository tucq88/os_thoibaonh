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
 * @version 	$Id: Connection.php 2365 2010-04-17 19:40:47Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Core_Db_Adapter_Mysql_Connection extends Tomato_Core_Db_ConnectionAbstract
{
	protected function _connect($config)
	{
		$db = mysql_connect($config['host'].':'.$config['port'], $config['username'], $config['password']);
		mysql_select_db($config['dbname'], $db);
		mysql_query(sprintf("SET CHARACTER SET '%s'", 
							mysql_real_escape_string($config['charset'])));
		return $db;
	}
	
	public function getVersion()
	{
		$conn 	= $this->getSlaveConnection();
		$rs 	= mysql_query('SELECT VERSION() AS ver LIMIT 1', $conn);
		$row 	= mysql_fetch_object($rs);
		mysql_free_result($rs);
		return $row->ver;
	}
}
