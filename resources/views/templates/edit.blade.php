@extends('layouts.master')

@section('breadcrumbs', Breadcrumbs::render('templates.edit', $doctype, $template))

@section('content')
	<div class="row">
		<div class="col-md-12">
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
					<h3 class="panel-title">Редактирование шаблона "{{ $template['name'] }}"</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/templates/{{ $doctypes_id }}/{{ $template['id'] }}?page={{ $request->page }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<input type="hidden" name="doctypes_id" value="{{ $doctypes_id }}">

						<ul class="nav nav-pills">
							@if (count($template_header_fields) > 0)
								@foreach ($template_header_fields as $k => $v)
									<li class="@if ($k == '207') active @endif">
										<a data-toggle="tab" href="#header{{ $k }}" aria-expanded="@if ($k == '207') true @endif">{{ $v['short_name'] }}</a>
									</li>
					   			@endforeach
							@endif
						</ul>

						<div class="tab-content">
							@if (count($template_header_fields) > 0)
								@foreach ($template_header_fields as $k => $v)
									<div id="header{{ $k }}" class="tab-pane @if ($k == '207') active @endif">
										@switch ($k)
											@case (207)
						        				<div class="form-group">
								        			<fieldset class="well the-fieldset">
								        				<legend class="the-legend bold">Наименование <span class="red">*</span></legend>
														<input type="text" name="name" value="@if (old('name')){{ old('name') }}@else{{ $template['name'] }}@endif" class="form-control">
													</fieldset>
												</div>
												@break
											@case (199)
												<div class="form-group">
								        			<fieldset class="well the-fieldset">
								        				<legend class="the-legend bold">Отображение шаблона в открытом интерфейсе</legend>
														<label class="fancy-checkbox">
															<input type="hidden" name="enable" value="0">
															<input type="checkbox" name="enable" value="1" @if (old('enable')) checked @elseif ($template['enable']) checked @endif>
															<span>Отображать шаблон в открытом интерфейсе</span>
														</label>
													</fieldset>
												</div>
												<div class="form-group">
								        			<fieldset class="well the-fieldset">
								        				<legend class="the-legend bold">Отображение шаблона в закрытом интерфейсе</legend>
														<label class="fancy-checkbox">
															<input type="hidden" name="enable_closed" value="0">
															<input type="checkbox" name="enable_closed" value="1" @if (old('enable_closed')) checked @elseif ($template['enable_closed']) checked @endif>
															<span>Отображать шаблон в закрытом интерфейсе</span>
														</label>
													</fieldset>
												</div>
												<div class="form-group">
													<fieldset class="well the-fieldset">
														<legend class="the-legend bold">Подписание не требуется</legend>
														<label class="fancy-checkbox">
															<input type="hidden" name="no_accept" value="0">
															<input type="checkbox" name="no_accept" value="1" @if (old('no_accept')) checked @elseif ($template['no_accept']) checked @endif>
															<span>Да</span>
														</label>
													</fieldset>
												</div>
												@break
											@case (197)
				        						@if (count($users) > 0)
				        							<table class="table table-striped">
				        								<thead>
				        									<tr>
				        										<td></td>
							        							@foreach ($roles->all() as $role)
					        										<td style="text-align:center;">{{ $role->name }}</td>
							        							@endforeach
				        									</tr>
				        								</thead>
				        								<tbody>
						        							@foreach ($users->all() as $user)
					        									<tr>
					        										<td>{{ $user->name }}</td>
								        							@foreach ($roles->all() as $role)
						        										<td style="text-align:center;">
						        											<label class="fancy-checkbox">
							        											<input type="hidden" name="user{{ $user->id }}_role{{ $role->id }}" value="0">
							        											<input type="checkbox" name="user{{ $user->id }}_role{{ $role->id }}" value="1" @if (old('user'.$user->id.'_role'.$role->id)) checked @elseif ($template_users_roles[$user->id][$role->id]) checked @endif>
							        											<span></span>
							        										</label>
						        										</td>
								        							@endforeach
					        									</tr>
						        							@endforeach
						        						</tbody>
				        							</table>
				        						@endif
												@break
										@endswitch

										@if (count($template_fields) > 0)
								        	@foreach ($template_fields->all() as $template_field)
												@if ($template_field->parent_id != $k)
													@continue
												@endif
						        				<div class="form-group">
									        		@switch($template_field->type)
									        			@case('textarea')
										        			<fieldset class="well the-fieldset fieldset_template_field{{ $template_field->id }}" @if (in_array($template_field->id, array('7')) && !$template_values[6]['value']) style="display:none;" @endif>
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
								   								<textarea name="template_field{{ $template_field->id }}" class="form-control @if (!in_array($template_field->id, array('7','205'))) editor @endif">@if (old('template_field'.$template_field->id)){{ old('template_field'.$template_field->id) }}@else{{ $template_values[$template_field->id]['value']}}@endif</textarea>
								   							</fieldset>
							   								@break
									        			@case('input')
										        			<fieldset class="well the-fieldset">
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
								   								<input type="text" name="template_field{{ $template_field->id }}" class="form-control" value="@if (old('template_field'.$template_field->id)){{ old('template_field'.$template_field->id) }}@else{{ $template_values[$template_field->id]['value']}}@endif">
								   							</fieldset>
							   								@break
									        			@case('checkbox')
										        			<fieldset class="well the-fieldset">
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
																<label class="fancy-checkbox">
																	<input type="hidden" name="template_field{{ $template_field->id }}" value="0">
																	<input type="checkbox" name="template_field{{ $template_field->id }}" value="1" class="rule_show rule_template_field{{ $template_field->id }}" @if (old('template_field'.$template_field->id)) checked @elseif ($template_values[$template_field->id]['value']) checked @endif>
																	<span>Отображать</span>
																</label>
																<label class="fancy-checkbox label_rule_required" @if (!old('template_field'.$template_field->id) && !$template_values[$template_field->id]['value']) style="display:none; @endif">
																	<input type="hidden" name="required_template_field{{ $template_field->id }}" value="0">
																	<input type="checkbox" name="required_template_field{{ $template_field->id }}" value="1" class="rule_required" @if (old('required_template_field'.$template_field->id)) checked @elseif ($template_values[$template_field->id]['required']) checked @endif>
																	<span>Обязательно для заполнения</span>
																</label>
															</fieldset>
							   								@break
									        			@case('captcha')
										        			<fieldset class="well the-fieldset">
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
																<label class="fancy-checkbox">
																	<input type="hidden" name="template_field{{ $template_field->id }}" value="0">
																	<input type="checkbox" name="template_field{{ $template_field->id }}" value="1" @if (old('template_field'.$template_field->id)) checked @elseif ($template_values[$template_field->id]['value']) checked @endif>
																	<span>Отображать</span>
																</label>
															</fieldset>
							   								@break
									        			{{--@case('rule')
										        			<fieldset class="well the-fieldset">
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
																<label class="fancy-checkbox">
																	<input type="hidden" name="template_field{{ $template_field->id }}" value="0">
																	<input type="checkbox" name="template_field{{ $template_field->id }}" value="1" class="rule_template_field{{ $template_field->id }}" @if (old('template_field'.$template_field->id)) checked @elseif ($template_values[$template_field->id]['value']) checked @endif>
																	<span>Да</span>
																</label>
															</fieldset>
							   								@break--}}
									        			@case('select')
										        			<fieldset class="well the-fieldset">
										        				<legend class="the-legend bold">{{ $template_field->name }} @if( $template_field->required ) <span class="red">*</span> @endif</legend>
																<select name="template_field{{ $template_field->id }}" class="form-control">
																	<option value="">---</option>
																	@if (count($prefixes) > 0)
															        	@foreach ($prefixes->all() as $prefix)
																			<option value="{{ $prefix->id }}" @if (old('template_field'.$template_field->id) == $prefix->id) selected @elseif ($template_values[$template_field->id]['value'] == $prefix->id) selected @endif>{{ $prefix->name }}</option>
															      		@endforeach
																	@endif
																</select>
															</fieldset>
							   								@break
													@endswitch
					   							</div>
								      		@endforeach
											@if ($k == 199)
												<div class="form-group">
													<fieldset class="well the-fieldset">
														<legend class="the-legend bold">Псевдонимы наименований полей шаблона</legend>
														<a href="/aliases/{{ $doctypes_id }}/{{ $template['id'] }}" class="btn btn-primary">Псевдонимы</a>
													</fieldset>
												</div>
											@endif
										@endif
									</div>
					   			@endforeach
							@endif
						</div>
						<div class="text-center">
							<button class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
