<?php
/**
 * WebMath
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    WebMath
 * @subpackage User API
 */

/**
 * WebMath User API
 */
class WebMath_API_User extends Zikula_AbstractApi
{
	/**
	 * @brief Preparing number
	 * @param see form: WebMath_Form_Handler_User_CalcAcceleration
	 * @return int or empty string
	 * @ported from the old webmath module
	 *
	 * This function is preparing the numbers for the function rightangeledtriangle
	 *
	 *
	 * @author Leonard Marschke
	 * @version 2.0
	 */
	public function preparenumber($numberg)
	{
		$numberr = (int)str_replace(',', '.', $numberg);
		if($numberr == 0)
			$numberr = "";
		return $numberr;
	}
}
