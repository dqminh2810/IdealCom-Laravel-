<?php

/**
 * @param string $route
 * @param array $col
 * @return string
 */
function datatable($route, $col, $options = null)
{
    return \Modules\Core\Helpers\DatatablesHelper::datatable($route, $col, $options);
}

/**
 * @return string
 */
function actions_groupe_html()
{
	return \Modules\Core\Helpers\DatatablesHelper::action_groupe_html();
}

/**
 * @param string $model
 * @param string $options
 * @return string
 */
function actions_groupe_js($model, $options = "")
{
	return \Modules\Core\Helpers\DatatablesHelper::action_groupe_js($model, $options);
}

/**
 * @param string $uuid
 * @param string $method
 * @param bool $backoffice
 * @param int $answer_id
 * @return string
 */
function formbuilder($uuid, $method = "POST", $backoffice = false, $answer_id = null)
{
	return \Modules\Formulaires\Helpers\FormulairesHelper::formbuilder($uuid, $method,  $backoffice, $answer_id);
}

/**
 * @param string $json
 * @return string
 * @throws Exception
 */
function prettify(string $json): string
{
	return \PHPUnit\Util\Json::prettify($json);
}
