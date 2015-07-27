;(function(h) {
		
	h.Locator( "School.Port.Adaptor.Data.School.Persons.Person", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Persons";
			var ROOT="Person";
			var anyComplexType = {
				autouid: null,
				ID: null,
				fullName: null,
				firstName: null,
				lastName: null,
				newName: null,
				middleName: null,
				enFullName: null,
				DOB: null,
				comments: null,
				Link: null
			};
			var Person = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getFullName: function() { return anyComplexType.fullName; },
				getFirstName: function() { return anyComplexType.firstName; },
				getLastName: function() { return anyComplexType.lastName; },
				getNewName: function() { return anyComplexType.newName; },
				getMiddleName: function() { return anyComplexType.middleName; },
				getEnFullName: function() { return anyComplexType.enFullName; },
				getDOB: function() { return anyComplexType.DOB; },
				getComments: function() { return anyComplexType.comments; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setFullName: function(val) { anyComplexType.fullName = val; },
				setFirstName: function(val) { anyComplexType.firstName = val; },
				setLastName: function(val) { anyComplexType.lastName = val; },
				setNewName: function(val) { anyComplexType.newName = val; },
				setMiddleName: function(val) { anyComplexType.middleName = val; },
				setEnFullName: function(val) { anyComplexType.enFullName = val; },
				setDOB: function(val) { anyComplexType.DOB = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "fullName":
								self.setFullName(t);
								break;
							case "firstName":
								self.setFirstName(t);
								break;
							case "lastName":
								self.setLastName(t);
								break;
							case "newName":
								self.setNewName(t);
								break;
							case "middleName":
								self.setMiddleName(t);
								break;
							case "enFullName":
								self.setEnFullName(t);
								break;
							case "DOB":
								self.setDOB(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getFullName();
					if( prop !== null ) {
						str += "<fullName>"+this.getFullName()+"</fullName>";
					}
					prop = this.getFirstName();
					if( prop !== null ) {
						str += "<firstName>"+this.getFirstName()+"</firstName>";
					}
					prop = this.getLastName();
					if( prop !== null ) {
						str += "<lastName>"+this.getLastName()+"</lastName>";
					}
					prop = this.getNewName();
					if( prop !== null ) {
						str += "<newName>"+this.getNewName()+"</newName>";
					}
					prop = this.getMiddleName();
					if( prop !== null ) {
						str += "<middleName>"+this.getMiddleName()+"</middleName>";
					}
					prop = this.getEnFullName();
					if( prop !== null ) {
						str += "<enFullName>"+this.getEnFullName()+"</enFullName>";
					}
					prop = this.getDOB();
					if( prop !== null ) {
						str += "<DOB>"+this.getDOB()+"</DOB>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Person);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Persons", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Persons";
			var ROOT="Persons";
			var anyComplexType = {
				Ref: [],
				Person: []
			};
			var Persons = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getRef: function() { return anyComplexType.Ref; },
				getPerson: function() { return anyComplexType.Person; },
		
				setRef: function(val) { anyComplexType.Ref.push(val); },
				setPerson: function(val) { anyComplexType.Person.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Ref":
								var Ref = h.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
								Ref.fromXmlParser(parser,self,callback);
								self.setRef(Ref);
								break;
							case "Person":
								var Person = h.Locator("School.Port.Adaptor.Data.School.Persons.Person");
								Person.fromXmlParser(parser,self,callback);
								self.setPerson(Person);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getRef();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					prop = this.getPerson();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Persons);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Persons.Staff", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Persons";
			var ROOT="Staff";
			var anyComplexType = {
				Person: []
			};
			var Staff = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getPerson: function() { return anyComplexType.Person; },
		
				setPerson: function(val) { anyComplexType.Person.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Person":
								var Person = h.Locator("School.Port.Adaptor.Data.School.Persons.Person");
								Person.fromXmlParser(parser,self,callback);
								self.setPerson(Person);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getPerson();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Staff);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Form", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Form";
			var anyComplexType = {
				autouid: null,
				ID: null,
				cohort: null,
				year: null,
				league: null,
				comments: null,
				Link: null
			};
			var Form = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getCohort: function() { return anyComplexType.cohort; },
				getYear: function() { return anyComplexType.year; },
				getLeague: function() { return anyComplexType.league; },
				getComments: function() { return anyComplexType.comments; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setCohort: function(val) { anyComplexType.cohort = val; },
				setYear: function(val) { anyComplexType.year = val; },
				setLeague: function(val) { anyComplexType.league = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "cohort":
								self.setCohort(t);
								break;
							case "year":
								self.setYear(t);
								break;
							case "league":
								self.setLeague(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getCohort();
					if( prop !== null ) {
						str += "<cohort>"+this.getCohort()+"</cohort>";
					}
					prop = this.getYear();
					if( prop !== null ) {
						str += "<year>"+this.getYear()+"</year>";
					}
					prop = this.getLeague();
					if( prop !== null ) {
						str += "<league>"+this.getLeague()+"</league>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Form);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Forms", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Forms";
			var anyComplexType = {
				Form: []
			};
			var Forms = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getForm: function() { return anyComplexType.Form; },
		
				setForm: function(val) { anyComplexType.Form.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Form":
								var Form = h.Locator("School.Port.Adaptor.Data.School.Unions.Form");
								Form.fromXmlParser(parser,self,callback);
								self.setForm(Form);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getForm();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Forms);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Cohorts", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Cohorts";
			var anyComplexType = {
				Cohort: []
			};
			var Cohorts = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getCohort: function() { return anyComplexType.Cohort; },
		
				setCohort: function(val) { anyComplexType.Cohort.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Cohort":
								var Cohort = h.Locator("School.Port.Adaptor.Data.School.Unions.Cohort");
								Cohort.fromXmlParser(parser,self,callback);
								self.setCohort(Cohort);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getCohort();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Cohorts);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Cohort", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Cohort";
			var anyComplexType = {
				year: null,
				league: []
			};
			var Cohort = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getYear: function() { return anyComplexType.year; },
				getLeague: function() { return anyComplexType.league; },
		
				setYear: function(val) { anyComplexType.year = val; },
				setLeague: function(val) { anyComplexType.league.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "year":
								self.setYear(t);
								break;
							case "league":
								self.setLeague(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getYear();
					if( prop !== null ) {
						str += "<year>"+this.getYear()+"</year>";
					}
					prop = this.getLeague();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += "<league>"+prop[i]+"</league>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Cohort);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Leagues", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Leagues";
			var anyComplexType = {
				league: []
			};
			var Leagues = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getLeague: function() { return anyComplexType.league; },
		
				setLeague: function(val) { anyComplexType.league.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "league":
								self.setLeague(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getLeague();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += "<league>"+prop[i]+"</league>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Leagues);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.League", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="League";
			var anyComplexType = {
				ID: null,
				cohort: null,
				year: []
			};
			var League = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getID: function() { return anyComplexType.ID; },
				getCohort: function() { return anyComplexType.cohort; },
				getYear: function() { return anyComplexType.year; },
		
				setID: function(val) { anyComplexType.ID = val; },
				setCohort: function(val) { anyComplexType.cohort = val; },
				setYear: function(val) { anyComplexType.year.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "ID":
								self.setID(t);
								break;
							case "cohort":
								self.setCohort(t);
								break;
							case "year":
								self.setYear(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getCohort();
					if( prop !== null ) {
						str += "<cohort>"+this.getCohort()+"</cohort>";
					}
					prop = this.getYear();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += "<year>"+prop[i]+"</year>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(League);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions.Union", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Union";
			var anyComplexType = {
				autouid: null,
				ID: null,
				name: null,
				comments: null,
				Link: null
			};
			var Union = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getName: function() { return anyComplexType.name; },
				getComments: function() { return anyComplexType.comments; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setName: function(val) { anyComplexType.name = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "name":
								self.setName(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Union);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Unions", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Unions";
			var ROOT="Unions";
			var anyComplexType = {
				Union: []
			};
			var Unions = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getUnion: function() { return anyComplexType.Union; },
		
				setUnion: function(val) { anyComplexType.Union.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Union":
								var Union = h.Locator("School.Port.Adaptor.Data.School.Unions.Union");
								Union.fromXmlParser(parser,self,callback);
								self.setUnion(Union);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getUnion();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Unions);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Documents";
			var anyComplexType = {
				Document: []
			};
			var Documents = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getDocument: function() { return anyComplexType.Document; },
		
				setDocument: function(val) { anyComplexType.Document.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Document":
								var Document = h.Locator("School.Port.Adaptor.Data.School.Documents.Document");
								Document.fromXmlParser(parser,self,callback);
								self.setDocument(Document);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getDocument();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Documents);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.Document", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Document";
			var anyComplexType = {
				autouid: null,
				ID: null,
				type: null,
				year: null,
				path: null,
				published: null,
				readiness: "0",
				comments: null,
				File: [],
				Link: null
			};
			var Document = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getType: function() { return anyComplexType.type; },
				getYear: function() { return anyComplexType.year; },
				getPath: function() { return anyComplexType.path; },
				getPublished: function() { return anyComplexType.published; },
				getReadiness: function() { return anyComplexType.readiness; },
				getComments: function() { return anyComplexType.comments; },
				getFile: function() { return anyComplexType.File; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setType: function(val) { anyComplexType.type = val; },
				setYear: function(val) { anyComplexType.year = val; },
				setPath: function(val) { anyComplexType.path = val; },
				setPublished: function(val) { anyComplexType.published = val; },
				setReadiness: function(val) { anyComplexType.readiness = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setFile: function(val) { anyComplexType.File.push(val); },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "File":
								var File = h.Locator("School.Port.Adaptor.Data.School.Documents.File");
								File.fromXmlParser(parser,self,callback);
								self.setFile(File);
								break;
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "type":
								self.setType(t);
								break;
							case "year":
								self.setYear(t);
								break;
							case "path":
								self.setPath(t);
								break;
							case "published":
								self.setPublished(t);
								break;
							case "readiness":
								self.setReadiness(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getType();
					if( prop !== null ) {
						str += "<type>"+this.getType()+"</type>";
					}
					prop = this.getYear();
					if( prop !== null ) {
						str += "<year>"+this.getYear()+"</year>";
					}
					prop = this.getPath();
					if( prop !== null ) {
						str += "<path>"+this.getPath()+"</path>";
					}
					prop = this.getPublished();
					if( prop !== null ) {
						str += "<published>"+this.getPublished()+"</published>";
					}
					prop = this.getReadiness();
					if( prop !== null ) {
						str += "<readiness>"+this.getReadiness()+"</readiness>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					prop = this.getFile();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Document);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.DocumentPosition", function() {
		
		
		return (function(){
			var value = null;
			var DocumentPosition = h.Port.Adaptor.Data.XML.Schema.AnySimpleType.extend({
				ROOT: "DocumentPosition",
				NS: "urn:ru:battleship:School:Documents",
				get: function() { return value; },
				set: function(v) { value = v; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					parser.ontext = function(t) {
						value = t;
					};
					parser.onclosetag = function(tag) {
						callback(self);
					};
				},
				
				toXmlStr: function() {
					var prop, str;
					str = "<"+this.ROOT+" xmlns='"+this.NS+"'>";
					str += value;
					str += "</"+this.ROOT+">";
					return str;
				}
			});
			return h.Model.extend(DocumentPosition);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.Files", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Files";
			var anyComplexType = {
				File: []
			};
			var Files = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getFile: function() { return anyComplexType.File; },
		
				setFile: function(val) { anyComplexType.File.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "File":
								var File = h.Locator("School.Port.Adaptor.Data.School.Documents.File");
								File.fromXmlParser(parser,self,callback);
								self.setFile(File);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getFile();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Files);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.File", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="File";
			var anyComplexType = {
				name: null,
				face: null,
				back: null,
				opened: null,
				comments: null,
				Obverse: null,
				Reverse: null
			};
			var File = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getName: function() { return anyComplexType.name; },
				getFace: function() { return anyComplexType.face; },
				getBack: function() { return anyComplexType.back; },
				getOpened: function() { return anyComplexType.opened; },
				getComments: function() { return anyComplexType.comments; },
				getObverse: function() { return anyComplexType.Obverse; },
				getReverse: function() { return anyComplexType.Reverse; },
		
				setName: function(val) { anyComplexType.name = val; },
				setFace: function(val) { anyComplexType.face = val; },
				setBack: function(val) { anyComplexType.back = val; },
				setOpened: function(val) { anyComplexType.opened = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setObverse: function(val) { anyComplexType.Obverse = val; },
				setReverse: function(val) { anyComplexType.Reverse = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Obverse":
								var Obverse = h.Locator("School.Port.Adaptor.Data.School.Documents.File.Obverse");
								Obverse.fromXmlParser(parser,self,callback);
								self.setObverse(Obverse);
								break;
							case "Reverse":
								var Reverse = h.Locator("School.Port.Adaptor.Data.School.Documents.File.Reverse");
								Reverse.fromXmlParser(parser,self,callback);
								self.setReverse(Reverse);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "name":
								self.setName(t);
								break;
							case "face":
								self.setFace(t);
								break;
							case "back":
								self.setBack(t);
								break;
							case "opened":
								self.setOpened(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					prop = this.getFace();
					if( prop !== null ) {
						str += "<face>"+this.getFace()+"</face>";
					}
					prop = this.getBack();
					if( prop !== null ) {
						str += "<back>"+this.getBack()+"</back>";
					}
					prop = this.getOpened();
					if( prop !== null ) {
						str += "<opened>"+this.getOpened()+"</opened>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getObverse();
					if(prop !== null) {
						str += this.getObverse().toXmlStr();
					}
					var prop = this.getReverse();
					if(prop !== null) {
						str += this.getReverse().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(File);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.File.Obverse", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Obverse";
			var anyComplexType = {
				name: null,
				Large: null,
				Thumb: null
			};
			var Obverse = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getName: function() { return anyComplexType.name; },
				getLarge: function() { return anyComplexType.Large; },
				getThumb: function() { return anyComplexType.Thumb; },
		
				setName: function(val) { anyComplexType.name = val; },
				setLarge: function(val) { anyComplexType.Large = val; },
				setThumb: function(val) { anyComplexType.Thumb = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Large":
								var Large = h.Locator("School.Port.Adaptor.Data.School.Documents.SideType.Large");
								Large.fromXmlParser(parser,self,callback);
								self.setLarge(Large);
								break;
							case "Thumb":
								var Thumb = h.Locator("School.Port.Adaptor.Data.School.Documents.SideType.Thumb");
								Thumb.fromXmlParser(parser,self,callback);
								self.setThumb(Thumb);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "name":
								self.setName(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					var prop = this.getLarge();
					if(prop !== null) {
						str += this.getLarge().toXmlStr();
					}
					var prop = this.getThumb();
					if(prop !== null) {
						str += this.getThumb().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Obverse);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.File.Reverse", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Reverse";
			var anyComplexType = {
				name: null,
				Large: null,
				Thumb: null
			};
			var Reverse = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getName: function() { return anyComplexType.name; },
				getLarge: function() { return anyComplexType.Large; },
				getThumb: function() { return anyComplexType.Thumb; },
		
				setName: function(val) { anyComplexType.name = val; },
				setLarge: function(val) { anyComplexType.Large = val; },
				setThumb: function(val) { anyComplexType.Thumb = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Large":
								var Large = h.Locator("School.Port.Adaptor.Data.School.Documents.SideType.Large");
								Large.fromXmlParser(parser,self,callback);
								self.setLarge(Large);
								break;
							case "Thumb":
								var Thumb = h.Locator("School.Port.Adaptor.Data.School.Documents.SideType.Thumb");
								Thumb.fromXmlParser(parser,self,callback);
								self.setThumb(Thumb);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "name":
								self.setName(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					var prop = this.getLarge();
					if(prop !== null) {
						str += this.getLarge().toXmlStr();
					}
					var prop = this.getThumb();
					if(prop !== null) {
						str += this.getThumb().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Reverse);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.SideType.Large", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Large";
			var anyComplexType = {
				src: null,
				width: null,
				height: null,
				size: null,
				Area: []
			};
			var Large = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getSrc: function() { return anyComplexType.src; },
				getWidth: function() { return anyComplexType.width; },
				getHeight: function() { return anyComplexType.height; },
				getSize: function() { return anyComplexType.size; },
				getArea: function() { return anyComplexType.Area; },
		
				setSrc: function(val) { anyComplexType.src = val; },
				setWidth: function(val) { anyComplexType.width = val; },
				setHeight: function(val) { anyComplexType.height = val; },
				setSize: function(val) { anyComplexType.size = val; },
				setArea: function(val) { anyComplexType.Area.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Area":
								var Area = h.Locator("School.Port.Adaptor.Data.School.Documents.Area");
								Area.fromXmlParser(parser,self,callback);
								self.setArea(Area);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "src":
								self.setSrc(t);
								break;
							case "width":
								self.setWidth(t);
								break;
							case "height":
								self.setHeight(t);
								break;
							case "size":
								self.setSize(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getSrc();
					if( prop !== null ) {
						str += "<src>"+this.getSrc()+"</src>";
					}
					prop = this.getWidth();
					if( prop !== null ) {
						str += "<width>"+this.getWidth()+"</width>";
					}
					prop = this.getHeight();
					if( prop !== null ) {
						str += "<height>"+this.getHeight()+"</height>";
					}
					prop = this.getSize();
					if( prop !== null ) {
						str += "<size>"+this.getSize()+"</size>";
					}
					prop = this.getArea();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Large);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.SideType.Thumb", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Thumb";
			var anyComplexType = {
				src: null,
				width: null,
				height: null,
				size: null,
				Area: []
			};
			var Thumb = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getSrc: function() { return anyComplexType.src; },
				getWidth: function() { return anyComplexType.width; },
				getHeight: function() { return anyComplexType.height; },
				getSize: function() { return anyComplexType.size; },
				getArea: function() { return anyComplexType.Area; },
		
				setSrc: function(val) { anyComplexType.src = val; },
				setWidth: function(val) { anyComplexType.width = val; },
				setHeight: function(val) { anyComplexType.height = val; },
				setSize: function(val) { anyComplexType.size = val; },
				setArea: function(val) { anyComplexType.Area.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Area":
								var Area = h.Locator("School.Port.Adaptor.Data.School.Documents.Area");
								Area.fromXmlParser(parser,self,callback);
								self.setArea(Area);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "src":
								self.setSrc(t);
								break;
							case "width":
								self.setWidth(t);
								break;
							case "height":
								self.setHeight(t);
								break;
							case "size":
								self.setSize(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getSrc();
					if( prop !== null ) {
						str += "<src>"+this.getSrc()+"</src>";
					}
					prop = this.getWidth();
					if( prop !== null ) {
						str += "<width>"+this.getWidth()+"</width>";
					}
					prop = this.getHeight();
					if( prop !== null ) {
						str += "<height>"+this.getHeight()+"</height>";
					}
					prop = this.getSize();
					if( prop !== null ) {
						str += "<size>"+this.getSize()+"</size>";
					}
					prop = this.getArea();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Thumb);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Documents.Area", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Documents";
			var ROOT="Area";
			var anyComplexType = {
				x: null,
				y: null,
				width: null,
				height: null,
				Ref: []
			};
			var Area = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getX: function() { return anyComplexType.x; },
				getY: function() { return anyComplexType.y; },
				getWidth: function() { return anyComplexType.width; },
				getHeight: function() { return anyComplexType.height; },
				getRef: function() { return anyComplexType.Ref; },
		
				setX: function(val) { anyComplexType.x = val; },
				setY: function(val) { anyComplexType.y = val; },
				setWidth: function(val) { anyComplexType.width = val; },
				setHeight: function(val) { anyComplexType.height = val; },
				setRef: function(val) { anyComplexType.Ref.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Ref":
								var Ref = h.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
								Ref.fromXmlParser(parser,self,callback);
								self.setRef(Ref);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "x":
								self.setX(t);
								break;
							case "y":
								self.setY(t);
								break;
							case "width":
								self.setWidth(t);
								break;
							case "height":
								self.setHeight(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getX();
					if( prop !== null ) {
						str += "<x>"+this.getX()+"</x>";
					}
					prop = this.getY();
					if( prop !== null ) {
						str += "<y>"+this.getY()+"</y>";
					}
					prop = this.getWidth();
					if( prop !== null ) {
						str += "<width>"+this.getWidth()+"</width>";
					}
					prop = this.getHeight();
					if( prop !== null ) {
						str += "<height>"+this.getHeight()+"</height>";
					}
					prop = this.getRef();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Area);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Events.Event", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Events";
			var ROOT="Event";
			var anyComplexType = {
				autouid: null,
				ID: null,
				name: null,
				dt: null,
				comments: null,
				Link: null
			};
			var Event = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getName: function() { return anyComplexType.name; },
				getDt: function() { return anyComplexType.dt; },
				getComments: function() { return anyComplexType.comments; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setName: function(val) { anyComplexType.name = val; },
				setDt: function(val) { anyComplexType.dt = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "name":
								self.setName(t);
								break;
							case "dt":
								self.setDt(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					prop = this.getDt();
					if( prop !== null ) {
						str += "<dt>"+this.getDt()+"</dt>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Event);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Events", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Events";
			var ROOT="Events";
			var anyComplexType = {
				Event: []
			};
			var Events = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getEvent: function() { return anyComplexType.Event; },
		
				setEvent: function(val) { anyComplexType.Event.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Event":
								var Event = h.Locator("School.Port.Adaptor.Data.School.Events.Event");
								Event.fromXmlParser(parser,self,callback);
								self.setEvent(Event);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getEvent();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Events);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Resources";
			var anyComplexType = {
				Ref: [],
				Persons: null,
				Staff: null,
				Forms: null,
				Unions: null,
				Documents: null,
				Digests: null,
				Events: null
			};
			var Resources = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getRef: function() { return anyComplexType.Ref; },
				getPersons: function() { return anyComplexType.Persons; },
				getStaff: function() { return anyComplexType.Staff; },
				getForms: function() { return anyComplexType.Forms; },
				getUnions: function() { return anyComplexType.Unions; },
				getDocuments: function() { return anyComplexType.Documents; },
				getDigests: function() { return anyComplexType.Digests; },
				getEvents: function() { return anyComplexType.Events; },
		
				setRef: function(val) { anyComplexType.Ref.push(val); },
				setPersons: function(val) { anyComplexType.Persons = val; },
				setStaff: function(val) { anyComplexType.Staff = val; },
				setForms: function(val) { anyComplexType.Forms = val; },
				setUnions: function(val) { anyComplexType.Unions = val; },
				setDocuments: function(val) { anyComplexType.Documents = val; },
				setDigests: function(val) { anyComplexType.Digests = val; },
				setEvents: function(val) { anyComplexType.Events = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Ref":
								var Ref = h.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
								Ref.fromXmlParser(parser,self,callback);
								self.setRef(Ref);
								break;
							case "Persons":
								var Persons = h.Locator("School.Port.Adaptor.Data.School.Persons");
								Persons.fromXmlParser(parser,self,callback);
								self.setPersons(Persons);
								break;
							case "Staff":
								var Staff = h.Locator("School.Port.Adaptor.Data.School.Persons.Staff");
								Staff.fromXmlParser(parser,self,callback);
								self.setStaff(Staff);
								break;
							case "Forms":
								var Forms = h.Locator("School.Port.Adaptor.Data.School.Unions.Forms");
								Forms.fromXmlParser(parser,self,callback);
								self.setForms(Forms);
								break;
							case "Unions":
								var Unions = h.Locator("School.Port.Adaptor.Data.School.Unions");
								Unions.fromXmlParser(parser,self,callback);
								self.setUnions(Unions);
								break;
							case "Documents":
								var Documents = h.Locator("School.Port.Adaptor.Data.School.Documents");
								Documents.fromXmlParser(parser,self,callback);
								self.setDocuments(Documents);
								break;
							case "Digests":
								var Digests = h.Locator("School.Port.Adaptor.Data.School.Digests");
								Digests.fromXmlParser(parser,self,callback);
								self.setDigests(Digests);
								break;
							case "Events":
								var Events = h.Locator("School.Port.Adaptor.Data.School.Events");
								Events.fromXmlParser(parser,self,callback);
								self.setEvents(Events);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getRef();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					var prop = this.getPersons();
					if(prop !== null) {
						str += this.getPersons().toXmlStr();
					}
					var prop = this.getStaff();
					if(prop !== null) {
						str += this.getStaff().toXmlStr();
					}
					var prop = this.getForms();
					if(prop !== null) {
						str += this.getForms().toXmlStr();
					}
					var prop = this.getUnions();
					if(prop !== null) {
						str += this.getUnions().toXmlStr();
					}
					var prop = this.getDocuments();
					if(prop !== null) {
						str += this.getDocuments().toXmlStr();
					}
					var prop = this.getDigests();
					if(prop !== null) {
						str += this.getDigests().toXmlStr();
					}
					var prop = this.getEvents();
					if(prop !== null) {
						str += this.getEvents().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Resources);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Resource", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Resource";
			var anyComplexType = {
				ID: null,
				type: null,
				key1: null,
				key2: null,
				key3: null,
				key4: null
			};
			var Resource = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getID: function() { return anyComplexType.ID; },
				getType: function() { return anyComplexType.type; },
				getKey1: function() { return anyComplexType.key1; },
				getKey2: function() { return anyComplexType.key2; },
				getKey3: function() { return anyComplexType.key3; },
				getKey4: function() { return anyComplexType.key4; },
		
				setID: function(val) { anyComplexType.ID = val; },
				setType: function(val) { anyComplexType.type = val; },
				setKey1: function(val) { anyComplexType.key1 = val; },
				setKey2: function(val) { anyComplexType.key2 = val; },
				setKey3: function(val) { anyComplexType.key3 = val; },
				setKey4: function(val) { anyComplexType.key4 = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "ID":
								self.setID(t);
								break;
							case "type":
								self.setType(t);
								break;
							case "key1":
								self.setKey1(t);
								break;
							case "key2":
								self.setKey2(t);
								break;
							case "key3":
								self.setKey3(t);
								break;
							case "key4":
								self.setKey4(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getType();
					if( prop !== null ) {
						str += "<type>"+this.getType()+"</type>";
					}
					prop = this.getKey1();
					if( prop !== null ) {
						str += "<key1>"+this.getKey1()+"</key1>";
					}
					prop = this.getKey2();
					if( prop !== null ) {
						str += "<key2>"+this.getKey2()+"</key2>";
					}
					prop = this.getKey3();
					if( prop !== null ) {
						str += "<key3>"+this.getKey3()+"</key3>";
					}
					prop = this.getKey4();
					if( prop !== null ) {
						str += "<key4>"+this.getKey4()+"</key4>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Resource);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Ref", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Ref";
			var anyComplexType = {
				rel: null,
				href: null
			};
			var Ref = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getRel: function() { return anyComplexType.rel; },
				getHref: function() { return anyComplexType.href; },
		
				setRel: function(val) { anyComplexType.rel = val; },
				setHref: function(val) { anyComplexType.href = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "rel":
								self.setRel(t);
								break;
							case "href":
								self.setHref(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getRel();
					if( prop !== null ) {
						str += "<rel>"+this.getRel()+"</rel>";
					}
					prop = this.getHref();
					if( prop !== null ) {
						str += "<href>"+this.getHref()+"</href>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Ref);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Statistics", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Statistics";
			var anyComplexType = {
				Total: null,
				Identified: null,
				Published: null
			};
			var Statistics = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getTotal: function() { return anyComplexType.Total; },
				getIdentified: function() { return anyComplexType.Identified; },
				getPublished: function() { return anyComplexType.Published; },
		
				setTotal: function(val) { anyComplexType.Total = val; },
				setIdentified: function(val) { anyComplexType.Identified = val; },
				setPublished: function(val) { anyComplexType.Published = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Total":
								var Total = h.Locator("School.Port.Adaptor.Data.School.Resources.Total");
								Total.fromXmlParser(parser,self,callback);
								self.setTotal(Total);
								break;
							case "Identified":
								var Identified = h.Locator("School.Port.Adaptor.Data.School.Resources.Identified");
								Identified.fromXmlParser(parser,self,callback);
								self.setIdentified(Identified);
								break;
							case "Published":
								var Published = h.Locator("School.Port.Adaptor.Data.School.Resources.Published");
								Published.fromXmlParser(parser,self,callback);
								self.setPublished(Published);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					var prop = this.getTotal();
					if(prop !== null) {
						str += this.getTotal().toXmlStr();
					}
					var prop = this.getIdentified();
					if(prop !== null) {
						str += this.getIdentified().toXmlStr();
					}
					var prop = this.getPublished();
					if(prop !== null) {
						str += this.getPublished().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Statistics);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Total", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Total";
			var anyComplexType = {
				documents: null,
				files: null,
				forms: null,
				persons: null,
				unions: null,
				events: null,
				staff: null
			};
			var Total = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getDocuments: function() { return anyComplexType.documents; },
				getFiles: function() { return anyComplexType.files; },
				getForms: function() { return anyComplexType.forms; },
				getPersons: function() { return anyComplexType.persons; },
				getUnions: function() { return anyComplexType.unions; },
				getEvents: function() { return anyComplexType.events; },
				getStaff: function() { return anyComplexType.staff; },
		
				setDocuments: function(val) { anyComplexType.documents = val; },
				setFiles: function(val) { anyComplexType.files = val; },
				setForms: function(val) { anyComplexType.forms = val; },
				setPersons: function(val) { anyComplexType.persons = val; },
				setUnions: function(val) { anyComplexType.unions = val; },
				setEvents: function(val) { anyComplexType.events = val; },
				setStaff: function(val) { anyComplexType.staff = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "documents":
								self.setDocuments(t);
								break;
							case "files":
								self.setFiles(t);
								break;
							case "forms":
								self.setForms(t);
								break;
							case "persons":
								self.setPersons(t);
								break;
							case "unions":
								self.setUnions(t);
								break;
							case "events":
								self.setEvents(t);
								break;
							case "staff":
								self.setStaff(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getDocuments();
					if( prop !== null ) {
						str += "<documents>"+this.getDocuments()+"</documents>";
					}
					prop = this.getFiles();
					if( prop !== null ) {
						str += "<files>"+this.getFiles()+"</files>";
					}
					prop = this.getForms();
					if( prop !== null ) {
						str += "<forms>"+this.getForms()+"</forms>";
					}
					prop = this.getPersons();
					if( prop !== null ) {
						str += "<persons>"+this.getPersons()+"</persons>";
					}
					prop = this.getUnions();
					if( prop !== null ) {
						str += "<unions>"+this.getUnions()+"</unions>";
					}
					prop = this.getEvents();
					if( prop !== null ) {
						str += "<events>"+this.getEvents()+"</events>";
					}
					prop = this.getStaff();
					if( prop !== null ) {
						str += "<staff>"+this.getStaff()+"</staff>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Total);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Identified", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Identified";
			var anyComplexType = {
				photos: null,
				docs: null,
				articles: null,
				albums: null,
				letters: null
			};
			var Identified = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getPhotos: function() { return anyComplexType.photos; },
				getDocs: function() { return anyComplexType.docs; },
				getArticles: function() { return anyComplexType.articles; },
				getAlbums: function() { return anyComplexType.albums; },
				getLetters: function() { return anyComplexType.letters; },
		
				setPhotos: function(val) { anyComplexType.photos = val; },
				setDocs: function(val) { anyComplexType.docs = val; },
				setArticles: function(val) { anyComplexType.articles = val; },
				setAlbums: function(val) { anyComplexType.albums = val; },
				setLetters: function(val) { anyComplexType.letters = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "photos":
								self.setPhotos(t);
								break;
							case "docs":
								self.setDocs(t);
								break;
							case "articles":
								self.setArticles(t);
								break;
							case "albums":
								self.setAlbums(t);
								break;
							case "letters":
								self.setLetters(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getPhotos();
					if( prop !== null ) {
						str += "<photos>"+this.getPhotos()+"</photos>";
					}
					prop = this.getDocs();
					if( prop !== null ) {
						str += "<docs>"+this.getDocs()+"</docs>";
					}
					prop = this.getArticles();
					if( prop !== null ) {
						str += "<articles>"+this.getArticles()+"</articles>";
					}
					prop = this.getAlbums();
					if( prop !== null ) {
						str += "<albums>"+this.getAlbums()+"</albums>";
					}
					prop = this.getLetters();
					if( prop !== null ) {
						str += "<letters>"+this.getLetters()+"</letters>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Identified);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Resources.Published", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Resources";
			var ROOT="Published";
			var anyComplexType = {
				photos: null,
				docs: null,
				articles: null,
				albums: null,
				letters: null
			};
			var Published = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getPhotos: function() { return anyComplexType.photos; },
				getDocs: function() { return anyComplexType.docs; },
				getArticles: function() { return anyComplexType.articles; },
				getAlbums: function() { return anyComplexType.albums; },
				getLetters: function() { return anyComplexType.letters; },
		
				setPhotos: function(val) { anyComplexType.photos = val; },
				setDocs: function(val) { anyComplexType.docs = val; },
				setArticles: function(val) { anyComplexType.articles = val; },
				setAlbums: function(val) { anyComplexType.albums = val; },
				setLetters: function(val) { anyComplexType.letters = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "photos":
								self.setPhotos(t);
								break;
							case "docs":
								self.setDocs(t);
								break;
							case "articles":
								self.setArticles(t);
								break;
							case "albums":
								self.setAlbums(t);
								break;
							case "letters":
								self.setLetters(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getPhotos();
					if( prop !== null ) {
						str += "<photos>"+this.getPhotos()+"</photos>";
					}
					prop = this.getDocs();
					if( prop !== null ) {
						str += "<docs>"+this.getDocs()+"</docs>";
					}
					prop = this.getArticles();
					if( prop !== null ) {
						str += "<articles>"+this.getArticles()+"</articles>";
					}
					prop = this.getAlbums();
					if( prop !== null ) {
						str += "<albums>"+this.getAlbums()+"</albums>";
					}
					prop = this.getLetters();
					if( prop !== null ) {
						str += "<letters>"+this.getLetters()+"</letters>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Published);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Links.Link", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Links";
			var ROOT="Link";
			var anyComplexType = {
				autouid: null,
				ID: null,
				source: null,
				destination: null,
				dtStart: null,
				dtEnd: null,
				type: null,
				comments: null,
				Ref: []
			};
			var Link = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getSource: function() { return anyComplexType.source; },
				getDestination: function() { return anyComplexType.destination; },
				getDtStart: function() { return anyComplexType.dtStart; },
				getDtEnd: function() { return anyComplexType.dtEnd; },
				getType: function() { return anyComplexType.type; },
				getComments: function() { return anyComplexType.comments; },
				getRef: function() { return anyComplexType.Ref; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setSource: function(val) { anyComplexType.source = val; },
				setDestination: function(val) { anyComplexType.destination = val; },
				setDtStart: function(val) { anyComplexType.dtStart = val; },
				setDtEnd: function(val) { anyComplexType.dtEnd = val; },
				setType: function(val) { anyComplexType.type = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setRef: function(val) { anyComplexType.Ref.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Ref":
								var Ref = h.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
								Ref.fromXmlParser(parser,self,callback);
								self.setRef(Ref);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "source":
								self.setSource(t);
								break;
							case "destination":
								self.setDestination(t);
								break;
							case "dtStart":
								self.setDtStart(t);
								break;
							case "dtEnd":
								self.setDtEnd(t);
								break;
							case "type":
								self.setType(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getSource();
					if( prop !== null ) {
						str += "<source>"+this.getSource()+"</source>";
					}
					prop = this.getDestination();
					if( prop !== null ) {
						str += "<destination>"+this.getDestination()+"</destination>";
					}
					prop = this.getDtStart();
					if( prop !== null ) {
						str += "<dtStart>"+this.getDtStart()+"</dtStart>";
					}
					prop = this.getDtEnd();
					if( prop !== null ) {
						str += "<dtEnd>"+this.getDtEnd()+"</dtEnd>";
					}
					prop = this.getType();
					if( prop !== null ) {
						str += "<type>"+this.getType()+"</type>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					prop = this.getRef();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Link);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Links", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Links";
			var ROOT="Links";
			var anyComplexType = {
				Link: []
			};
			var Links = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getLink: function() { return anyComplexType.Link; },
		
				setLink: function(val) { anyComplexType.Link.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getLink();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Links);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Digests.Digest", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Digests";
			var ROOT="Digest";
			var anyComplexType = {
				ID: null,
				published: null,
				title: null,
				comments: null,
				Link: null
			};
			var Digest = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getID: function() { return anyComplexType.ID; },
				getPublished: function() { return anyComplexType.published; },
				getTitle: function() { return anyComplexType.title; },
				getComments: function() { return anyComplexType.comments; },
				getLink: function() { return anyComplexType.Link; },
		
				setID: function(val) { anyComplexType.ID = val; },
				setPublished: function(val) { anyComplexType.published = val; },
				setTitle: function(val) { anyComplexType.title = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "ID":
								self.setID(t);
								break;
							case "published":
								self.setPublished(t);
								break;
							case "title":
								self.setTitle(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getPublished();
					if( prop !== null ) {
						str += "<published>"+this.getPublished()+"</published>";
					}
					prop = this.getTitle();
					if( prop !== null ) {
						str += "<title>"+this.getTitle()+"</title>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Digest);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Digests", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Digests";
			var ROOT="Digests";
			var anyComplexType = {
				Digest: []
			};
			var Digests = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getDigest: function() { return anyComplexType.Digest; },
		
				setDigest: function(val) { anyComplexType.Digest.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Digest":
								var Digest = h.Locator("School.Port.Adaptor.Data.School.Digests.Digest");
								Digest.fromXmlParser(parser,self,callback);
								self.setDigest(Digest);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getDigest();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Digests);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Images.Image", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Images";
			var ROOT="Image";
			var anyComplexType = {
				autoid: null,
				ID: null,
				src: null,
				name: null,
				width: null,
				height: null,
				Area: [],
				Ref: []
			};
			var Image = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutoid: function() { return anyComplexType.autoid; },
				getID: function() { return anyComplexType.ID; },
				getSrc: function() { return anyComplexType.src; },
				getName: function() { return anyComplexType.name; },
				getWidth: function() { return anyComplexType.width; },
				getHeight: function() { return anyComplexType.height; },
				getArea: function() { return anyComplexType.Area; },
				getRef: function() { return anyComplexType.Ref; },
		
				setAutoid: function(val) { anyComplexType.autoid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setSrc: function(val) { anyComplexType.src = val; },
				setName: function(val) { anyComplexType.name = val; },
				setWidth: function(val) { anyComplexType.width = val; },
				setHeight: function(val) { anyComplexType.height = val; },
				setArea: function(val) { anyComplexType.Area.push(val); },
				setRef: function(val) { anyComplexType.Ref.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Area":
								var Area = h.Locator("School.Port.Adaptor.Data.School.Images.Area");
								Area.fromXmlParser(parser,self,callback);
								self.setArea(Area);
								break;
							case "Ref":
								var Ref = h.Locator("School.Port.Adaptor.Data.School.Resources.Ref");
								Ref.fromXmlParser(parser,self,callback);
								self.setRef(Ref);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autoid":
								self.setAutoid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "src":
								self.setSrc(t);
								break;
							case "name":
								self.setName(t);
								break;
							case "width":
								self.setWidth(t);
								break;
							case "height":
								self.setHeight(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutoid();
					if( prop !== null ) {
						str += "<autoid>"+this.getAutoid()+"</autoid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getSrc();
					if( prop !== null ) {
						str += "<src>"+this.getSrc()+"</src>";
					}
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					prop = this.getWidth();
					if( prop !== null ) {
						str += "<width>"+this.getWidth()+"</width>";
					}
					prop = this.getHeight();
					if( prop !== null ) {
						str += "<height>"+this.getHeight()+"</height>";
					}
					prop = this.getArea();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					prop = this.getRef();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Image);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Images.Area", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Images";
			var ROOT="Area";
			var anyComplexType = {
				x: null,
				y: null,
				width: null,
				height: null,
				size: null
			};
			var Area = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getX: function() { return anyComplexType.x; },
				getY: function() { return anyComplexType.y; },
				getWidth: function() { return anyComplexType.width; },
				getHeight: function() { return anyComplexType.height; },
				getSize: function() { return anyComplexType.size; },
		
				setX: function(val) { anyComplexType.x = val; },
				setY: function(val) { anyComplexType.y = val; },
				setWidth: function(val) { anyComplexType.width = val; },
				setHeight: function(val) { anyComplexType.height = val; },
				setSize: function(val) { anyComplexType.size = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "x":
								self.setX(t);
								break;
							case "y":
								self.setY(t);
								break;
							case "width":
								self.setWidth(t);
								break;
							case "height":
								self.setHeight(t);
								break;
							case "size":
								self.setSize(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getX();
					if( prop !== null ) {
						str += "<x>"+this.getX()+"</x>";
					}
					prop = this.getY();
					if( prop !== null ) {
						str += "<y>"+this.getY()+"</y>";
					}
					prop = this.getWidth();
					if( prop !== null ) {
						str += "<width>"+this.getWidth()+"</width>";
					}
					prop = this.getHeight();
					if( prop !== null ) {
						str += "<height>"+this.getHeight()+"</height>";
					}
					prop = this.getSize();
					if( prop !== null ) {
						str += "<size>"+this.getSize()+"</size>";
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Area);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Images", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Images";
			var ROOT="Images";
			var anyComplexType = {
				Image: []
			};
			var Images = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getImage: function() { return anyComplexType.Image; },
		
				setImage: function(val) { anyComplexType.Image.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Image":
								var Image = h.Locator("School.Port.Adaptor.Data.School.Images.Image");
								Image.fromXmlParser(parser,self,callback);
								self.setImage(Image);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getImage();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Images);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Videos.Video", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Videos";
			var ROOT="Video";
			var anyComplexType = {
				autouid: null,
				ID: null,
				name: null,
				year: null,
				comments: null,
				href: null,
				Link: null
			};
			var Video = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getAutouid: function() { return anyComplexType.autouid; },
				getID: function() { return anyComplexType.ID; },
				getName: function() { return anyComplexType.name; },
				getYear: function() { return anyComplexType.year; },
				getComments: function() { return anyComplexType.comments; },
				getHref: function() { return anyComplexType.href; },
				getLink: function() { return anyComplexType.Link; },
		
				setAutouid: function(val) { anyComplexType.autouid = val; },
				setID: function(val) { anyComplexType.ID = val; },
				setName: function(val) { anyComplexType.name = val; },
				setYear: function(val) { anyComplexType.year = val; },
				setComments: function(val) { anyComplexType.comments = val; },
				setHref: function(val) { anyComplexType.href = val; },
				setLink: function(val) { anyComplexType.Link = val; },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Link":
								var Link = h.Locator("School.Port.Adaptor.Data.School.Links.Link");
								Link.fromXmlParser(parser,self,callback);
								self.setLink(Link);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							case "autouid":
								self.setAutouid(t);
								break;
							case "ID":
								self.setID(t);
								break;
							case "name":
								self.setName(t);
								break;
							case "year":
								self.setYear(t);
								break;
							case "comments":
								self.setComments(t);
								break;
							case "href":
								self.setHref(t);
								break;
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getAutouid();
					if( prop !== null ) {
						str += "<autouid>"+this.getAutouid()+"</autouid>";
					}
					prop = this.getID();
					if( prop !== null ) {
						str += "<ID>"+this.getID()+"</ID>";
					}
					prop = this.getName();
					if( prop !== null ) {
						str += "<name>"+this.getName()+"</name>";
					}
					prop = this.getYear();
					if( prop !== null ) {
						str += "<year>"+this.getYear()+"</year>";
					}
					prop = this.getComments();
					if( prop !== null ) {
						str += "<comments>"+this.getComments()+"</comments>";
					}
					prop = this.getHref();
					if( prop !== null ) {
						str += "<href>"+this.getHref()+"</href>";
					}
					var prop = this.getLink();
					if(prop !== null) {
						str += this.getLink().toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Video);
		}());
	});

	h.Locator( "School.Port.Adaptor.Data.School.Videos", function() {
		
		return (function(){
		
			var NS="urn:ru:battleship:School:Videos";
			var ROOT="Videos";
			var anyComplexType = {
				Video: []
			};
			var Videos = h.Port.Adaptor.Data.XML.Schema.AnyComplexType.extend({
		
				getVideo: function() { return anyComplexType.Video; },
		
				setVideo: function(val) { anyComplexType.Video.push(val); },
				getAll: function() { return anyComplexType; },
				setAll: function(obj) { anyComplexType=obj; },
				fromXmlParser: function(parser,parent,callback) {
					this.parent = parent;
					var self = this;
					
					if(parser.tag.isSelfClosing === true && parent !== null) {
						parent.fromXmlParser(parser,parent.parent,callback);
					}
					parser.onclosetag = function(tag) {
						if(tag == ROOT && parent !== null) {
							parent.fromXmlParser(parser,parent.parent,callback);
						}else if(tag == ROOT && parent === null) {
							callback(self);
						}
					};
					parser.onopentag = function(node) {
						switch(node.name) {
							case "Video":
								var Video = h.Locator("School.Port.Adaptor.Data.School.Videos.Video");
								Video.fromXmlParser(parser,self,callback);
								self.setVideo(Video);
								break;
							default:
								break;
						}
					};
					parser.ontext = function(t) {
						switch(parser.tag.name) {
							default:
								break;
						}
					};
				},
				toXmlStr: function() {
					var prop, str;
					str = "<"+ROOT+" xmlns='"+NS+"'>";
					prop = this.getVideo();
					var len = prop.length;
					for(var i=0;i < len;i++ ) {
						str += prop[i].toXmlStr();
					}
					str += "</"+ROOT+">";
					return str;
				}
			});
			return h.Model.extend(Videos);
		}());
	});

}(Happymeal));
	