@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('okopfs.edit', $okopf))

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
					<h3 class="panel-title">Редактирование записи #{{ $okopf['id'] }}</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/okopfs/{{ $okopf['id'] }}">
						<input type="hidden" name="page" value="{{ $request->page }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
        				<div class="form-group">
	       					<span>Код</span>
							<input type="text" name="id" value="@if (old('id')){{ old('id') }}@else{{ $okopf['id'] }}@endif" class="form-control">
						</div>
        				<div class="form-group">
	       					<span>Наименование</span>
							<input type="text" name="name" value="@if (old('name')){{ old('name') }}@else{{ $okopf['name'] }}@endif" class="form-control">
						</div>
						<label class="fancy-checkbox">
							<input type="hidden" name="enable" value="0">
							<input type="checkbox" name="enable" value="1" @if ($okopf['enable'] == 1) checked @endif>
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
