@extends('avl.default')

@section('main')
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Меню справочников
		</div>

		<div class="card-body" id="manuals-menu">

			<div class="row">
				<div class="col-12 pb-2 mb-2 mt-2">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="50" class="text-center align-middle">#</th>
								<th width="50" class="text-center align-middle">Вкл Выкл</th>
								<th class="text-center align-middle">Наименование справочника</th>
								<th class="text-center align-middle" style="width: 100px;">Действие</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(element, index) in elements">
								<td class="text-center">@[[ index + 1 ]]@</td>
								<td class="text-center">
									<a class="change--status" href="#" :data-id="element.id" data-model="Avl\AdminManuals\Models\Manuals">
										<i v-if="element.good" class="fa fa-eye"></i>
										<i v-else class="fa fa-eye-slash"></i>
									</a>
								</td>
								<td>@[[ element.title_ru ]]@</td>
								<td class="text-center">
									<div class="btn-group btn-group-sm pull-right" role="group" aria-label="First group">
										<button class="btn btn-success" type="button" v-on:click="change(index)"><i class="fa fa-pencil"></i></button>
										<a class="btn btn-info" :href="'/manuals/' + element.id + '/lists'" ><i class="fa fa-eye"></i></a>
										<button class="btn btn-danger" type="button" v-on:click="confirmDelete(index)"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td class="p-0" colspan="3"><input type="text" class="form-control border-0" v-model="createOrUpdate.title_ru" placeholder="Добавить пункт"></td>
								<td class="text-center p-0">
							    <button class="btn btn-success btn-block" type="button" v-on:click="save"><i class="fa fa-floppy-o"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
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
