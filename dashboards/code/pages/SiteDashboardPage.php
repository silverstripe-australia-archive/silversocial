<?php

/**
 * @author marcus@symbiote.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class SiteDashboardPage extends Page {
	
}

class SiteDashboardPage_Controller extends DashboardController {

	public static $allowed_actions = array(
		
	);

	public static $dependencies = array(
		'dataService'		=> '%$DataService',
	);
	
	public function init() {
		parent::init();
		
		Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery-ui/jquery-ui.js'); // -1.8.5.custom.min.js');
		Requirements::css('dashboards/thirdparty/aristo/aristo.css');
		
		if (class_exists('WebServiceController')) {
			Requirements::javascript('webservices/javascript/webservices.js');
		}
	}
	

	/**
	 * Overridden to make sure the dashboard page is attached to the correct controller
	 * @return type 
	 */
	protected function getRecord() {
		$id = (int) $this->request->param('ID'); 
		if (!$id) {
			$id = (int) $this->request->requestVar('ID');
		}
		if ($id) {
			$item = $this->dataService->byId($this->stat('model_class'), $id);
			if ($item instanceof DashboardPage) {
				$item->setController($this);
			}

			return $item;
		}
	}
	
	public function Link($action = null) {
		$dashboard = $this->currentDashboard;

		if($dashboard && $dashboard->URLSegment != 'main') {
			$identifier = Member::get_unique_identifier_field();
			$identifier = $dashboard->Owner()->$identifier;
			
			return Controller::join_links(
				$this->data()->Link(true), 'user', $identifier, $dashboard->URLSegment, $action
			);
		} else {
			return $this->data()->Link($action ? $action : true);
		}
	}
}