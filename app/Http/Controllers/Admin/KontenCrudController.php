<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\KontenRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Konten;

/**
 * Class KontenCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class KontenCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Konten');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/konten');
        $this->crud->setEntityNameStrings('konten', 'kontens');
        $this->crud->enableExportButtons();
        $this->crud->denyAccess(['delete']);
        $this->crud->addButtonFromView('line', 'confirm', 'confirm', 'beginning');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumns([
            [
                'label' => "ID", // Table column heading
                'name'  => 'id', // The db column name
                'type'  => 'text'
            ],
            [
                'label'     => "Nama User", // Table column heading
                'type'      => "select",
                'name'      => 'id_konten', // The db column name
                'entity'    => 'Owner',
                'attribute' => "name",
                'model'     => "App\User"
            ],  
            [
                'label' => "Judul Konten", // Table column heading
                'name'  => 'judul', // The db column name
                'type'  => 'text'
            ],  
            [
                'name' => 'gambar', // The db column name
                'label' => "Gambar Konten", // Table column heading
                'type' => 'image',
                'prefix' => '/uploads/images/GambarKonten/',
            ],  
            [
                'name' => 'terkumpul', // The db column name
                'label' => "Terkumpul", // Table column heading
                'type' => "number",
                'prefix' => "Rp.",
                'thousands_sep' => '.',
            ],  
            [
                'name' => 'target', // The db column name
                'label' => "Target", // Table column heading
                'type' => "number",
                'prefix' => "Rp.",
                'thousands_sep' => '.',
            ],  
            [
                'name' => "lama_donasi", // The db column name
                'label' => "Lama Donasi", // Table column heading
                'type' => "date",
            ],  
            [
                'label' => "Nomor Rekening", // Table column heading
                'name'  => 'nomorRekening', // The db column name
                'type'  => 'text'
            ],
            [
                'name' => 'confirmed', // The db column name
                'label' => "Confirmed", // Table column heading
                'type' => 'boolean',
                'options' => [0 => 'Belum Verifikasi', 1 =>  'Verifikasi']
            ],      
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(KontenRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addfields([
            [
                'label'     => "Nama User", // Table column heading
                'type'      => "select",
                'name'      => 'id_user', // The db column name
                'entity'    => 'Owner',
                'attribute' => "name",
                'model'     => "App\User",
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],  
            [
                'label' => "Judul Konten", // Table column heading
                'name'  => 'judul', // The db column name
                'type'  => 'text',
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],  
            [
                'name' => 'gambar', // The db column name
                'label' => "Gambar Konten", // Table column heading
                'type' => 'image',
                // 'prefix' => '/uploads/images/GambarKonten/',
                // 'attributes' => [
                //     'disabled'=>'disabled',
                //   ],
            ],  
            [
                'name' => 'terkumpul', // The db column name
                'label' => "Terkumpul", // Table column heading
                'type' => "number",
                'prefix' => "Rp.",
                'thousands_sep' => '.',
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],  
            [
                'name' => 'target', // The db column name
                'label' => "Target", // Table column heading
                'type' => "number",
                'prefix' => "Rp.",
                'thousands_sep' => '.',
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],  
            [
                'name' => "lama_donasi", // The db column name
                'label' => "Lama Donasi", // Table column heading
                'type' => "datetime",
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],  
            [
                'label' => "Nomor Rekening", // Table column heading
                'name'  => 'nomorRekening', // The db column name
                'type'  => 'text',
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],
            [
                'name' => 'confirmed', // The db column name
                'label' => "Confirmed", // Table column heading
                'type' => 'boolean',
                'options' => [0 => 'Belum Verifikasi', 1 =>  'Verifikasi']
            ],      
        ]);
    }

    
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    
    public function confirm($id)
    {   
        $konten = Konten::where('id',$id)->find($id);
        $konten->confirmed = '1';
        $konten->save();
        
        return redirect('/admin/konten');
    }
}
