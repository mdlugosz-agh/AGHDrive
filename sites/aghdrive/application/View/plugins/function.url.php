<?php
function smarty_function_url(array $params, Smarty_Internal_Template $template)
{
	if (empty($params[ 'controller' ])) {
		trigger_error("url: missing 'controller' parameter", E_USER_WARNING);
		return;
	}
	
	$controller = $params['controller'];
	unset($params['controller']);
	
	return App::url($controller, $params);
}