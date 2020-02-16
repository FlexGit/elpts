@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('aliases.edit', $doctype, $template, $doctypes_id, $templates_id, $docsFieldsArr, $docs_fields_id))

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
				    	<ul>
				        	@foreach ($errors->all() as $error)
				        		<li>{{ $error }}</li>
				      		@endforeach
				    	</ul>
				  	</div>
				@endif
				<div class="panel-heading">
					<h3 class="panel-title">Редактирование псевдонима поля "{{ $docsFieldsArr[$docs_fields_id] }}"</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/aliases/{{ $doctypes_id }}/{{ $templates_id }}/{{ $docs_fields_id }}">
						{{ csrf_field() }}
        				<div class="form-group">
	       					<span>Псевдоним</span>
							<input type="text" name="alias" value="@if (old('alias')){{ old('alias') }}@else{{ $aliases[$docs_fields_id]['name'] }}@endif" class="form-control">
						</div>
						<div class="text-center">
							<button class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
