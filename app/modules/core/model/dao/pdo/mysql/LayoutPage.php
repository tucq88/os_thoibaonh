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
 * @version 	$Id: LayoutPage.php 2358 2010-04-17 19:14:23Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Core_Model_Dao_Pdo_Mysql_LayoutPage 
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Core_Model_Interface_LayoutPage
{
	public function convert($entity)
	{
		return new Tomato_Modules_Core_Model_LayoutPage($entity); 
	}
	
	public function getOrderedPages()
	{
		$select = $this->_conn->select()
					->from(array('p' => $this->_prefix.'core_page'))
					->order('p.ordering ASC')
					->order('p.name ASC');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function reupdateOrder()
	{
		$sql = 'UPDATE '.$this->_prefix.'core_page SET ordering=? WHERE page_id=?';
		$pages = $this->getOrderedPages();
		for ($i = 0; $i < count($pages); $i++) {
			$this->_conn->query($sql, array($i, $pages[$i]->page_id));
		}
		return $i;
	}
	
	public function updateOrder($pageId = null, $order)
	{
		if (null == $pageId) {
			$sql = 'UPDATE '.$this->_prefix.'core_page SET ordering=?';
			$this->_conn->query($sql, $order);			
		} else {
			$sql = 'UPDATE '.$this->_prefix.'core_page SET ordering=? WHERE page_id=?';
			$this->_conn->query($sql, array($order, $pageId));
		}
	}
	
	public function getPageByName($name)
	{
		$select = $this->_conn
					->select()
					->from(array('p' => $this->_prefix.'core_page'))
					->where('p.name = ?', $name)
					->limit(1);
		$row = $select->query()->fetch();
		return (null == $row) ? null : new Tomato_Modules_Core_Model_LayoutPage($row);		
	}
	
	public function add($page)
	{
		$this->_conn->insert($this->_prefix.'core_page', array(
			'name' 			=> $page->name,
			'title' 		=> $page->title,
			'description' 	=> $page->description,
			'url' 			=> $page->url,
			'url_type' 		=> $page->url_type,
			'params' 		=> $page->params,
			'ordering' 		=> $page->ordering,
		));
		return $this->_conn->lastInsertId($this->_prefix.'core_page');		
	}
	
	public function delete($id)
	{
		$where = array();
		$where[] = 'page_id = '.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'core_page', $where);		
	}
	
	public function update($page)
	{
		$where[] = 'page_id = '.$this->_conn->quote($page->page_id);
		return $this->_conn->update($this->_prefix.'core_page', array(
				'title' 		=> $page->title,
				'description' 	=> $page->description,
				'url' 			=> $page->url,
				'url_type' 		=> $page->url_type,
				'params' 		=> $page->params,
			), $where);		
	}
	
	public function export($file)
	{
		$select = $this->_conn
					->select()
					->from(array('p' => $this->_prefix.'core_page'))
					->order('p.ordering ASC');
		$rs = $select->query()->fetchAll();
		if (null == $rs) {
			return true;
		}
		$data = array();
		foreach ($rs as $row) {
			$data[$row->name] = array(
				'type' 		=> $row->url_type,
				'url' 		=> $row->url,
				'file' 		=> $row->name.'.xml',
				'priority' 	=> (int)$row->ordering,
			);
			if ($row->url_type == 'regex' && $row->params) {
				$data[$row->name]['map'] = array();
				$params = Zend_Json::decode($row->params);
				foreach ($params as $param => $index) {
					$data[$row->name]['map'][$index] = $param;
				}
			}
		}
		$output = array();
		$output['layouts']['layouts'] = $data;
		$config = new Zend_Config($output, array('allowModifications' => true));
		$writer = new Zend_Config_Writer_Ini();
		$writer->write($file, $config);
		
		return true;
	}
	
	public function exist($checkFor, $value)
	{
		$select = $this->_conn->select()
					->from(array('p' => $this->_prefix.'core_page'), array('num_pages' => 'COUNT(*)'));
		switch ($checkFor) {
			case 'name':
				$select->where('p.name = ?', $value);
				break;
			case 'url':
				$select->where('p.url = ?', $value);
				break;
		}
		$row = $select->limit(1)->query()->fetch();
		return ($row->num_pages == 0) ? false : true;
	}
}
