@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/confirm') }} " class="btn btn-xs btn-default"><i class="fa fa-ban"></i> Confirmed</a>
@endif