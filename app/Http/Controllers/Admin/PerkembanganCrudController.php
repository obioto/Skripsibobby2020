<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PerkembanganRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PerkembanganCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PerkembanganCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Perkembangan');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/perkembangan');
        $this->crud->setEntityNameStrings('perkembangan', 'perkembangans');
        $this->crud->enableExportButtons();
        $this->crud->denyAccess(['create', 'delete']);
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->setColumns(['id_konten','judul','deskripsi','gambar','pengeluaran']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PerkembanganRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
