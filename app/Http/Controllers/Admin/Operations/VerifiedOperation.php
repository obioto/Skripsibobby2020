<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait VerifiedOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupVerifiedRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/verified', [
            'as'        => $routeName.'.verified',
            'uses'      => $controller.'@verified',
            'operation' => 'verified',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupVerifiedDefaults()
    {
        $this->crud->allowAccess('verified');

        $this->crud->operation('verified', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'verified', 'view', 'crud::buttons.verified');
            // $this->crud->addButton('line', 'verified', 'view', 'crud::buttons.verified');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function verified()
    {
        $this->crud->hasAccessOrFail('verified');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'verified '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.verified", $this->data);
    }
}
