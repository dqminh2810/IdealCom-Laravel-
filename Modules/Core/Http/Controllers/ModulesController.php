<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
    		$modules = [];
				foreach (Module::allEnabled() as $module=>$value) {
					array_push($modules, array('name'=>$module, 'enabled'=>1));
				}
    		foreach (Module::allDisabled() as $module=>$value) {
    			array_push($modules, array('name'=>$module, 'enabled'=>0));
				}
        return view('core::modules.index')->with('modules', $modules);
    }

		/**
		 * @param String $module
		 * @return int
		 */
		public function enable (String $module)
			{
				return Artisan::call('module:enable ' . $module);
			}

		/**
		 * @param String $module
		 * @return int
		 */
		public function disable (String $module)
			{
				return Artisan::call('module:disable ' . $module);
			}
	}
