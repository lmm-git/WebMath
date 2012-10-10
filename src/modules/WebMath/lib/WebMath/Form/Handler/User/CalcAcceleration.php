<?php
class WebMath_Form_Handler_User_CalcAcceleration extends Zikula_Form_AbstractHandler
{
	/**
	 * Setup form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function initialize(Zikula_Form_View $view)
	{
		$this->view->caching = true;
	}
	
	
	/**
	 * Handle form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @param $args
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function handleCommand(Zikula_Form_View $view, &$args)
	{
		//Security check
		if (!SecurityUtil::checkPermission('WebMath::calcAcceleration', '::', ACCESS_COMMENT)) {
			return LogUtil::registerPermissionError();
		}

		if ($args['commandName'] == 'cancel') {
			return true;
		}


		// check for valid form
		if (!$view->isValid()) {
			return false;
		}
		$data = $view->getValues();


		
		return true;
	}
}
