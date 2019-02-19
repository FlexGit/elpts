@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('users.index'))

@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="panel">
				@if (Session::has('success'))
      				<div class="alert alert-success">
        				{{ Session::get('success') }}
      				</div>
     			@endif
   				<div class="panel-heading">
					<h3 class="panel-title">Операторы</h3>
					<div class="right">
						<div class="col-md-6 text-right">
							<a href="/users/create?page={{ $request->page }}" class="btn btn-success btn-sm"><i class="fa fa-plus-square-o"></i> Добавить запись</a>
						</div>
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID #</th>
								<th>Наименование</th>
								<th>СНИЛС</th>
								<th>ОГРН</th>
								<th class="text-center">Администратор</th>
								<th class="text-center">Активность</th>
								<th class="text-center">Действие</th>
							</tr>
						</thead>
						<tbody>
							@if (count($users))
								@foreach ($users as $user)
									<form method="POST" action="/users/{{ $user->id }}?page={{ $request->page }}" onsubmit="if(confirm('Вы уверены?')) return true; else return false;">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->snils }}</td>
											<td>{{ $user->ogrn }}</td>
											<td class="text-center">@if ($user->admin == 1) Да @else Нет @endif</td>
											<td class="text-center">@if ($user->enable == 1) Да @else Нет @endif</td>
											<td nowrap class="text-center">
												<a href="/users/{{ $user->id }}/edit?page={{ $request->page }}" class="btn btn-default btn-sm">Изменить</a>
												<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Удалить</button>
											</td>
										</tr>
									</form>
								@endforeach
							@endif
						</tbody>
					</table>
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
