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
 * @version 	$Id: Template.php 2084 2010-04-07 09:54:44Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_Template 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_Template
{
	public function convert($entity)
	{
		return $entity; 
	}
	
	public function install($template)
	{
		// Insert new page patterns, if any
		$file = TOMATO_APP_DIR.DS.'templates'.DS.$template.DS.'about.xml';
		if (!file_exists($file)) {
			return;
		}
		$xml = simplexml_load_file($file);
		// Execute install scripts
		$queries = $xml->install->query;
		if ($queries) {
			foreach ($queries as $query) {
				try {
					$this->_conn->beginTransaction();
					//$query = str_replace('###', Tomato_Core_Db_Connection::getDbPrefix(), (string)$query);
					$query = str_replace('###', $this->_prefix, (string)$query);
					$this->_conn->query($query);
					$this->_conn->commit();
				} catch (Exception $ex) {
					$this->_conn->rollBack();
					break;
				}
			}
		}		
	}
}
