<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\ModelCore;

class ControllerCore extends Controller
{
	public function setDisable (ModelCore $model)
	{
		return $model->disable();
	}

	public function setEnable (ModelCore $model)
	{
		return $model->enable();
	}
}
