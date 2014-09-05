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
 * @version 	$Id: TagItem.php 2383 2010-04-18 05:41:11Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Tag_Model_TagItem extends Tomato_Core_Model_Entity
{
	protected $_properties = array(
		'tag_id' 				=> null,
		'item_id' 				=> null,
		'item_name' 			=> null,
		'route_name' 			=> null,
		'details_route_name' 	=> null,
		'params' 				=> null,
	);
}
