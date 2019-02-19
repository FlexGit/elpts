@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('users.edit', $user))

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
					<h3 class="panel-title">Редактирование записи #{{ $user['id'] }}</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/users/{{ $user['id'] }}">
						<input type="hidden" name="page" value="{{ $request->page }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
        				<div class="form-group">
	       					<span>Наименование</span>
							<input type="text" name="name" value="@if (old('name')){{ old('name') }}@else{{ $user['name'] }}@endif" class="form-control">
						</div>
        				<div class="form-group">
	       					<span>СНИЛС</span>
							<input type="text" name="snils" value="@if (old('snils')){{ old('snils') }}@else{{ $user['snils'] }}@endif" class="form-control snils">
						</div>
        				<div class="form-group">
	       					<span>ОГРН</span>
							<input type="text" name="ogrn" value="@if (old('ogrn')){{ old('ogrn') }}@else{{ $user['ogrn'] }}@endif" class="form-control ogrn">
						</div>
						<label class="fancy-checkbox">
							<input type="hidden" name="admin" value="0">
							<input type="checkbox" name="admin" value="1" @if ($user['admin'] == 1) checked @endif>
							<span>Администратор</span>
						</label>
						<label class="fancy-checkbox">
							<input type="hidden" name="enable" value="0">
							<input type="checkbox" name="enable" value="1" @if ($user['enable'] == 1) checked @endif>
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
