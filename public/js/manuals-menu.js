$(document).ready(function () {
	if ($("#manuals-menu").length) {
		var manualsMenu = new Vue({
			el: '#manuals-menu',
			delimiters: ['@[[',']]@'],
			data: {
				createOrUpdate: {
					id: 0,
					title_ru: '',
					good: ''
				},
				elements: []
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
							url: '/manuals-menu/' + id,
							type: 'PUT',
							async: false,
							dataType: 'json',
							data : {
								_token: $('meta[name="_token"]').attr('content'),
								title_ru: self.createOrUpdate.title_ru,
							},
							success: function(data) {
								if (data.errors) {
									messageError(data.errors);
								} else {
									messageSuccess(data.success);
									self.createOrUpdate.id = 0;
									self.createOrUpdate.title_ru = '';
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
							url: '/manuals-menu/getManuals',
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

					$.ajax({
							url: '/manuals-menu/' + id,
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

				confirmDelete: function (index) {
					if (confirm("Вы действительно желаете удалить?")) {
						this.deleteManuals(index);
					} else {
						return false;
					}
				}

			},

			mounted: function () {
				this.$nextTick(function () {
						this.getManuals();
				});
			}

		});
	}

});
