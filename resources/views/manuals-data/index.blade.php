@extends('avl.default')

@section('main')
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Справочник <b>[{{ $manual->title }}]->[{{ $manual_child->title }}]</b>
		</div>

		<div class="card-body table-responsive" id="manuals_data">

			<input type="hidden" name="manual_id" value="{{ $manual->id }}" id="manual_id">
			<input type="hidden" name="manual_child_alias" value="{{ $manual_child->alias }}" id="manual_child_alias">

			<div class="row">
				<div class="col-12 pb-2 mb-2 mt-2">
					<table class="table table-bordered">
					<thead>
						<tr>
							<th width="50" class="text-center">ID</th>
							<th v-for="(lang, index) in langs">@[[  lang.name ]]@</th>
							<th class="text-center" style="width: 100px;">Действие</th>
						</tr>
					</thead>
					<tbody>
						<tr class="position-relative" v-for="(element, index) in elements">
							<td>@[[ element['id'] ]]@</td>
							<td v-for="(lang, index) in langs"> @[[ element['title_' + lang.key] ]]@ </td>
							<td>
								<div class="btn-group btn-group-sm pull-right" role="group" aria-label="First group">
									<button class="btn btn-success" type="button" v-on:click="change(index)"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-danger" type="button" v-on:click="deleteManuals(index)"><i class="fa fa-trash"></i></button>
								</div>
							</td>
						</tr>
						<tr>
							<td>#</td>
							<td v-for="(lang, index) in langs">
								<input type="text" class="form-control" v-model="createOrUpdate['title_' + lang.key]" placeholder="Имя пункта">
							</td>
							<td class="text-center">
								<div class="btn-group btn-group-sm pull-right" role="group" aria-label="First group">
									<button class="btn btn-success" type="button" v-on:click="save"><i class="fa fa-floppy-o"></i></button>
									<button class="btn btn-danger" type="button" v-on:click="cancel"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script src="{{ asset('avl/js/vue.min.js') }}" charset="utf-8"></script>
	<script src="{{ asset('vendor/adminmanuals/js/manuals-data.js') }}" charset="utf-8"></script>
@endsection
