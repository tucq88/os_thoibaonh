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
 * @version 	$Id: RequestLog.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_RequestLog
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_RequestLog
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Core_Model_RequestLog($entity); 
	}
	
	public function create($log) 
	{
		$this->_conn->insert($this->_prefix.'core_request_log', array(
			'ip' 			=> $log->ip,
			'agent' 		=> $log->agent,
			'browser' 		=> $log->browser,
			'version' 		=> $log->version,
			'platform' 		=> $log->platform,
			'bot' 			=> $log->bot,
			'uri' 			=> $log->uri,
			'full_url' 		=> $log->full_url,
			'refer_url' 	=> $log->refer_url,
			'access_time' 	=> $log->access_time,
		));
	}
}
