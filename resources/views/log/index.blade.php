@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('log.index'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
   				<div class="panel-heading">
					<h3 class="panel-title">Фильтры</h3>
				</div>
				<div class="panel-body no-padding">
					<form method="POST" action="/log">
						{{ csrf_field() }}
						<table class="table">
							<thead>
								<tr>
									<th>Дата начала</th>
									<th>Дата окончания</th>
									<th>Оператор</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="input-group date" id="filter_date_from">
											<input type="text" name="filter_date_from" value="@if (!empty($request->filter_date_from) && $request->filter_date_from){{ $request->filter_date_from }}@endif" class="form-control">
											<span class="input-group-addon">
                        						<span class="glyphicon glyphicon-calendar"></span>
                    						</span>
										</div>
									</td>
									<td>
										<div class="input-group date" id="filter_date_to">
											<input type="text" name="filter_date_to" value="@if (!empty($request->filter_date_to) && $request->filter_date_to){{ $request->filter_date_to }}@endif" class="form-control">
											<span class="input-group-addon">
                        						<span class="glyphicon glyphicon-calendar"></span>
                    						</span>
										</div>
									</td>
									<td>
										<select name="filter_user" class="form-control">
											<option value="">---</option>
											@if (count($users) > 0)
									        	@foreach ($users as $user)
													<option value="{{ $user->name }}" @if (!empty($request->filter_user) && $request->filter_user == $user->name) selected @endif>{{ $user->name }}</option>
									      		@endforeach
											@endif
										</select>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5" style="text-align:center;">
										<br>
										<button class="btn btn-primary">Поиск</button>
										<button type="button" class="btn btn-primary" onClick="window.location.href='/log';">Сбросить</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</form>
				</div>
			</div>

			<div class="panel">
   				<div class="panel-heading">
					<h3 class="panel-title">Лог доступа</h3>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID #</th>
								<th>Операция</th>
								<th>Пользователь</th>
								<th>Дата</th>
							</tr>
						</thead>
						<tbody>
							@if (count($logs))
								@foreach ($logs->all() as $log)
									<tr class="doc_row">
										<td>{{ $log->id }}</td>
										<td>{{ $operations_arr[$log->operation_id] }}</td>
										<td>{{ $log->user_name }}</td>
										<td>{{ $log->created_at }}</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
					{{ $logs->appends(['filter_date_from' => $request->filter_date_from, 'filter_date_to' => $request->filter_date_to, 'filter_user' => $request->filter_user])->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
