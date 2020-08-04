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
        $this->crud->addColumns([
            [
                'label' => "Nama Lengkap", // Table column heading
                'name'  => 'namaLengkap', // The db column name
                'type'  => 'text'
            ],
            [
                'label' => "Jumlah", // Table column heading
                'name'  => 'jumlah', // The db column name
                'type'  => 'text'
            ],
            [
                'label' => "Nomor Telepon", // Table column heading
                'name'  => 'nomorTelepon', // The db column name
                'type'  => 'text'
            ],
            [
                'label' => "Bukti Transaksi", // Table column heading
                'name' => 'bukti', // The db column name
                'type' => 'image',
                'prefix' => '/uploads/images/buktitransfer/',
            ],
            [
                'name' => 'isconfirmed', // The db column name
                'label' => "Status Donasi", // Table column heading
                'type' => 'boolean',
                'options' => [0 => 'Belum Verifikasi', 1 =>  'Verifikasi']
            ],  
            [
                'name' => 'isanonim', // The db column name
                'label' => "Status Anonim", // Table column heading
                'type' => 'boolean',
                'options' => [0 => 'Tidak', 1 =>  'Ya']
            ],  
        ]);

        // $this->crud->setColumns(['namaLengkap', 'jumlah','nomorTelepon','bukti','isconfirmed','isanonim']);
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
