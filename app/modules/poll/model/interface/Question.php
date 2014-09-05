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
 * @version 	$Id: Question.php 2123 2010-04-08 02:05:44Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Poll_Model_Interface_Question
{
	public function getQuestionById($id);
	
	/**
	 * @param Tomato_Modules_Poll_Model_Question $question
	 * @return int
	 */
	public function add($question);
	
	/**
	 * @param Tomato_Modules_Poll_Model_Question $question
	 * @return void
	 */
	public function update($question);
	
	/**
	 * @param int $questionId
	 * @return int
	 */
	public function delete($questionId);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param bool $isActive
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function find($start = null, $count = null, $isActive = null);
	
	/**
	 * @return int
	 */
	public function count();
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function toggleActive($id);
}
