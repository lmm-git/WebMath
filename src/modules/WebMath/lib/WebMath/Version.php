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
 * WebMath Version Info.
 */
class WebMath_Version extends Zikula_AbstractVersion
{
	public function getMetaData()
	{
		$meta = array();
		$meta['displayname']    = $this->__('WebMath');
		$meta['description']    = $this->__('Some interesting stuff about math');
		//! module name that appears in URL
		$meta['url']            = $this->__('WebMath');
		$meta['version']        = '0.0.1';
		$meta['core_min']       = '1.3.3';
		$meta['core_max']       = '1.3.99';


		// Permissions schema
		$meta['securityschema'] = array();

		// Module depedencies
		$meta['dependencies'] = array(
			array(	'modname'	=> 'ZjqPlot',
				'minversion'	=> '0.0.1',
				'maxversion'	=> '',
				'status'		=> ModUtil::DEPENDENCY_REQUIRED)
			);
		return $meta;
	}
}
