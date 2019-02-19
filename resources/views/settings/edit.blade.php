@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('settings.edit', $setting))

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
					<h3 class="panel-title">Настройки</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/settings/{{ $setting['id'] }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<span>{{ $setting['descr'] }}</span>
						<select name="value" class="form-control">
							<option value="">---</option>
							@if (count($posible_values_arr) > 0)
								@foreach ($posible_values_arr as $value)
									<option value="{{ $value }}" @if (old('value') == $value) selected @elseif ($setting['value'] == $value) selected @endif>{{ $value }} {{ $setting['unit'] }}</option>
								@endforeach
							@endif
						</select>
						<br>
						<div class="text-center">
							<button class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
