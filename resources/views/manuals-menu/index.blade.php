@extends('avl.default')

@section('main')
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Manuals-menu
		</div>

		<div class="card-body" id="manuals-menu">

			<div class="row">
				<div class="col-12 pb-2 mb-2 mt-2">
					<ul class="list-group">

						<li class="list-group-item p-1 pl-3" v-for="(element, index) in elements">
							<label>@[[ element.title ]]@</label>
							<div class="btn-group btn-group-sm pull-right" role="group" aria-label="First group">
							<button class="btn btn-success" type="button" v-on:click="change(index)"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-danger" type="button" v-on:click="deleteManuals(index)"><i class="fa fa-trash"></i></button>
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
			<i class="fa fa-align-justify"></i> Manuals-menu
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('avl/js/vue.min.js') }}" charset="utf-8"></script>
	<script src="{{ asset('avl/js/modules/manuals-menu.js') }}" charset="utf-8"></script>
	<!-- <script src="{{ asset('vendor/adminpage/js/page.js') }}" charset="utf-8"></script> -->
@endsection
