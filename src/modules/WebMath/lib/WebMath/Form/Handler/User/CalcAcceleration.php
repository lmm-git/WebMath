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
		
		//if all required data given
		if($data['cw'] != '' && $data['density'] != '' && $data['area'] != '' && $data['mass'] != '')
		{
			//Push first item
			$value['0'] = '0';
			//i = 0.05 because first item was already pushed
			for($i = 0.05; $i < $data['time']; $i += 0.05)
			{
				//calculate rest of items
				$fr = ($data['mass'] * $data['acceleration']) - (0.5 * $data['cw'] * $data['density'] * $data['area'] * pow($v, 2));
				$v += $fr / $data['mass'] * 0.05;
				$s += $v * 0.05;
				$result = $s;
				//push result to value
				$value[(string)$i] = $result;
			}
		}
		else
			//easier computation
			for($i = 0; $i < $data['time']; $i += 0.05)
			{
				$result = $data['acceleration'] / 2 * pow($i, 2);
			
				$value[(string)$i] = $result;
			}
		
		$view->assign('distanceValue', $value);

		$view->assign('distanceGraph', ModUtil::apiFunc('ZjqPlot', 'graph', 'lineGraph', array('data' => array(0 => $value),
			'title' => $this->__('Distance'),
			'showMarker' => false,
			'showHighlighter' => true,
			'lineWidth' => 1.8,
			'xaxisTitle' => $this->__('Time in seconds'),
			'xaxisMin' => '0',
			'yaxisTitle' => $this->__('Distance in meters'),
			'yaxisMin' => '0')));

		//Reset vars
		unset($v);
		unset($fr);
		unset($s);
		unset($value);
		unset($result);

		//if all required data given
		if($data['cw'] != '' && $data['density'] != '' && $data['area'] != '' && $data['mass'] != '')
		{
			//Push first item
			$value['0'] = '0';
			//i = 0.05 because first item was already pushed
			for($i = 0.05; $i < $data['time']; $i += 0.05)
			{
				$fr = ($data['mass'] * $data['acceleration']) - (0.5 * $data['cw'] * $data['density'] * $data['area'] * pow($v, 2));
				$v += $fr / $data['mass'] * 0.05;
				$result = $v;
				$value[(string)$i] = $result;
			}
		}
		else
			//linear speed
			for($i = 0; $i < $data['time']; $i += 0.05)
			{
				$result = $data['acceleration'] * $i;
			
				$value[(string)$i] = $result;
			}
		
		//assign for template
		$view->assign('speedValue', $value);

		//draw graph
		$view->assign('speedGraph', ModUtil::apiFunc('ZjqPlot', 'graph', 'lineGraph', array('data' => array(0 => $value),
			'title' => $this->__('Speed'),
			'showMarker' => false,
			'showHighlighter' => true,
			'lineWidth' => 1.8,
			'xaxisTitle' => $this->__('Time in seconds'),
			'xaxisMin' => '0',
			'yaxisTitle' => $this->__('Speed in m/s'),
			'yaxisMin' => '0')));

		return true;
	}
}
