@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('aliases.index', $doctype, $template, $doctypes_id, $templates_id))

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
					<h3 class="panel-title">Псевдонимы наименований полей шаблона</h3>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped">
						<thead>
							<tr>
								{{--<th>Тип</th>--}}
								<th>Наименование поля</th>
								<th>Псевдоним</th>
								<th class="text-center">Действие</th>
							</tr>
						</thead>
						<tbody>
							@if (count($docsFields))
								@foreach ($docsFields as $docsField)
									{{--@if (!$docsField->visible) @continue @endif--}}
									<tr>
										{{--<td>@if (empty($docsField->parent_id))Заголовок@elseПоле@endif</td>--}}
										<td @if (!$docsField->parent_id && $docsField->visible)style="font-weight: bold;"@endif>{{ $docsField->name }}</td>
										<td>{{ $aliases[$docsField->id]['name'] }}</td>
										<td class="text-center">
											<a href="/aliases/{{ $doctypes_id }}/{{ $templates_id }}/{{ $docsField->id }}/edit" class="btn btn-default btn-sm">Изменить</a>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
