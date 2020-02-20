@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('templates.index', $doctype))

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
					<h3 class="panel-title">Шаблоны "@if (!Session::has('archive')){{ $doctype->name }}@elseАрхив Оферт@endif"</h3>
					<div class="right">
						<div class="col-md-6 text-right">
							<a href="/templates/{{ $doctypes_id }}/create?page={{ $request->page }}" class="btn btn-success btn-sm"><i class="fa fa-plus-square-o"></i> Создать шаблон</a>
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
								{{--<th class="text-center">Активность</th>--}}
								<th class="text-center">Действие</th>
							</tr>
						</thead>
						<tbody>
							@if (count($templates))
								@foreach ($templates as $template)
									@if (!Session::has('archive'))
										@if (!$template->enable && !$template->enable_closed)
											@continue
										@endif
									@else
										@if ($template->enable || $template->enable_closed)
											@continue
										@endif
									@endif
									<form method="POST" action="/templates/{{ $doctypes_id }}/{{ $template->id }}?page={{ $request->page }}" onsubmit="if(confirm('Вы уверены?')) return true; else return false;">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<tr>
											<td>{{ $template->id }}</td>
											<td>{{ $template->name }}</td>
											<td>
												@if (count($doctypes) > 0)
													@foreach ($doctypes->all() as $doctype)
														@if ($doctype->id == $template->doctypes_id) {{ $doctype->name }} @endif
													@endforeach
												@endif
											</td>
											{{--<td class="text-center">@if ($template->enable == 1) Да @else Нет @endif</td>--}}
											<td nowrap class="text-center">
												<a href="/templates/{{ $doctypes_id }}/{{ $template->id }}/edit?page={{ $request->page }}" class="btn btn-default btn-sm">Изменить</a>
												{{--<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Удалить</button>--}}
											</td>
										</tr>
									</form>
								@endforeach
							@endif
						</tbody>
					</table>
					{{ $templates->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
