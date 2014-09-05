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
 * @version 	$Id: Category.php 2376 2010-04-18 05:28:36Z huuphuoc $
 */

class Tomato_Modules_Category_Model_Category extends Tomato_Core_Model_Entity 
{
	protected $_properties = array(
		'category_id' 	=> null,
		'name' 			=> null,
		'slug' 			=> null,
		'meta' 			=> null,
		'is_active' 	=> 0,
		'left_id' 		=> null,
		'right_id' 		=> null,
		'created_date' 	=> null,
		'modified_date' => null,
		'user_id' 		=> null,
		'image_url'		=> null,
	);
}