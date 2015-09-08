(function(w){
	
	w.app = w.app || {
		Model: {},
		Collection: {},
		View: {},
		Router: {},
		Utils: {}
	};
	
	/**
	 * Затычка для Materialize
	 * необходима для того, чтобы инициализировать стили полей ввода
	 * input, textarea
	 * Без затычки после вставки значений  вшаблон стили элементов выглядят кривыми
	 *
	 */	
	var materialize = function(id) {
	//console.log(this.model.toJSON());
		//$('.slider').slider({full_width: false});
		$(id+' .materialboxed').materialbox();
		$(id+'select').material_select();
		$(id+' input').materialize_input();
		$('.materialize-textarea').materialize_textarea();
		$(id+' .tooltipped').tooltip({delay:50});
		$('.tooltipped').tooltip({delay: 50});
	};
	
	$.fn.materialize_input = function() {
		$(this).each(function(){
			if($(this).val().length !== 0) {
				$(this).siblings('label, i').addClass('active');
			}
		});
	};
	$.fn.materialize_textarea = function() {
		$(this).each(function(){
			content = $(this).val();
			content = content.replace(/\n/g, '<br>');
			$('.hiddendiv').html(content + '<br>');
			$(this).css('height', $('.hiddendiv').height());
			$(this).siblings('label, i').addClass('active');
		});
	}
	// -------------- конец затычки
	
	Backbone.emulateHTTP = true;
	
	// MODELS -------------------------------------------------------------------------------
	app.Model.Document = Backbone.Model.extend({
		url: function() {
			var base = "../school30/api/documents/";
			return base + (base.charAt(base.length - 1) == '/' ? '' : '/') + this.get("ID");
		},
		isNew : function () { 
			if(this.get("ID")) return false; 
			return true;
		},
		initialize: function() {
			this.on("error", function(model, error) {
				Happymeal.Mediator.publish("ErrorOccured", { message: error.responseText });
			});
			this.on("sync", function(model, error) {
				Happymeal.Mediator.publish("SuccessOccured", { message: "Инофрмация о документе сохранена" });
			});
		},
	});
	app.Model.DocumentFiles = Backbone.Model.extend({
		url: function() {
			return this.prepareURL();
		},
		isNew : function () { 
			return false; 
		},
		initialize: function() {
			this.on("error", function(model, error) {
				Happymeal.Mediator.publish("ErrorOccured", { message: error.responseText });
			});
			this.on("sync", function(model, error) {
				Happymeal.Mediator.publish("SuccessOccured", { message: "Инофрмация о файле сохранена" });
			});
		},
	});
	app.Collection.Documents = Backbone.Model.extend({
		
		url: function() {
			return "../school30/api/documents?order=autoid&start="+cursor+"&count=1";
		},
		initialize: function() {
			this.on("error", function(m, error) {
				// We have received an error, log it, alert it or forget it :)
				Happymeal.Mediator.publish("ErrorOccured", {message: error.responseText });
			});
			this.on("sync", function(m, error) {
				Happymeal.Mediator.publish("DocumentLoaded", { message: m.toJSON()[0] || {} });
			});
		},
	});
	
	app.Model.Resource = Backbone.Model.extend({
		url: function() {
			return "../school30/api/documents/" + this.get('ID') + "/sources";
		},
		initialize: function() {
			var self = this;
			this.on("error", function(model, error) {
				// We have received an error, log it, alert it or forget it :)
				Happymeal.Mediator.publish("ErrorOccured", { message: error.responseText });
			});
			this.on("sync", function(m, error) {
				Happymeal.Mediator.publish("ResourceLoaded", { message: m.toJSON()[0] || {} });
			});
			Happymeal.Mediator.subscribe("DocumentLoaded", function(arg) {
				self.set( 'ID', arg.message.ID );
				self.fetch();
			});
		},
		findResource: function(ref) {
			switch(ref.rel || {}) {
				case "staff":
					var staff = this.get('Staff');
					for(var i=0;i<staff.length;i++) {
						if(staff[i].ID === ref.href ) {
							return staff[i];
						}
					}
					return {};
					break;
				case "pupil":
					var persons = this.get('Persons');
					for(var i=0;i<persons.Person.length;i++) {
						if(persons.Person[i].ID === ref.href ) {
							return persons.Person[i];
						}
					}
					return {};
					break;
				default:
				    console.log(ref);
					return {};
			}
		}
	});
	
	app.Model.ResourceD = Backbone.Model.extend({
		url: function() {
			return "../school30/api/documents/" + this.get('ID') + "/destinations";
		},
		initialize: function() {
			var self = this;
			this.on("error", function(model, error) {
				// We have received an error, log it, alert it or forget it :)
				Happymeal.Mediator.publish("ErrorOccured", { message: error.responseText });
			});
			Happymeal.Mediator.subscribe("DocumentLoaded", function(arg) {
				self.set( 'ID', arg.message.ID );
				self.fetch();
			});
		},
	});
	
	app.Model.Person = Backbone.Model.extend({});
	app.Collection.Persons = Backbone.Collection.extend({
		model: app.Model.Person,
		url: function() {
			return this.prepareURL();
		}
	});
	
	app.Model.Union = Backbone.Model.extend({});
	app.Collection.Unions = Backbone.Collection.extend({
		model: app.Model.Union,
		url: function() {
			return this.prepareURL();
		}
	});
	
	app.Model.Event = Backbone.Model.extend({});
	app.Collection.Events = Backbone.Collection.extend({
		model: app.Model.Event,
		url: function() {
			return this.prepareURL();
		}
	});
	
	app.Model.Digest = Backbone.Model.extend({});
	app.Collection.Digests = Backbone.Collection.extend({
		model: app.Model.Digest,
		url: function() {
			return this.prepareURL();
		}
	});
	
	app.Model.Link = Backbone.Model.extend({
		url: function() {
			var base = "../school30/api/links";
			if (!this.get("ID")) return base;
			return base + (base.charAt(base.length - 1) == '/' ? '' : '/') + this.get("ID");
		},
		initialize: function() {
			this.on("error", function(model, error) {
				// We have received an error, log it, alert it or forget it :)
				Happymeal.Mediator.publish("ErrorOccured", { message: error.responseText });
			});
			this.on("sync", function(model, error) {
				// We have received an error, log it, alert it or forget it :)
				Happymeal.Mediator.publish("SuccessOccured", { message: "Инофрмация о ссылке обновлена" });
				// Глобальная переменная
				doc.fetch();
				dest.fetch();
			});
		}
	});
	
	app.Model.DocumentForm = Backbone.Model.extend({
		url: function() {
			return this.prepareURL();
		},
		initialize: function() {
			this.on("error", function(model, error) {
				Happymeal.Mediator.publish("ErrorOccured", {message: error.responseText });
			});
			this.on("sync", function(model, error) {
				Happymeal.Mediator.publish("SuccessOccured", {message: " Информация обновлена" });
				// Глобальная переменная
				doc.fetch();
			});
		}
	});

	// VIEWS ---------------------------------------------------------------------------------
	app.View.DocumentForm = Backbone.View.extend({
		el: '#document-form-cont',
		template: _.template($('#document-form-view').html()),
		initialize: function() {
			var self = this;
			Happymeal.Mediator.subscribe("DocumentLoaded", function(arg) {
				self.render();
			});
			//this.listenTo(this.collection,'change', this.render); // new bind technique, to change event on the View's model
		},
		render: function () {
			var self = this;
			this.$el.html( this.template( { document: this.collection.toJSON()[0] || {} } ) );
			$("#document-id-cont").html("ID: "+this.collection.toJSON()[0].ID);
			materialize('#document-form-cont');
			//console.log(this.collection.toJSON());
			
			document.getElementById("document-submit").onclick = function() {
				var model = new app.Model.Document({});
				model.set({
					ID: document.getElementById("document-id").value,
					type: document.getElementById("document-type").value,
					year: document.getElementById("document-year").value,
					published: (document.getElementById("document-published").checked ? 1: 0 ),
					readiness: document.getElementById("document-readiness").value,
					comments: document.getElementById("document-comments").value
				});
				model.save( model.toJSON(), { patch:true } );
			};
			
		}
	});
	
	app.View.FilesForm = Backbone.View.extend({
		el: '#files-form-cont',
		template: _.template($('#files-form-view').html()),
		initialize: function() {
			//this.listenTo(this.collection,'change', this.render); // new bind technique, to change event on the View's model
			var self = this;
			Happymeal.Mediator.subscribe("ResourceLoaded", function(arg) {
				self.render();
			});
		},
		render: function () {
			var self = this;
			var cropable, file, cardId, img, scale, areas;
			var d = this.collection.toJSON()[0];
			this.$el.html( this.template( { document: d || {} } ) );
			// Отрисуем лица
			var fsCount = 1;//d.File.length;
			for( var i=0; i < fsCount; i++ ) {
				file = i;
				cardId = d.File[i].Obverse.name+'_card';
				img = $('#'+d.File[i].Obverse.name+"_img");
				scale = document.getElementById(d.File[i].Obverse.name+"_img").parentElement.clientWidth / d.File[i].Obverse.Large.width;
				//var scaleX = img.width() / d.File[i].Obverse.Large.width;
				//var scaleY = img.height() / d.File[i].Obverse.Large.height;
				areas = d.File[i].Obverse.Large.Area;
				//console.log(areas);
				for( var j = 0; j < areas.length; j++ ) {
				    tooltip = "Unknown";
					$('<div>', {
						'alt': j,
						'id': 'Ref_'+areas[j].Ref[0].href,
						'class': 'face-detected tooltipped',
						'data-position': 'top',
						'data-delay': '50',
						'data-tooltip': doc.findResource(areas[j].Ref[0]).fullName,
						'css': {
							'position': 'absolute',
							'left':     areas[j].x * scale + 'px',
							'top':      areas[j].y * scale + 'px',
							'width':    areas[j].width  * scale + 'px',
							'height':   areas[j].height * scale + 'px',
						}
					})
					.insertAfter(img)
					.on('click',function(args){
						Happymeal.Mediator.publish("Area:bind", {
							src: img[0].src,
							document: d.ID,
							file: file,
							side: "obverse",
							pos: args.currentTarget.getAttribute("alt"),
							area: areas[args.currentTarget.getAttribute("alt")],
							doc: doc.toJSON(),
							cardId: cardId
						});
						//console.log(args.currentTarget);
					});
				}
			    croppable = new Croppable({
					elem: img
				});
				
				$(croppable).on("crop", function(event) {
					// временный идишник элемента
					var tmpId = Date.now();
					// вывести координаты и размеры crop-квадрата относительно изображения
					var area = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.Area");
					area.setX(parseInt(event.left / scale));
					area.setY(parseInt(event.top / scale));
					area.setWidth(parseInt(event.width / scale ));
					area.setHeight(parseInt(event.height/ scale ));
					Happymeal.Mediator.publish("Area:bind",{
						src: img[0].src,
						document: d.ID,
						file: file,
						side: "obverse",
						area: area.toJSON(),
						doc: doc.toJSON(),
						tmpId: tmpId,
						cardId: cardId
					});
					$('<div>', {
						'id': tmpId,
						'class': 'face',
						'css': {
							'position': 'absolute',
							'left':     event.left + 'px',
							'top':      event.top + 'px',
							'width':    event.width + 'px',
							'height':   event.height + 'px'
						}
					})
					.insertAfter(img)
					.on('click',function(args){
						Happymeal.Mediator.publish("Area:bind",{
							src: img[0].src,
							document: d.ID,
							file: file,
							side: "obverse",
							area: area.toJSON(),
							doc: doc.toJSON(),
							tmpId: tmpId,
							cardId: cardId
						});
					});
					//console.log(event);
				});
			}
			materialize('#files-form-cont');
			$('.show-detected-faces').on('click',function(args) {
				$('.face-detected').show();
			});
			$('.hide-detected-faces').on('click',function(args) {
				$('.face-detected').hide();
			});
			$(".file-opened").each( function( index ) {
				var model = self.collection.toJSON()[0];
				this.onchange = function() {
					var DocumentFilesXmlAdaptor = Happymeal.Port.Adaptor.HTTP.extend({
						changeFilesStatus: function( docFiles ) {
							this.patch({
								url: "../school30/api/documents/" + model.ID + "/files",
								entity: docFiles,
								accept: "application/json",
								content: "application/json",
								callback: function( http ) {
									Happymeal.Mediator.publish('SuccessOccured',{ message: "Информация о файле обновлена" });
								}
							});
						}
					});
					var docFiles = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.Files");
					var docFile = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.File");
					docFile.setFace( this.value );
					docFile.setOpened( this.checked ? 1 : 0 );
					docFiles.setFile(docFile);
					DocumentFilesXmlAdaptor.changeFilesStatus( docFiles );
				}
			});
			$('.detect-faces').on('click',function(args) {
				var scaleX, scaleY;
				var imageID = this.getAttribute("id");
				$('#'+args.currentTarget.id+'_img').faceDetection({
					complete: function (faces) {
						var file = this[0].getAttribute("alt");
						var src = this[0].src;
						var areas = [];
						//console.log(faces);
						for (var i = 0; i < faces.length; i++) {
							scaleX = faces[i].scaleX;
							scaleY = faces[i].scaleY;
							areas[i] = Happymeal.Locator("School.Port.Adaptor.Data.School.Images.Area");
							areas[i].setX(parseInt(faces[i].x));
							areas[i].setY(parseInt(faces[i].y));
							areas[i].setWidth(parseInt(faces[i].width));
							areas[i].setHeight(parseInt(faces[i].height));
							$('<div>', {
								'alt': i,
								'class': 'face',
								'css': {
									'position': 'absolute',
									'left':     faces[i].x * faces[i].scaleX + 'px',
									'top':      faces[i].y * faces[i].scaleY + 'px',
									'width':    faces[i].width  * faces[i].scaleX + 'px',
									'height':   faces[i].height * faces[i].scaleY + 'px'
								}
							})
							.insertAfter(this)
							.on('click',function(args){
								Happymeal.Mediator.publish("Area:bind",{
									src: src,
									document: d.ID,
									file: file,
									side: "obverse",
									area: areas[args.currentTarget.getAttribute("alt")].toJSON(),
									doc: doc.toJSON()
								});
								//console.log(args.currentTarget);
							});
						}
					},
					error:function (code, message) {
						Happymeal.Mediator.publish('ErrorOccured',{ message: message });
					}
				});
			});
			
		}
	});
	
	app.View.FormForm = Backbone.View.extend({
		el: '#form-form-cont',
		template: _.template($('#form-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},/*
		events: {
			"click .link-delete": function(args) {
				var link = new app.Model.Link({});
				link.set({
					id: 1,
					ID: args.currentTarget.id,
				});
				link.destroy();
			}
		},*/
		render: function () {
			var self = this;
			this.$el.html( this.template( { forms: this.model.toJSON().Forms || [] } ) );
			$("#form-counter-cont").html(this.model.toJSON().Forms.length);
			materialize('#form-form-cont');
			document.getElementById("form-submit").onclick = function() {
				var form = new app.Model.DocumentForm({});
				form.prepareURL = function() {
					return "../school30/api/documents/" + document.getElementById("document-id").value + "/forms";
				};
				form.set({
					cohort: document.getElementById("form-cohort").value,
					year: document.getElementById("form-year").value,
					league: document.getElementById("form-league").value,
				})
				form.save();
			};
			$('#form-form-cont .link-delete').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			});
		}
	});
	
	app.View.StaffForm = Backbone.View.extend({
		el: '#staff-form-cont',
		template: _.template($('#staff-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},/*
		events: {
			"click .link-delete": function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			}
		}, */
		render: function () {
			var self = this;
			var persons = this.model.toJSON().Staff || [];
			this.$el.html( this.template( { staff: persons } ) );
			$("#staff-counter-cont").html(persons.length);
			materialize('#staff-form-cont');
			/**
			* Управление списком
			*/
			document.getElementById("search-staff-submit").onclick = function() {
				var str = $("#search-staff-field").val();
				if(!str) return;
				var collection = new app.Collection.Persons({});
				collection.prepareURL = function() {
					return "../school30/api/staff?ln="+str;
				}
				collection.getMode = function() {
					return "staff";
				}
				var view = new app.View.Persons({
					collection: collection
				});
			};
			$('#staff-form-cont .link-delete').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			});
		}
		
	});
	
	app.View.PersonsForm = Backbone.View.extend({
		el: '#persons-form-cont',
		template: _.template($('#persons-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},/*
		events: {
			"click .link-delete": function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			},
		},*/
		render: function () {
			var self = this;
			var persons = this.model.toJSON().Persons.Person || [];
			this.$el.html( this.template( { persons: persons } ) );
			$("#persons-counter-cont").html(persons.length);
			materialize('#persons-form-cont');
			/**
			* Управление списком
			*/
			document.getElementById("search-pupil-submit").onclick = function() {
				var str = $("#search-pupil-field").val();
				if(!str) return;
				var collection = new app.Collection.Persons({});
				collection.prepareURL = function() {
					return "../school30/api/persons?ln="+str;
				}
				collection.getMode = function() {
					return "pupil";
				}
				var view = new app.View.Persons({
					collection: collection
				});
			};
			$('#persons-form-cont .link-delete').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				//LinkXmlAdaptor.fetch(link);
				LinkXmlAdaptor.destroy(link);
			});
		}
	});
	
	app.View.UnionsForm = Backbone.View.extend({
		el: '#unions-form-cont',
		template: _.template($('#unions-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},
		/*
		events: {
			"click .link-delete": function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			}
		},*/
		render: function () {
			var self = this;
			this.$el.html( this.template( { unions: this.model.toJSON().Unions || [] } ) );
			$("#unions-counter-cont").html(this.model.toJSON().Unions.length);
			materialize('#unions-form-cont');
			/**
			 * Управление списком
			 */
			document.getElementById("search-union-submit").onclick = function() {
				var collection = new app.Collection.Unions({});
				collection.prepareURL = function() {
					return "../school30/api/unions";
				}
				var view = new app.View.Unions({
					collection: collection
				});
			};
			$('#unions-form-cont .link-delete').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				//LinkXmlAdaptor.fetch(link);
				LinkXmlAdaptor.destroy(link);
			});
			return this;
		}
	});
	
	app.View.EventsForm = Backbone.View.extend({
		el: '#events-form-cont',
		template: _.template($('#events-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},
		render: function () {
			var self = this;
			this.$el.html( this.template( { events: this.model.toJSON().Events || [] } ) );
			$("#events-counter-cont").html(this.model.toJSON().Events.length);
			materialize('#events-form-cont');
			/**
			 * Управление списком
			 */
			document.getElementById("search-event-submit").onclick = function() {
				var collection = new app.Collection.Events({});
				collection.prepareURL = function() {
					return "../school30/api/events";
				}
				var view = new app.View.Events({
					collection: collection
				});
			};
			$('#events-form-cont .link-delete').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				//LinkXmlAdaptor.fetch(link);
				LinkXmlAdaptor.destroy(link);
			});
			return this;
		}
	});
	
	app.View.DigestsForm = Backbone.View.extend({
		el: '#digests-form-cont',
		template: _.template($('#digests-form-view').html()),
		initialize: function() {
			this.listenTo(this.model,'sync', this.render); // new bind technique, to change event on the View's model
		},
		/**events: {
			"click .link-delete": function( args ) {
				//var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				//link.setID(args.currentTarget.id);
				//LinkXmlAdaptor.fetch(link);
				//console.log(1);
			}
		},*/
		render: function () {
			var self = this;
			this.$el.html( this.template( { digests: this.model.toJSON().Digests || [] } ) );
			$("#digests-counter-cont").html(this.model.toJSON().Digests.length);
			materialize('#digests-form-cont');
			/**
			 * Управление списком
			 */
			document.getElementById("search-digest-submit").onclick = function() {
				var collection = new app.Collection.Digests({});
				collection.prepareURL = function() {
					return "../school30/api/digests";
				}
				var view = new app.View.Digests({
					collection: collection
				});
			};
			$('#digests-form-cont .link-patch').on('click',function(args) {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setID(args.currentTarget.id);
				LinkXmlAdaptor.fetch(link);
			});
			
			return this;
		}
	});
	
	/**  Модальные списки */
	app.View.Persons = Backbone.View.extend({
		el: '#persons-list',
		template: _.template($('#persons-list-view').html()),
		initialize: function() {
			this.listenTo(this.collection,'sync', this.render); // new bind technique, to change event on the View's model
			this.listenTo(this.collection,'ready', this.render); // new bind technique, to change event on the View's model
			this.collection.fetch(); // fetching the model data from /my/url
		},
		render: function() {
			var collection = this.collection;
			var json = collection.toJSON();
			console.log(json);
			var persons = json[0] && json[0].Person ? json[0].Person : json;
			this.$el.html( this.template({ persons: persons }));
			$(".person-add").on('click','i', function() {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setSource(this.getAttribute("id"));
				link.setDestination(document.getElementById("document-id").value);
				link.setType(collection.getMode());
				link.setDtStart(document.getElementById("document-year").value);
				link.setDtEnd(document.getElementById("document-year").value);
				LinkXmlAdaptor.bindResources(link);
				$("#persons-list-modal").closeModal();
			});
			$("#persons-list-modal").openModal();
		}
	});
	
	app.View.Unions = Backbone.View.extend({
		el: '#unions-list',
		template: _.template($('#unions-list-view').html()),
		initialize: function() {
			this.listenTo(this.collection,'sync', this.render); // new bind technique, to change event on the View's model
			this.listenTo(this.collection,'ready', this.render); // new bind technique, to change event on the View's model
			this.collection.fetch(); // fetching the model data from /my/url
		},
		render: function() {
			var collection = this.collection;
			this.$el.html( this.template({ unions: collection.toJSON() }));
			$(".union-add").on('click','i', function() {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setSource(this.getAttribute("id"));
				link.setDestination(document.getElementById("document-id").value);
				link.setType('union');
				link.setDtStart(document.getElementById("document-year").value);
				link.setDtEnd(document.getElementById("document-year").value);
				LinkXmlAdaptor.bindResources(link);
				$("#unions-list-modal").closeModal();
			});
			$("#unions-list-modal").openModal();
		}
	});
	
	app.View.Events = Backbone.View.extend({
		el: '#events-list',
		template: _.template($('#events-list-view').html()),
		initialize: function() {
			this.listenTo(this.collection,'sync', this.render); // new bind technique, to change event on the View's model
			this.listenTo(this.collection,'ready', this.render); // new bind technique, to change event on the View's model
			this.collection.fetch(); // fetching the model data from /my/url
		},
		render: function() {
			var collection = this.collection;
			this.$el.html( this.template({ events: collection.toJSON() }));
			$(".event-add").on('click','i', function() {
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setSource(document.getElementById("document-id").value);
				link.setDestination(this.getAttribute("id"));
				link.setType('event');
				link.setDtStart(document.getElementById("document-year").value);
				link.setDtEnd(document.getElementById("document-year").value);
				LinkXmlAdaptor.bindResources(link);
				$("#events-list-modal").closeModal();
			});
			$("#events-list-modal").openModal();
		}
	});
	
	app.View.Digests = Backbone.View.extend({
		el: '#digests-list',
		template: _.template($('#digests-list-view').html()),
		initialize: function() {
			this.listenTo(this.collection,'sync', this.render); // new bind technique, to change event on the View's model
			//this.listenTo(this.collection,'ready', this.render); // new bind technique, to change event on the View's model
			this.collection.fetch(); // fetching the model data from /my/url
		},
		render: function() {
			var collection = this.collection;
			//console.log(collection.toJSON());
			this.$el.html( this.template({ digests: collection.toJSON() }));
			materialize('#digests-list');
			$("#digests-list-modal").openModal();
			document.getElementById("digest-submit").onclick = function() {
				var select = document.getElementById("digests-list");
				var published = select.options[select.selectedIndex].text;
				var link = Happymeal.Locator("School.Port.Adaptor.Data.School.Links.Link");
				link.setSource(document.getElementById("document-id").value);
				link.setDestination(document.getElementById("digests-list").value);
				link.setType(document.getElementById("digest-typelink").value);
				link.setComments(document.getElementById("digest-comments").value);
				link.setDtStart(published);
				link.setDtEnd(published);
				LinkXmlAdaptor.bindResources(link);
				$("#digests-list-modal").closeModal();
			}
		}
	});
	
	/*app.View.LinkEdit = Backbone.View.extend({
		el: '#link-edit-form',
		template: _.template($('#link-edit-view').html()),
		initialize: function() {
			var self = this;
			Happymeal.Mediator.subscribe("Link:ready", function( link ) {
				$("#link-edit-modal").openModal();
				self.$el.html( self.template({ link: link.toJSON() }));
				materialize('#link-edit-form');
				document.getElementById("link-delete-submit").onclick = function() {
					LinkXmlAdaptor.destroy(link);
					$("#link-edit-modal").closeModal();
				};
				document.getElementById("link-patch-submit").onclick = function() {
					link.setDtStart(document.getElementById("link-edit-dtstart").value);
					link.setDtEnd(document.getElementById("link-edit-dtend").value);
					link.setType(document.getElementById("link-edit-type").value);
					link.setComments(document.getElementById("link-edit-comments").value);
					LinkXmlAdaptor.modify(link);
					$("#link-edit-modal").closeModal();
				};
			});
		},
		render: function() {
		}
	});
	var linkEditView = new app.View.LinkEdit({});*/
	
	var linkEditView = Happymeal.HTMLView.extend({
		el: $("#link-edit-form"),
		template: _.template($('#link-edit-view').html()),
		initialize: function() {
			Happymeal.Mediator.subscribe("Link:ready",this.render, this);
		},
		render: function(link) {
            //console.log(link.toJSON());
			$('#link-edit-modal').openModal();
			this.el.html( this.template({link:link.toJSON()}));
			materialize('#link-edit-form');
			this.bind(link);
		},
		bind: function(link) {
			document.getElementById("link-delete-submit").onclick = function() {
				LinkXmlAdaptor.destroy(link);
				$('#link-edit-modal').closeModal();
			};
			document.getElementById("link-patch-submit").onclick = function() {
				link.setDtStart(document.getElementById("link-edit-dtstart").value);
				link.setDtEnd(document.getElementById("link-edit-dtend").value);
				link.setType(document.getElementById("link-edit-type").value);
				link.setComments(document.getElementById("link-edit-comments").value);
				LinkXmlAdaptor.modify(link);
				$("#link-edit-modal").closeModal();
			};
		}
	});
	
	

	app.View.AreaEdit = Backbone.View.extend({
		el: '#area-edit-form',
		template: _.template($('#area-edit-view').html()),
		initialize: function() {
			var self = this;
			var pos, tmpId, cardId;
			Happymeal.Mediator.subscribe("Area:bind", function( args ) {
				pos = args.pos || null;
				tmpId = args.tmpId || null;
				cardId = args.cardId;
				$("#area-edit-modal").openModal();
				self.$el.html( self.template({ args: args }));
				materialize('#area-edit-form');
				document.getElementById("area-delete-submit").onclick = function() {
					AreaXmlAdaptor.destroy( args.area, args.pos, args.document, args.file, args.side );
					$("#area-edit-modal").closeModal();
				};
				$(".staff-face-add").on('click','i', function(arg) {
					var area = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.Area");
					area.setX(document.getElementById("area-edit-x").value);
					area.setY(document.getElementById("area-edit-y").value);
					area.setWidth(document.getElementById("area-edit-width").value);
					area.setHeight(document.getElementById("area-edit-height").value);
					var ref = Happymeal.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
					ref.setRel("staff");
					ref.setHref(arg.currentTarget.id);
					area.setRef(ref);
					AreaXmlAdaptor.create( area,
						document.getElementById("area-edit-document").value,
						document.getElementById("area-edit-file").value,
						document.getElementById("area-edit-side").value
					);
					$("#area-edit-modal").closeModal();
				});
				$(".pupil-face-add").on('click','i', function(arg) {
					var area = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.Area");
					area.setX(document.getElementById("area-edit-x").value);
					area.setY(document.getElementById("area-edit-y").value);
					area.setWidth(document.getElementById("area-edit-width").value);
					area.setHeight(document.getElementById("area-edit-height").value);
					var ref = Happymeal.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
					ref.setRel("pupil");
					ref.setHref(arg.currentTarget.id);
					area.setRef(ref);
					AreaXmlAdaptor.create( area,
						document.getElementById("area-edit-document").value,
						document.getElementById("area-edit-file").value,
						document.getElementById("area-edit-side").value
					);
					$("#area-edit-modal").closeModal();
				});
			});
			/*
			Happymeal.Mediator.subscribe("Area:created", function( area ) {
				if( tmpId ) {
					// Изменим отображение
					$("#"+tmpId).removeClass('face').addClass('face-detected');
					// Установим порядковый номер
					var alt = $("#"+cardId).children('.face-detected').length - 1;
					// Присвоим новый ИД
					var el = document.getElementById(tmpId);
					el.setAttribute('id','Ref_'+area.getRef()[0].getHref());
					el.setAttribute('alt',alt);
				}
			});
			*/
		},
		render: function() {
		}
	});
	var AreaEditView = new app.View.AreaEdit({});

	var digestsSelectView = Happymeal.HTMLView.extend({
		el: document.getElementById('digests-view'),
		template: _.template(document.getElementById('digests-select-view').innerHTML),
		initialize: function() {
			Happymeal.Mediator.subscribe("Digests:ready",this.render, this);
		},
		render: function(digests) {
			var html = this.template({digests:digests.toJSON()});
			this.el.innerHTML = html;
			materialize('#digests-view');
			this.bind(digests);
		},
		bind: function(digests) {
			document.getElementById('digest-select-id').addEventListener("change", function(e) {
				DigestsHTTPAdaptor.findById(this.value);
			},true);
		}
	});
	var digestResourceView = Happymeal.HTMLView.extend({
	
		template: _.template(document.getElementById('digest-info-view').innerHTML),
		initialize: function() {
			Happymeal.Mediator.subscribe("DigestSources:ready",this.render, this);
		},
		render: function(sources) {
			this.el = document.getElementById('digest-info');
			var html = this.template({sources:sources.toJSON()});
			this.el.innerHTML = html;
			materialize('#digest-info');
			this.bind(sources);
		}
	});


	// ----------------- ADAPTORS

	var LinkXmlAdaptor = Happymeal.Port.Adaptor.HTTP.extend({
		fetch: function( link ) {
			this.get({
				url: "../school30/api/links/"+link.getID(),
				accept: "application/xml", 
				callback: function(http) {
					link.XML = http.responseXML;
					link.fromXmlStr(http.responseText, function(link) {
						Happymeal.Mediator.publish('Link:ready',link);
					});
				}
			});
		},
		modify: function( link ) {
			this.patch({
				url: "../school30/api/links/"+link.getID(),
				entity: link,
				content: "application/json", 
				callback: function( http ) {
					Happymeal.Mediator.publish('SuccessOccured',{ message: "Связь успешно обновлена" });
					dest.fetch();
					doc.fetch();
				}
			});
		},
		bindResources: function( link ) {
			this.post({
				url: "../school30/api/links",
				entity: link,
				content: "application/json",
				callback: function( http ) {
					Happymeal.Mediator.publish('SuccessOccured',{ message: "Связь успешно установлена" });
					dest.fetch();
					doc.fetch();
				}
			});
		},
		destroy: function( link ) {
			this.del({
				url:"../school30/api/links/"+link.getID(),
				entity: link,
				content: "application/json",
				callback: function( http ) {
					Happymeal.Mediator.publish('SuccessOccured',{ message: "Связь успешно удалена" });
					dest.fetch();
					doc.fetch();
				}
			});
		}
	});
	
	var PositionXmlAdaptor = Happymeal.Port.Adaptor.HTTP.extend({
		fetch: function(id) {
			this.get({
				url: "../school30/api/v0.1/paths/"+id+"/position",
				accept: "application/xml", 
				callback: function(http){
					var pos = Happymeal.Locator("School.Port.Adaptor.Data.School.Documents.DocumentPosition");
					pos.XML = http.responseXML;
					pos.fromXmlStr(http.responseText, function(pos) {
						router.navigate("documents/"+pos.get(), {trigger: true, replace: true});
					});
				}
			});
		}
	});
	
	var DigestsHTTPAdaptor = Happymeal.Port.Adaptor.HTTP.extend({
		fetch: function() {
			this.get({
				url: "../school30/api/digests",
				accept: "application/xml", 
				callback: function(http){
					var digests = Happymeal.Locator("School.Port.Adaptor.Data.School.Digests");
					digests.XML = http.responseXML;
					digests.fromXmlStr(http.responseText, function(digests) {
						Happymeal.Mediator.publish("Digests:ready", digests);
					});
				}
			});
		},
		findById: function(id) {
			this.get({
				url: "../school30/api/digests/"+id+"/sources",
				accept: "application/xml", 
				callback: function(http){
					var res = Happymeal.Locator("School.Port.Adaptor.Data.School.Resources");
					res.XML = http.responseXML;
					res.fromXmlStr(http.responseText, function(res) {
						Happymeal.Mediator.publish("DigestSources:ready", res);
					});
				}
			});
		}
	});
	
	var AreaXmlAdaptor = Happymeal.Port.Adaptor.HTTP.extend({
		create: function( area, document, file, side ) {
			this.post({
				url: "../school30/api/documents/"+document+"/files/"+file+"/"+side+"/areas",
				entity: area,
				content: "application/json",
				callback: function( http ) {
					Happymeal.Mediator.publish('SuccessOccured',{ message: "Ок" });
					//Happymeal.Mediator.publish('Area:created', area );
					docs.fetch();
				}
			});
		},
		destroy: function( area, pos, document, file, side ) {
			if(!pos) return;
			this.del({
				url: "../school30/api/documents/"+document+"/files/"+file+"/"+side+"/areas/"+pos,
				entity: area,
				content: "application/json",
				callback: function( http ) {
					Happymeal.Mediator.publish( 'SuccessOccured', { message: "Ok" });
					//Happymeal.Mediator.publish( 'Area:deleted', area );
					docs.fetch();
				}
			});
		}
	});
	
	
	// Router
	var docs, doc, dest;
	app.Router = Backbone.Router.extend({

		routes:{
			"": "document",
			"home": "document",
			"documents/:id": "document",
			"digests": "digests"
		},
		
		document: function(id) {
			$('#digests-view').hide();
			$('#document-view').show();
			cursor = id || 0;
			Happymeal.Mediator.clear(["DocumentLoaded","ResourceLoaded"]);
			docs = new app.Collection.Documents({});
			var docForm = new app.View.DocumentForm({ collection: docs }); 
			var filesForm = new app.View.FilesForm({ collection: docs }); 
			doc = new app.Model.Resource({});
			var formForm = new app.View.FormForm({ model: doc }); 
			var staffForm = new app.View.StaffForm({ model: doc }); 
			var personsForm = new app.View.PersonsForm({ model: doc }); 
			var unionsForm = new app.View.UnionsForm({ model: doc }); 
			dest = new app.Model.ResourceD({});
			var eventsForm = new app.View.EventsForm({ model: dest }); 
			var digestsForm = new app.View.DigestsForm({ model: dest }); 
			docs.fetch();
		},
		
		digests: function(id) {
			$('#document-view').hide();
			$('#digests-view').show();
			DigestsHTTPAdaptor.fetch();
		}
    });
	
	
	
	Happymeal.Mediator.subscribe("ErrorOccured", function( args ) {
		document.getElementById("error-message").innerHTML = args.message;
		$('#error-modal').openModal();
		//$('.modal-trigger').click();
	});
	
	Happymeal.Mediator.subscribe("SuccessOccured", function( args ) {
		toast(args.message, 2000);
	});
	
	document.getElementById("fast-forward").onclick = function() {
		var next = parseInt(cursor)+1;
		router.navigate("documents/"+next, {trigger: true, replace: true});
	};
	document.getElementById("fast-rewind").onclick = function() {
		var next = parseInt(cursor)-1;
		if(next < 0 ) next = 0;
		router.navigate("documents/"+next, {trigger: true, replace: true});
	};
	document.getElementById("skip-next").onclick = function() {
		var next = parseInt(cursor)+20;
		router.navigate("documents/"+next, {trigger: true, replace: true});
	};
	document.getElementById("skip-previous").onclick = function() {
		var next = parseInt(cursor)-20;
		if(next < 0 ) next = 0;
		router.navigate("documents/"+next, {trigger: true, replace: true});
	};
	
	document.getElementById("path-position-search").onkeypress = function(e) {
		if (e.keyCode == 13) {
			PositionXmlAdaptor.fetch(this.value);
			return false;
		}
	}
	
	$('.materialboxed').materialbox();
	$('.collapsible').collapsible({ accordion : false });
	$(".collapsible li:first-child .collapsible-header").each(function(){
			$(this).click();
	});
	$('.modal-trigger').leanModal();
	
	var cursor = 0;
	var router = new app.Router();
	Backbone.history.start();
	
}(window));