@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('prefixes.edit', $prefix))

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
					<h3 class="panel-title">Редактирование записи #{{ $prefix['id'] }}</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/prefixes/{{ $prefix['id'] }}?page={{ $request->page }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
        				<div class="form-group">
	       					<span>Наименование</span>
							<input type="text" name="name" value="@if (old('name')){{ old('name') }}@else{{ $prefix['name'] }}@endif" class="form-control">
						</div>
        				<div class="form-group">
	       					<span>Тип документа</span>
							<select name="doctypes_id" class="form-control">
								<option value="">---</option>
								@if (count($doctypes) > 0)
						        	@foreach ($doctypes->all() as $doctype)
										<option value="{{ $doctype->id }}" @if (old('doctypes_id') == $doctype->id) selected @elseif ($prefix['doctypes_id'] == $doctype->id) selected @endif>{{ $doctype->name }}</option>
						      		@endforeach
								@endif
							</select>
						</div>
						<label class="fancy-checkbox">
							<input type="hidden" name="enable" value="0">
							<input type="checkbox" name="enable" value="1" @if ($prefix['enable'] == 1) checked @endif>
							<span>Активность</span>
						</label>
						<div class="text-center">
							<button class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
