<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
        $this->crud->denyAccess(['delete','update']);
        $this->crud->addButtonFromView('line', 'confirm', 'confirm', 'beginning');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumns([
            [
                'label' => "Username", // Table column heading
                'name'  => 'name', // The db column name
                'type'  => 'text'
            ],  
            [
                'label' => "Nama Lengkap User", // Table column heading
                'name'  => 'namaLengkap', // The db column name
                'type'  => 'text'
            ],  
            [
                'label' => "Nomor KTP User", // Table column heading
                'name'  => 'nomorKtp', // The db column name
                'type'  => 'text'
            ],  
            [
                'label' => "Nomor HP", // Table column heading
                'name'  => 'noHp', // The db column name
                'type'  => 'text'
            ],  
            [
                'label' => "Alamat User", // Table column heading
                'name'  => 'alamat', // The db column name
                'type'  => 'text'
            ],  
            [
                'name' => 'fotoKtp', // The db column name
                'label' => "Foto KTP User", // Table column heading
                'type' => 'image',
                'prefix' => '/uploads/images/fotoktp/'
            ],  
            [
                'name' => 'confirmed', // The db column name
                'label' => "Confirmed", // Table column heading
                'type' => 'boolean',
                'options' => [0 => 'Belum Verifikasi', 1 =>  'Verifikasi']
            ],      
        ]);
        //   $this->crud->setColumns(['id','role_id','namaLengkap','fotoKtp']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => 'confirmed',
            'label' => 'Confirmed',
            'type' => 'checkbox'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function confirm($id)
    {
        $this->data['confirmed'] = '1';
        
        return redirect('/admin/user');
    }
}
