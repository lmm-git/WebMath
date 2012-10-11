<?php
/**
 * WebMath
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    WebMath
 * @subpackage User controller
 */

/**
 * WebMath User controller
 */
class WebMath_Controller_User extends Zikula_AbstractController
{
	/**
	 * @brief Main function
	 * @return string User/Main.tpl
	 *
	 * This function returns an overview about all avaiable functions
	 *
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function main()
	{
		//Security check
		if (!SecurityUtil::checkPermission('WebMath::calcAcceleration', '::', ACCESS_COMMENT)) {
			return LogUtil::registerPermissionError();
		}
		
		
		return $this->view->fetch('User/Main.tpl');
	}
	
	
	/**
	 * @brief Calculating acceleration
	 * @param see form: WebMath_Form_Handler_User_CalcAcceleration
	 * @return string User/CalcAcceleration.tpl
	 *
	 * This function is computing something about accelerations and draw the results as graph (with ZjqPlot)
	 *
	 *
	 * @author Leonard Marschke
	 * @version 0.9
	 */
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
	
	/**
	 * @brief Converting numbers
	 * @param complete handled by form
	 * @return string User/Numconvert.tpl
	 * @ported from the old webmath module
	 *
	 * This function is computing a number from one system to another.
	 *
	 *
	 * @author Leonard Marschke
	 * @version 2.0
	 */
	public function numConvert()
	{
		if (!SecurityUtil::checkPermission('webmath::', '::', ACCESS_COMMENT)) {
			return LogUtil::registerPermissionError(pnConfigGetVar());
		}
		$number = FormUtil::getPassedValue('number', '', 'POST');
		$this->view->assign('number', $number);
		$format_given = (int)FormUtil::getPassedValue('format_given', '', 'POST');
		if($format_given != 0)
			$this->view->assign('format_given', $format_given);
		$format_wanted = (int)FormUtil::getPassedValue('format_wanted', '', 'POST');
		if($format_wanted != 0)
			$this->view->assign('format_wanted', $format_wanted);
		$tries = FormUtil::getPassedValue('tries', '', 'POST');

		//fatal Error = false
		$ferror = false;

		if($number == "" && $tries == 1)
		{
			LogUtil::registerError($this->__('Please give a number to convert!'), null, '');
			$ferror = true;
		}

		if($format_given == "" && $tries == 1)
		{
			LogUtil::registerError($this->__('Please give me the format of your number!'), null, '');
			$ferror = true;
		}

		if($format_wanted == "" && $tries == 1)
		{
			LogUtil::registerStatus($this->__('Please note, that you can give your own output format'), null, '');
		}

		if(($format_given > 36 || $format_given < 2 || ($format_wanted < 2 && $format_wanted != "") || $format_wanted > 36) && $tries == 1 && $ferror == false)
		{
			LogUtil::registerError($this->__('Please note that we can only compute formats between 2 and 36!'), null, '');
			$ferror = true;
		}

		if($format_wanted != "" && $tries == 1 && $ferror == false)
		{
			$result = '<li>' . $this->__('Your defined format') . ' (' . $format_wanted . '): ' . strToUpper(base_convert($number, $format_given, $format_wanted)) . '</li>';
		}

		if($ferror == false && $tries == 1)
		{
			$result .= '<li>'.$this->__('Binary').' (2): ' . base_convert($number, $format_given, 2) . '</li>';
			$result .= '<li>'.$this->__('Octal').' (8): ' . base_convert($number, $format_given, 8) . '</li>';
			$result .= '<li>'.$this->__('Decimal').' (10): ' . base_convert($number, $format_given, 10) . '</li>';
			$result .= '<li>'.$this->__('Hexadecimal').' (16): ' . strToUpper(base_convert($number, $format_given, 16)) . '</li>';
		}

		$this->view->assign('results', $result);

		return $this->view->fetch('User/Numconvert.tpl');
	}
	
	
	/**
	 * @brief Compute a rightangeled triangle
	 * @param complete handled by form
	 * @return string User/RightAngeledTriangle.tpl
	 * @ported from the old webmath module
	 *
	 * This function is computing all possible values of a right angeled triangle.
	 *
	 *
	 * @author Leonard Marschke
	 * @version 2.0
	 */
	public function rightAngledTriangle()
	{
		if (!SecurityUtil::checkPermission('webmath::', '::', ACCESS_COMMENT)) {
			return LogUtil::registerPermissionError(pnConfigGetVar());
		}
		$this->view->assign('title', __('Compute something about a right-angled triangle'));
		//set fatal error false
		$ferror = false;
		$tries = FormUtil::getPassedValue('tries', '', 'POST');
		//Sytax = a = angle b = beta or c = gamma
		$ab = ModUtil::apiFunc('WebMath','User','preparenumber', FormUtil::getPassedValue('beta', '', 'POST'));
		$this->view->assign('beta', $ab);
		if(($ab < 1 || $ab > 89) && $ab != "")
		{
			LogUtil::RegisterError(__('Please not that your values are not possible!').' (&beta; < 1&deg; '.__('or').' &beta; > 89&deg;)');
			$ferror = true;
		}
		$ac = ModUtil::apiFunc('WebMath','User','preparenumber', FormUtil::getPassedValue('gamma', '', 'POST'));
		$this->view->assign('gamma', $ac);
		if(($ac < 1 || $ac > 89) && $ac != "")
		{
			LogUtil::RegisterError(__('Please not that your values are not possible!').' (&gamma; < 1&deg; '.__('or').' &gamma; > 89&deg;)');
			$ferror = true;
		}
		//Syntax = s = side a = a or b = b or c = c
		$sa = ModUtil::apiFunc('WebMath','User','preparenumber', FormUtil::getPassedValue('sa', '', 'POST'));
		$this->view->assign('sa', $sa);
		if($sa != "" && $sa <= 0)
		{
			LogUtil::RegisterError(__('Please not that your values are not possible!').' (a > 0)');
			$ferror = true;
		}
		$sb = ModUtil::apiFunc('WebMath','User','preparenumber', FormUtil::getPassedValue('sb', '', 'POST'));
		$this->view->assign('sb', $sb);
		if($sb != "" && $sb <= 0)
		{
			LogUtil::RegisterError(__('Please not that your values are not possible!').' (b > 0)');
			$ferror = true;
		}
		$sc = ModUtil::apiFunc('WebMath','User','preparenumber', FormUtil::getPassedValue('sc', '', 'POST'));
		$this->view->assign('sc', $sc);
		if($sc != "" && $sc <= 0)
		{
			LogUtil::RegisterError(__('Please not that your values are not possible!').' (c > 0)');
			$ferror = true;
		}
	
	
	
		//Computing section
		//Angles
		if($ab == "" && $ac != "")
			$ab = 90-$ac;
		
		if($ac == "" && $ab != "")
			$ac = 90-$ab;
	
		//from side b and angle betta to side a
		if($sa == "" && $sb != "" && $ab != "")
			$sa = $sb/sin(deg2rad($ab));	

		//from side b and angle gamma to side a
		if($sa == "" && $sb != "" && $ac != "")
			$sa = $sb/sin(deg2rad($ac));

		//from side c and angle betta to side a
		if($sa == "" && $sc != "" && $ab != "")
			$sa = $sc/sin(deg2rad($ab));	
	
		//from side c and angle gamma to side a
		if($sa == "" && $sc != "" && $ac != "")
			$sa = $sc/sin(deg2rad($ac));
	
		//some with side a
		if($sb == "" && $ab != "" && $sa != "")
			$sb = sin(deg2rad($ab))*$sa;
		
		if($sc == "" && $ab != "" && $sa != "")
			$sc = cos(deg2rad($ab))*$sa;
		
		if($sb == "" && $ac != "" && $sa != "")
			//$sb = cos(deg2rad($ac))*$sa;
	
		if($sc == "" && $ac != "" && $sa != "")
			$sc = sin(deg2rad($ac))*$sa;
	
		//if all sucks: Pythagoras!
		if($sa == "" && $sb != "" && $sc != "")
			$sa = sqrt(pow($sb, 2)+pow($sc, 2));
		
		if($sb == "" && $sa != "" && $sc != "")
			$sb = sqrt(pow($sa, 2)-pow($sc, 2));
		
		if($sc == "" && $sa != "" && $sb != "")
			$sc = sqrt(pow($sa, 2)-pow($sb, 2));
		
		//some further angles
		if($sa != "" && $sb != "")
			{
			if($ab == "")
				$ab = rad2deg(asin($sb/$sa));
			if($ac == "")
				$ac = rad2deg(acos($sb/$sa));
			}
		
	
	
		//Computing check section
		if(($ab+$ac < 89 || $ab+$ac > 91) && $ab != "" && $ac != "")
		{
			LogUtil::RegisterError(__('Computing error! The results of the angles looks like not valid! Please check your data. If your data is correct please contact the site admin.').' ('.$ab.'&deg; + '.$ac.'&deg; + 90&deg; != 180&deg;)');
			$ferror = true;
		}
	
		if(round(pow($sa, 2), 1) != round(pow($sb, 2)+pow($sc ,2), 1) && $sa != "" && $sb != "" && $sc != "" && $ferror == false)
		{
			LogUtil::RegisterError(__('Computing error! The results of the sides looks like not valid! Please check your data. If your data is correct please contact the site admin.'));
			//$ferror = true;
		}
	

	
		//Output section
		if($ab == "")
			$result .= '<li>&beta; '.__('is not computable').'</li>';
		else
			$result .= '<li>&beta; = '.$ab.'&deg;</li>';
		
		if($ac == "")
			$result .= '<li>&gamma; '.__('is not computable').'</li>';
		else
			$result .= '<li>&gamma; = '.$ac.'&deg;</li>';
	
		if($sa == "")
			$result .= '<li>a '.__('is not computable').'</li>';
		else
			$result .= '<li>a = '.$sa.'</li>';
		
		if($sb == "")
			$result .= '<li>b '.__('is not computable').'</li>';
		else
			$result .= '<li>b = '.$sb.'</li>';
		
		if($sc == "")
			$result .= '<li>c '.__('is not computable').'</li>';
		else
			$result .= '<li>c = '.$sc.'</li>';
		
		//finally output
		if($ferror != true && $tries != "")
			$this->view->assign('result', $result);
	
		return $this->view->fetch('User/RightAngledTriangle.tpl');
	}
}
