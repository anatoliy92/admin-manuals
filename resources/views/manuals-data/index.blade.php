@extends('avl.default')

@section('main')
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Справочник <b>[{{ $manual->title }}]->[{{ $manual_child->title }}]</b>
		</div>

		<div class="card-body" id="manuals_data">

			<input type="hidden" name="manual_id" value="{{ $manual->id }}" id="manual_id">
			<input type="hidden" name="manual_child_alias" value="{{ $manual_child->alias }}" id="manual_child_alias">

			<div class="row">
				<div class="col-12 pb-2 mb-2 mt-2">
					<ul class="list-group">
						<li class="list-group-item p-1 pl-3">
							<div class="row">
								<div class="col-3" v-for="(lang, index) in langs">@[[  lang.name ]]@</div>
								<div class="col-3"></div>
							</div>
						</li>
						<li class="list-group-item p-1 pl-3" v-for="(element, index) in elements">
							<div class="row">
								<div class="col-3" v-for="(lang, index) in langs">@[[ element['title_' + lang.key] ]]@</div>
								<div class="col-3">
									<div class="btn-group btn-group-sm pull-right" role="group" aria-label="First group">
										<button class="btn btn-success" type="button" v-on:click="change(index)"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger" type="button" v-on:click="deleteManuals(index)"><i class="fa fa-trash"></i></button>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</div>
				<div class="col-12">
					<div class="input-group mb-3">
						 <input type="text" class="form-control" v-for="(lang, index) in langs" v-model="createOrUpdate['title_' + lang.key]" placeholder="Имя пункта">
						<div class="input-group-append">
							<button class="btn btn-success" type="button" v-on:click="save"><i class="fa fa-floppy-o"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer position-relative">
			<i class="fa fa-align-justify"></i> Справочник <b>[{{ $manual->title }}]->[{{ $manual_child->title }}]</b>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('avl/js/vue.min.js') }}" charset="utf-8"></script>
	<script src="{{ asset('vendor/adminmanuals/js/manuals-data.js') }}" charset="utf-8"></script>
@endsection
