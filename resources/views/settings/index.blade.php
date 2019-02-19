@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('settings.index'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				@if (Session::has('success'))
      				<div class="alert alert-success">
        				{{ Session::get('success') }}
      				</div>
     			@endif
   				<div class="panel-heading">
					<h3 class="panel-title">Настройки</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li class="active">
							<a data-toggle="tab" href="#header_settings" aria-expanded="true">Параметры</a>
						</li>
						<li>
							<a data-toggle="tab" href="#header_rights" aria-expanded="false">Права доступа</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="header_settings" class="tab-pane active">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Параметр</th>
										<th>Значение</th>
										<th>Действие</th>
									</tr>
								</thead>
								<tbody>
									@if (count($settings))
										@foreach ($settings->all() as $setting)
											<tr class="doc_row">
												<td>{{ $setting->descr }}</td>
												<td>{{ $setting->value }} {{ $setting->unit }}</td>
												<td>
													<a href="/settings/{{ $setting->id }}" class="btn btn-default btn-sm">Показать</a>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
						<div id="header_rights" class="tab-pane">
							<form method="POST" action="/settings">
								{{ csrf_field() }}
	       						@if (count($docs_fields) > 0)
	       							<table class="table table-striped">
	       								<thead>
	       									<tr>
	       										<td>Поле / Роль</td>
			        							@foreach ($roles->all() as $role)
	        										<td style="text-align:center;">{{ $role->name }}</td>
			        							@endforeach
	       									</tr>
	       								</thead>
	       								<tbody>
	       									@foreach ($doctypes as $doctype)
	       										@if (!count($docs_fields[$doctype->id]))
	       											@continue
	       										@endif
	       										<tr>
	       											<td colspan="{{ count($roles) + 1 }}"><h3>{{ $doctype->name }}</h3></td>
	       										</tr>
			        							@foreach ($docs_fields[$doctype->id] as $docs_field)
		        									<tr>
		        										<td>{{ $docs_field->name }}</td>
					        							@foreach ($roles->all() as $role)
			        										<td>
			        											<select name="docs_fields{{ $docs_field->id }}_role{{ $role->id }}" class="form-control" style="width:auto;">
								        							@foreach ($rights->all() as $right)
								        								<option value="{{ $right->id }}" @if (old('docs_fields'.$docs_field->id.'_role'.$role->id) == $right->id) selected="selected" @elseif (!empty($docs_fields_roles_rights[$docs_field->id][$role->id])) @if ($docs_fields_roles_rights[$docs_field->id][$role->id] == $right->id) selected="selected" @endif @endif>{{ $right->name }}</option>
								        							@endforeach
			        											</select>
			        										</td>
					        							@endforeach
		        									</tr>
			        							@endforeach
		        							@endforeach
		        						</tbody>
	       							</table>
	       						@endif
	       						<div class="text-center">
									<button class="btn btn-primary">Сохранить</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
