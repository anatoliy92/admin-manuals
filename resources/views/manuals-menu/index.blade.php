@extends('avl.default')

@section('main')
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Меню справочников
		</div>

		<div class="card-body" id="manuals-menu">

			<div class="row">
				<div class="col-12 pb-2 mb-2 mt-2">
					<ul class="list-group">

						<li class="list-group-item p-1 pl-3" v-for="(element, index) in elements">
							<div class="row">
								<div class="col-5">@[[ element.title ]]@</div>
								<div class="col-5">
									<a :href="'/manuals/' + element.id + '/lists'">/manuals/@[[ element.id ]]@/lists</a>
								</div>
								<div class="col-2">
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
					  <input type="text" class="form-control" v-model="createOrUpdate.title" placeholder="Добавить пункт">
					  <div class="input-group-append">
					    <button class="btn btn-success" type="button" v-on:click="save"><i class="fa fa-floppy-o"></i></button>
					  </div>
					</div>
				</div>
			</div>

		</div>

		<div class="card-footer position-relative">
			<i class="fa fa-align-justify"></i> Меню справочников
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('avl/js/vue.min.js') }}" charset="utf-8"></script>
	<script src="{{ asset('vendor/adminmanuals/js/manuals-menu.js') }}" charset="utf-8"></script>
@endsection
