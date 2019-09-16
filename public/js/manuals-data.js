$(document).ready(function () {
	if ($("#manuals_data").length) {
		var manualsMenu = new Vue({
			el: '#manuals_data',
			delimiters: ['@[[',']]@'],
			data: {
				createOrUpdate: {
					id: 0,
					title_kz: '',
					title_en: '',
					title_ru: '',
				},
				elements: [],
				langs: [],
			},

			methods: {

				/**
				 * Update table
				 * @param Event
				 * @return success
				 */
				save: function (e) {
					e.preventDefault();

					var self = this;
					var id = self.createOrUpdate.id;

					$.ajax({
							url: '/manuals/' + this.manualId + '/lists/' + this.manualChildAlias + '/data/' + id,
							type: 'PUT',
							async: false,
							dataType: 'json',
							data : {
								_token: $('meta[name="_token"]').attr('content'),
								title_ru: self.createOrUpdate.title_ru,
								title_kz: self.createOrUpdate.title_kz,
								title_en: self.createOrUpdate.title_en,
								manual_data_id: this.createOrUpdate.id
							},
							success: function(data) {
								if (data.errors) {
									messageError(data.errors);
								} else {
									messageSuccess(data.success);
									self.createOrUpdate.id = 0;
									self.createOrUpdate.title_ru = '';
									self.createOrUpdate.title_en = '';
									self.createOrUpdate.title_kz = '';
									self.getManuals();
								}
							}
					});
				},

				/**
				 * Update table
				 * @param Event
				 * @return success
				 */
				change: function (index) {
					this.createOrUpdate = this.elements[index];
				},

				/**
				 * Get data for created table
				 * @return this.names
				 */
				getManuals: function () {
					var self = this;

					$.ajax({
							url: '/manuals/' + this.manualId + '/lists/' + this.manualChildAlias + '/getManualsData',
							type: 'POST',
							async: false,
							dataType: 'json',
							data : {
								_token: $('meta[name="_token"]').attr('content')
							},
							success: function(data) {
								if (data.errors) {
									messageError(data.errors);
								} else {
									self.elements = data.elements;
									self.langs = data.langs;
									console.log(self.elements);
								}
							}
					});
				},

				/**
				 * destroy data for manuals
				 * @return this.names
				 */
				deleteManuals: function (index) {
					var self = this;
					var id = self.elements[index].id ;
					console.log(id);
					$.ajax({
							url: '/manuals/' + this.manualId + '/lists/' + this.manualChildAlias + '/data/' + id,
							type: 'DELETE',
							async: false,
							dataType: 'json',
							data : { _token: $('meta[name="_token"]').attr('content')},
							success: function(data) {
								if (data.success) {
									self.elements.splice(index, 1) ;
									messageSuccess(data.success);
								} else {
									messageError(data.errors);
								}
							}
					});
				},

				cancel: function () {
					this.createOrUpdate.id = 0;
					this.createOrUpdate.title_ru = '';
					this.createOrUpdate.title_en = '';
					this.createOrUpdate.title_kz = '';
				}

			},

			mounted: function () {
				this.$nextTick(function () {
					this.manualId = $("#manual_id").val();
					this.manualChildAlias = $("#manual_child_alias").val();
						this.getManuals();
				});
			}

		});
	}

});
