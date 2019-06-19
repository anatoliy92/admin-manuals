$(document).ready(function () {
	if ($("#manuals").length) {
		var manualsMenu = new Vue({
			el: '#manuals',
			delimiters: ['@[[',']]@'],
			data: {
				createOrUpdate: {
					id: 0,
					title: '',
					alias: ''
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
							url: '/manuals/' + this.manualId + '/lists/' + id,
							type: 'PUT',
							async: false,
							dataType: 'json',
							data : {
								_token: $('meta[name="_token"]').attr('content'),
								title: self.createOrUpdate.title,
								alias: self.createOrUpdate.alias,
								manual_id: this.manualId
							},
							success: function(data) {
								if (data.errors) {
									messageError(data.errors);
								} else {
									messageSuccess(data.success);
									self.createOrUpdate.id = 0;
									self.createOrUpdate.title = '';
									self.createOrUpdate.alias = '';
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
							url: '/manuals/' + this.manualId + '/getManuals',
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
					console.log(id);
					$.ajax({
							url: '/manuals/' + this.manualId + '/lists/' + id,
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
				}

			},

			mounted: function () {
				this.$nextTick(function () {
					this.manualId = $("#manual_id").val();
						this.getManuals();
				});
			}

		});
	}

});
