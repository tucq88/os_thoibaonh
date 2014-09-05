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
 * @version 	$Id: Importer.php 2197 2010-04-11 07:50:57Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Import_Adapter_Mysql_Importer
	implements Tomato_Modules_Core_Import_Importer
{
	public function import($file)
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$config = $conn->getConfig();
		mysql_connect($config['host'].':'.$config['port'], $config['username'], $config['password']);
		mysql_select_db($config['dbname']);
		
		$queries = Tomato_Modules_Core_Import_Adapter_MysqlParser::parse($file, Tomato_Core_Db_ConnectionFactory::factory()->getDbPrefix());
		foreach ($queries as $query) {
			mysql_query($query);
			/**
		 	 * FIXME: Use PDO instead of normal MySQL connection
		 	 * 	try {
		 	 * 		$conn->beginTransaction();
		 	 * 		$conn->query($query);
		 	 * 		$conn->commit();
		 	 * 	} cactch (Exception $ex) {
		 	 * 		$conn->rollBack()	
		 	 * 	}
		     */
		}
		mysql_close();
	}
}