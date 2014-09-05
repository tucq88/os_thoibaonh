<?php
class Tomato_Modules_News_Widgets_Topic_Model_Dao_Pdo_Mysql_Tag
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_News_Widgets_Topic_Model_Interface_Tag
{
	public function convert($entity)
	{
		return new Tomato_Modules_News_Model_Article($entity);
	}
	
	public function getAllKeywords()
	{
		$select = $this->_conn->select()
						->from(array('t' => $this->_prefix.'tag'))
						->order('t.tag_text ASC');
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getTagById($tagId)
	{
		$select = $this->_conn->select()
						->from(array('t' => $this->_prefix.'tag'))
						->where('t.tag_id = ?', $tagId)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$tags = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($tags) == 0) ? null : $tags[0];	
	}
}
