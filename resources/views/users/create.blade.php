@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('users.create'))

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
					<h3 class="panel-title">Создание записи</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/users">
						<input type="hidden" name="page" value="{{ $request->page }}">
						{{ csrf_field() }}
        				<div class="form-group">
	       					<span>Наименование</span>
							<input type="text" name="name" @if (old('name')) value="{{ old('name') }}" @endif class="form-control">
						</div>
        				<div class="form-group">
	       					<span>СНИЛС</span>
							<input type="text" name="snils" @if (old('snils')) value="{{ old('snils') }}" @endif class="form-control snils">
						</div>
        				<div class="form-group">
	       					<span>ОГРН</span>
							<input type="text" name="ogrn" @if (old('ogrn')) value="{{ old('ogrn') }}" @endif class="form-control ogrn">
						</div>
						<label class="fancy-checkbox">
							<input type="hidden" name="admin" value="0">
							<input type="checkbox" name="admin" value="1" checked>
							<span>Администратор</span>
						</label>
						<label class="fancy-checkbox">
							<input type="hidden" name="enable" value="0">
							<input type="checkbox" name="enable" value="1" checked>
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
