<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PerpanjanganRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Konten;
use App\Models\Perpanjangan;
use Carbon\Carbon;

/**
 * Class PerpanjanganCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PerpanjanganCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Perpanjangan');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/perpanjangan');
        $this->crud->setEntityNameStrings('perpanjangan', 'perpanjangans');
        $this->crud->enableExportButtons();
        $this->crud->denyAccess(['create','delete','update']);
        $this->crud->addButtonFromView('line', 'Verifikasi2', 'Verifikasi2', 'beginning');
        $this->crud->addButtonFromView('line', 'Verifikasi', 'Verifikasi', 'beginning');

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumns([
            [
            'name' => 'id',
            'label' => "ID",
            'type' => 'text',
            ],
            [
                'label'     => "Nama Konten", // Table column heading
                'type'      => "select",
                'name'      => 'id_konten', // The db column name
                'entity'    => 'konten',
                'attribute' => "judul",
                'model'     => "App\Models\Konten"
            ],
            [
                'name' => 'status',
                'label' => "Status",
                'type' => 'select_from_array',
                'options' => ['verifikasi' => 'Verifikasi', 'ditolak' => 'Ditolak','diterima'=>'Diterima'],
                'allows_null' => false,
            ],
            [
                'name' => 'jumlah_hari',
                'label' => "Jumlah Hari",
                'type' => 'text',
            ],
            [
                'name' => 'alasan',
                'label' => "Alasan Perpanjangan",
                'type' => 'text',
                ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PerpanjanganRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addFields([
            [
            'name' => 'id',
            'label' => "ID",
            'type' => 'text',
            'attributes' => [
                'disabled'=>'disabled',
              ],
            ],
            [
                'label'     => "Nama Konten", // Table column heading
                'type'      => "select",
                'name'      => 'id_konten', // The db column name
                'entity'    => 'konten',
                'attribute' => "judul",
                'model'     => "App\Models\Konten",
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
            ],
            [
                'name' => 'status',
                'label' => "Status",
                'type' => 'select_from_array',
                'options' => ['verifikasi' => 'Verifikasi', 'ditolak' => 'Ditolak','diterima'=>'Diterima'],
                'allows_null' => false,
            ],
            [
                'name' => 'alasan',
                'label' => "Alasan Perpanjangan",
                'type' => 'text',
                'attributes' => [
                    'disabled'=>'disabled',
                  ],
                ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function Verifikasi($id)
    {
        if($this->data['status'] = 'verifikasi'){
            $perpanjangan = Perpanjangan::where('id',$id)->find($id);
            $konten = Konten::where('id',$perpanjangan->id_konten)->find($perpanjangan->id_konten);
            // dd($konten);
            $time = $konten->lama_donasi;
            // dd($time);
            $limit = Carbon::parse($time)->addDays($perpanjangan->jumlah_hari);
            // dd($time,$limit);
            $konten->lama_donasi = $limit;
            // dd($konten->lama_donasi);
            $perpanjangan->status = 'diterima';
            $perpanjangan->save();
            $konten->save();
            
            return redirect('/admin/perpanjangan')->with('status', 'Konten Berhasil Diperpanjang');            
        }
        else if($this->data['status'] = 'diterima'){
            return redirect('/admin/perpanjangan')->with('status', 'Konten Sudah Diperpanjang');
        }
    }

    public function Verifikasi2($id)
    {
        $this->data['status'] = 'ditolak';
    }
}
