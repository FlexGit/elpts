@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('prefixes.index'))

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
					<h3 class="panel-title">Префиксы</h3>
					<div class="right">
						<div class="col-md-6 text-right">
							<a href="/prefixes/create?page={{ $request->page }}" class="btn btn-success btn-sm"><i class="fa fa-plus-square-o"></i> Добавить запись</a>
						</div>
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID #</th>
								<th>Наименование</th>
								<th>Тип документа</th>
								<th class="text-center">Активность</th>
								<th class="text-center">Действие</th>
							</tr>
						</thead>
						<tbody>
							@if (count($prefixes))
								@foreach ($prefixes as $prefix)
									<form method="POST" action="/prefixes/{{ $prefix->id }}?page={{ $request->page }}" onsubmit="if(confirm('Вы уверены?')) return true; else return false;">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<tr>
											<td>{{ $prefix->id }}</td>
											<td>{{ $prefix->name }}</td>
											<td>
												@if (count($doctypes) > 0)
													@foreach ($doctypes->all() as $doctype)
														@if ($doctype->id == $prefix->doctypes_id) {{ $doctype->name }} @endif
													@endforeach
												@endif
											</td>
											<td class="text-center">@if ($prefix->enable == 1) Да @else Нет @endif</td>
											<td class="text-center">
												<a href="/prefixes/{{ $prefix->id }}/edit?page={{ $request->page }}" class="btn btn-default btn-sm">Изменить</a>
												{{--<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Удалить</button>--}}
											</td>
										</tr>
									</form>
								@endforeach
							@endif
						</tbody>
					</table>
					{{ $prefixes->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
