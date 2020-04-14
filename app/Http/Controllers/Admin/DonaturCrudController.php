<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DonaturRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DonaturCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DonaturCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Donatur');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/donatur');
        $this->crud->setEntityNameStrings('donatur', 'donaturs');
        $this->crud->enableExportButtons();
        $this->crud->denyAccess(['create', 'delete']);
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns(['namaLengkap', 'jumlah','nomorTelepon','bukti','isconfirmed','isanonim']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DonaturRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
