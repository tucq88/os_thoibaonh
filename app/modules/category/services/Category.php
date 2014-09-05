<?php
class Tomato_Modules_Category_Services_Category
{
	public static function getCategoryTree()
	{
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		return $categories;
	}
}