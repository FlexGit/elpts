@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('email_registry.index'))

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
					<h3 class="panel-title">Реестр электронных адресов</h3>
					<div class="right">
						<form action="{{ route('emailRegistryImport') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="col-md-6 text-right">
								<input type="file" name="import_file" accept=".xlsx">
							</div>
							<div class="col-md-6 text-right">
								<button class="btn btn-success">Загрузить</button>
							</div>
						</form>
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>№ п/п</th>
								<th>E-mail</th>
							</tr>
						</thead>
						<tbody>
							@if (count($emailRegistry))
								<?php $i=1; ?>
								@foreach ($emailRegistry as $email)
									<tr>
										<td><?php echo $i; ?></td>
										<td>{{ $email->email }}</td>
									</tr>
									<?php $i++; ?>
								@endforeach
							@endif
						</tbody>
					</table>
					{{ $emailRegistry->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
