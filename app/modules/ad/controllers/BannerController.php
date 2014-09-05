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
 * @version 	$Id: BannerController.php 2317 2010-04-17 12:49:50Z huuphuoc $
 */

class Ad_BannerController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */
	
	/**
	 * Activate a banner
	 * 
	 * @return void
	 */
	public function activateAction()
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$id 	= $request->getPost('id');
			$status = $request->getPost('status');
			$status = ($status == 'inactive') ? 'active' : 'inactive';
			
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$bannerDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerDao();
			$bannerDao->setDbConnection($conn);
			$bannerDao->updateStatus($id, $status);
			
			$this->getResponse()->setBody($status);			
		}
	}
	
	/**
	 * Add new banner
	 * 
	 * @return void
	 */
	public function addAction() 
	{
		$this->view->addHelperPath(TOMATO_APP_DIR.DS.'modules'.DS.'upload'.DS.'views'.DS.'helpers', 'Upload_View_Helper_');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$pageDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$zoneDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getZoneDao();
		$clientDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getClientDao();
		$bannerDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerDao();
		$bannerPageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerPageAssocDao();
		$pageDao->setDbConnection($conn);
		$zoneDao->setDbConnection($conn);
		$clientDao->setDbConnection($conn);
		$bannerDao->setDbConnection($conn);
		$bannerPageDao->setDbConnection($conn);
		
		$pages 		= $pageDao->getOrderedPages();
		$zones 		= $zoneDao->getZones();
		$clients 	= $clientDao->getClients();
		
		$this->view->assign('pages', $pages);
		$this->view->assign('zones', $zones);
		$this->view->assign('clients', $clients);
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$name 			= $request->getPost('name');
			$text 			= $request->getPost('text');
			$startDate 		= $request->getPost('startDate');
			$expiredDate 	= $request->getPost('expiredDate');
			$code 			= $request->getPost('code');
			$clickUrl 		= $request->getPost('clickUrl');
			$target 		= $request->getPost('target');
			$format 		= $request->getPost('format');
			$mode 			= $request->getPost('mode');
			$timeout 		= $request->getPost('timeout');
			$status 		= $request->getPost('status');
			$pages 			= $request->getPost('pages');
			$zones 			= $request->getPost('zones');
			$otherZones 	= $request->getPost('otherZones');
			$otherUrls 		= $request->getPost('otherUrls');
			$otherPages 	= $request->getPost('otherPages');
			$imageUrl 		= $request->getPost('imageUrl');
			$clientId 		= $request->getPost('client');
			
			$banner = new Tomato_Modules_Ad_Model_Banner(array(
				'name' 			=> $name,
				'text' 			=> $text,
				'created_date' 	=> date('Y-m-d H:i:s'),
				'code' 			=> $code,
				'click_url' 	=> $clickUrl,
				'format' 		=> $format,
				'image_url' 	=> $imageUrl,
				'mode' 			=> $mode,
				'timeout' 		=> 0,
			));
			if ($timeout) {
				$banner->timeout = $timeout;
			}
			if ($target) {
				$banner->target = $target;
			}
			if ($status) {
				$banner->status = $status;
			}
			if ($clientId) {
				$banner->client_id = $clientId;
			}
			if ($startDate) {
				$banner->start_date = date('Y-m-d', strtotime($startDate));
			}
			if ($expiredDate) {
				$banner->expired_date = date('Y-m-d', strtotime($expiredDate));
			}
			
			$id = $bannerDao->add($banner);
			if ($id > 0) {
				if ($pages) {
					for ($i = 0; $i < count($pages); $i++) {
						$arr = explode('__', $pages[$i]);
						$bannerPageDao->add(new Tomato_Modules_Ad_Model_BannerPageAssoc(array(
							'page_name' => $arr[0],
							'page_url' 	=> $arr[1],
							'zone_id' 	=> $zones[$i],
							'banner_id' => $id,
						)));
					}
				}
				if ($otherUrls) {
					for ($i = 0; $i < count($otherUrls); $i++) {
						$bannerPageDao->add(new Tomato_Modules_Ad_Model_BannerPageAssoc(array(
							'page_name' => $otherPages[$i],
							'page_url' 	=> $otherUrls[$i],
							'zone_id' 	=> $otherZones[$i],
							'banner_id' => $id,
						)));
					}
				}
				$this->_helper->getHelper('FlashMessenger')->addMessage(
					$this->view->translator('banner_add_success')
				);
				$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'ad_banner_add'));
			}
		}
	}

	/**
	 * Delete banner
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$id 		= $request->getPost('id');
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$bannerDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerDao();
			$bannerDao->setDbConnection($conn);
			$bannerDao->delete($id);
		}
		$this->getResponse()->setBody('RESULT_OK');
	}
	
	/**
	 * Edit banner
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$this->view->addHelperPath(TOMATO_APP_DIR.DS.'modules'.DS.'upload'.DS.'views'.DS.'helpers', 'Upload_View_Helper_');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$bannerDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerDao();
		$clientDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getClientDao();
		$pageDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$bannerPageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerPageAssocDao();
		$zoneDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getZoneDao();
		$bannerDao->setDbConnection($conn);
		$clientDao->setDbConnection($conn);
		$pageDao->setDbConnection($conn);
		$bannerPageDao->setDbConnection($conn);
		$zoneDao->setDbConnection($conn);

		$request 	= $this->getRequest();
		$bannerId 	= $request->getParam('banner_id');
		$banner 	= $bannerDao->getBannerById($bannerId);
		$clients 	= $clientDao->getClients();
		$pages 		= $pageDao->getOrderedPages();
		$zones 		= $zoneDao->getZones();

		$bannerPageNames 	= array();
		$bannerZones 		= array();
		$bannerPageUrls 	= array();
		$rs = $bannerPageDao->getBannerPageAssoc($bannerId);
		if ($rs) {
			foreach ($rs as $row) {
				$bannerPageNames[] 	= $row->page_name;
				$bannerZones[] 		= $row->zone_id;
				$bannerPageUrls[] 	= $row->page_url;
			}
		}
		
		$this->view->assign('banner', $banner);
		$this->view->assign('clients', $clients);
		$this->view->assign('pages', $pages);
		$this->view->assign('zones', $zones);
		$this->view->assign('bannerPageNames', $bannerPageNames);
		$this->view->assign('bannerZones', $bannerZones);
		$this->view->assign('bannerPageUrls', $bannerPageUrls);
		
		if ($request->isPost()) {
			$bannerId 		= $request->getPost('banner_id');
			$name 			= $request->getPost('name');
			$text 			= $request->getPost('text');
			$startDate 		= $request->getPost('startDate');
			$expiredDate 	= $request->getPost('expiredDate');
			$code 			= $request->getPost('code');
			$clickUrl 		= $request->getPost('clickUrl');
			$target 		= $request->getPost('target');
			$format 		= $request->getPost('format');
			$mode 			= $request->getPost('mode');
			$timeout 		= $request->getPost('timeout');	
			$status 		= $request->getPost('status');		
			$pages 			= $request->getPost('pages');
			$zones 			= $request->getPost('zones');
			$otherZones 	= $request->getPost('otherZones');
			$otherPages 	= $request->getPost('otherPages');
			$otherUrls 		= $request->getPost('otherUrls');
			$imageUrl 		= $request->getPost('imageUrl');
			$clientId 		= $request->getPost('client');
			
			$banner = new Tomato_Modules_Ad_Model_Banner(array(
				'banner_id' => $bannerId,
				'name' 		=> $name,
				'text' 		=> $text,
				'code' 		=> $code,
				'click_url' => $clickUrl,
				'format' 	=> $format,
				'image_url' => $imageUrl,
				'mode' 		=> $mode,
				'timeout' 	=> 0,
			));
			if ($timeout) {
				$banner->timeout = $timeout;
			}
			if ($target) {
				$banner->target = $target;
			}
			if ($status) {
				$banner->status = $status;
			}
			if ($clientId) {
				$banner->client_id = $clientId;
			}
			if ($startDate) {
				$banner->start_date = date('Y-m-d', strtotime($startDate));
			}
			if ($expiredDate) {
				$banner->expired_date = date('Y-m-d', strtotime($expiredDate));
			}
			$result = $bannerDao->update($banner);
			
			$bannerPageDao->removeByBanner($bannerId);
			if ($pages) {
				if ($pages) {
					for ($i = 0; $i < count($pages); $i++) {
						$arr = explode('__', $pages[$i]);
						$bannerPageDao->add(new Tomato_Modules_Ad_Model_BannerPageAssoc(array(
							'page_name' => $arr[0],
							'page_url' 	=> $arr[1],
							'zone_id' 	=> $zones[$i],
							'banner_id' => $bannerId,
						)));
					}
				}
				if ($otherUrls) {
					for ($i = 0; $i < count($otherUrls); $i++) {
						$bannerPageDao->add(new Tomato_Modules_Ad_Model_BannerPageAssoc(array(
							'page_name' => $otherPages[$i],
							'page_url' 	=> $otherUrls[$i],
							'zone_id' 	=> $otherZones[$i],
							'banner_id' => $bannerId,
						)));
					}
				}
			}
			
			$this->_helper->getHelper('FlashMessenger')->addMessage(
				$this->view->translator('banner_edit_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array('banner_id' => $bannerId), 'ad_banner_edit'));
		}
	}
	
	/**
	 * List banners
	 * 
	 * @return void
	 */
	public function listAction()
	{
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$bannerDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('ad')->getBannerDao();
		$pageDao->setDbConnection($conn);
		$bannerDao->setDbConnection($conn);
			
		$pages 		= $pageDao->getOrderedPages();
		
		$request	= $this->getRequest();
		$pageIndex 	= $request->getParam('pageIndex', 1);
		$perPage 	= 20;
		$start 		= ($pageIndex - 1) * $perPage;
		
		// Build article search expression
		$user = Zend_Auth::getInstance()->getIdentity();
		$params = null;
		$exp = array(
			'keyword'	=> null,
			'banner_id'	=> null,
			'page_name'	=> null,
			'status'	=> null,
		);
		
		if ($request->isPost()) {
			$id 		= $request->getPost('bannerId');
			$keyword 	= $request->getPost('keyword');
			$pageName 	= $request->getPost('page');
			$status 	= $request->getPost('status');
			if ($keyword) {
				$exp['keyword'] = $keyword;
			}
			if ($id) {
				$exp['banner_id'] = $id;
			}
			if ($pageName) {
				$exp['page_name'] = $pageName;
			}
			if ($status) {
				$exp['status'] = $status;
			}
			$params = rawurlencode(base64_encode(Zend_Json::encode($exp)));
		} else {
			$params = $request->getParam('q');
			if (null != $params) {
				$exp = rawurldecode(base64_decode($params));
				$exp = Zend_Json::decode($exp); 
			} else {
				$params = rawurlencode(base64_encode(Zend_Json::encode($exp)));
			}
		}
		
		$banners 	= $bannerDao->find($start, $perPage, $exp);
		$numBanners = $bannerDao->count($exp);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($banners, $numBanners));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);

		$this->view->assign('pages', $pages);
		$this->view->assign('pageIndex', $pageIndex);
		
		$this->view->assign('numBanners', $numBanners);
		$this->view->assign('banners', $banners);
		$this->view->assign('exp', $exp);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> $this->view->url(array(), 'ad_banner_list'),
			'itemLink' 	=> (null == $params) ? 'page-%d' : 'page-%d?q='.$params,
		));
	}
}
