<?php
/**
 * WebMath
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    WebMath
 * @subpackage Version
 */

/**
 * WebMath User controller
 */
class WebMath_Controller_User extends Zikula_AbstractController
{
	public function calcAcceleration()
	{
		//Security check
		if (!SecurityUtil::checkPermission('WebMath::calcAcceleration', '::', ACCESS_COMMENT)) {
			return LogUtil::registerPermissionError();
		}
		
		//Initialise form
		$form = FormUtil::newForm('WebMath', $this);
		
		return $form->execute('User/CalcAcceleration.tpl', new WebMath_Form_Handler_User_CalcAcceleration());
	}
}
