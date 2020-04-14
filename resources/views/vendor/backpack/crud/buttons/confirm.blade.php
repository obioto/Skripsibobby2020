@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/confirm') }}" class="btn btn-sm btn-link"><i class="fa fa-check-circle-o"></i>Confirm</a>
@endif