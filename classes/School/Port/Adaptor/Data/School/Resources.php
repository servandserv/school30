<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Resources extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Resources";
		const PREF = NULL;
		/**
		 * @maxOccurs unbound 
		 * @var School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		protected $Ref = [];
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Persons
		 */
		protected $Persons = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Persons\Staff
		 */
		protected $Staff = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Unions\Forms
		 */
		protected $Forms = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Unions
		 */
		protected $Unions = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Documents
		 */
		protected $Documents = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Digests
		 */
		protected $Digests = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Events
		 */
		protected $Events = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Ref"] = array(
				"prop"=>"Ref",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Ref
			);
			$this->_properties["Persons"] = array(
				"prop"=>"Persons",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Persons
			);
			$this->_properties["Staff"] = array(
				"prop"=>"Staff",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Staff
			);
			$this->_properties["Forms"] = array(
				"prop"=>"Forms",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Forms
			);
			$this->_properties["Unions"] = array(
				"prop"=>"Unions",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Unions
			);
			$this->_properties["Documents"] = array(
				"prop"=>"Documents",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Documents
			);
			$this->_properties["Digests"] = array(
				"prop"=>"Digests",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Digests
			);
			$this->_properties["Events"] = array(
				"prop"=>"Events",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Events
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Ref $val
		 */
		public function setRef ( \School\Port\Adaptor\Data\School\Resources\Ref $val ) {
			$this->Ref[] = $val;
			$this->_properties["Ref"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		public function setRefArray ( array $vals ) {
			$this->Ref = $vals;
			$this->_properties["Ref"]["text"] = $vals;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Persons $val
		 */
		public function setPersons ( \School\Port\Adaptor\Data\School\Persons $val ) {
			$this->Persons = $val;
			$this->_properties["Persons"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Persons\Staff $val
		 */
		public function setStaff ( \School\Port\Adaptor\Data\School\Persons\Staff $val ) {
			$this->Staff = $val;
			$this->_properties["Staff"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Forms $val
		 */
		public function setForms ( \School\Port\Adaptor\Data\School\Unions\Forms $val ) {
			$this->Forms = $val;
			$this->_properties["Forms"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions $val
		 */
		public function setUnions ( \School\Port\Adaptor\Data\School\Unions $val ) {
			$this->Unions = $val;
			$this->_properties["Unions"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents $val
		 */
		public function setDocuments ( \School\Port\Adaptor\Data\School\Documents $val ) {
			$this->Documents = $val;
			$this->_properties["Documents"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Digests $val
		 */
		public function setDigests ( \School\Port\Adaptor\Data\School\Digests $val ) {
			$this->Digests = $val;
			$this->_properties["Digests"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Events $val
		 */
		public function setEvents ( \School\Port\Adaptor\Data\School\Events $val ) {
			$this->Events = $val;
			$this->_properties["Events"]["text"] = $val;
			return $this;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Resources\Ref | []
		 */
		public function getRef($index = null) {
			if( $index !== null ) {
				$res = isset($this->Ref[$index]) ? $this->Ref[$index] : null;
			} else {
				$res = $this->Ref;
			}
			return $res;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Persons
		 */
		public function getPersons() {
			return $this->Persons;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Persons\Staff
		 */
		public function getStaff() {
			return $this->Staff;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Unions\Forms
		 */
		public function getForms() {
			return $this->Forms;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Unions
		 */
		public function getUnions() {
			return $this->Unions;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Documents
		 */
		public function getDocuments() {
			return $this->Documents;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Digests
		 */
		public function getDigests() {
			return $this->Digests;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Events
		 */
		public function getEvents() {
			return $this->Events;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\ResourcesValidator( $this, $handler );
			$validator->validate();
		}
			
		
		public function toXmlStr( $xmlns=self::NS, $xmlname=self::ROOT ) {
			return parent::toXmlStr($xmlns,$xmlname);
		}

		/**
		* Вывод в XMLWriter
		* @codegen true
		* @param XMLWriter $xw
		* @param string $xmlname Имя корневого узла
		* @param string $xmlns Пространство имен
		* @param int $mode
		*/
		public function toXmlWriter ( \XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS, $mode = \Adaptor_XML::ELEMENT ) {
			if( $mode & \Adaptor_XML::STARTELEMENT ) $xw->startElementNS( NULL, $xmlname, $xmlns );
			$this->attributesToXmlWriter( $xw, $xmlname, $xmlns );
			$this->elementsToXmlWriter( $xw, $xmlname, $xmlns );
			if( $mode & \Adaptor_XML::ENDELEMENT ) $xw->endElement();
		}
				
		/**
		* Вывод атрибутов в \XMLWriter
		* @param \XMLWriter $xw
		* @param string $xmlname Имя корневого узла
		* @param string $xmlns Пространство имен
		*/
		protected function attributesToXmlWriter ( \XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS ) {
			parent::attributesToXmlWriter( $xw, $xmlname, $xmlns );
		}
		/**
		* Вывод элементов в \XMLWriter
		* @param \XMLWriter $xw
		* @param string $xmlname Имя корневого узла
		* @param string $xmlns Пространство имен
		*/
		protected function elementsToXmlWriter ( \XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS ) {
			parent::elementsToXmlWriter( $xw, $xmlname, $xmlns );
			if( $props = $this->getRef() ) {
				foreach( $props as $prop ) {
					$prop->toXmlWriter( $xw );
				}
			}
			if( ($prop = $this->getPersons()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getStaff()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getForms()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getUnions()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getDocuments()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getDigests()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getEvents()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
		}

		/**
		 * Чтение атрибутов из \XMLReader
		 * @param \XMLReader $xr
		 */
		public function attributesFromXmlReader ( \XMLReader &$xr ) {
			parent::attributesFromXmlReader( $xr );	
		}
				
		/**
		 * Чтение элементов из \XMLReader
		 * @param \XMLReader $xr
		 */
		public function elementsFromXmlReader ( \XMLReader &$xr ) {
			switch ( $xr->localName ) {
				case "Ref":
					$Ref = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Resources\\Ref");
					$this->setRef( $Ref->fromXmlReader( $xr ) );
					break;
				case "Persons":
					$Persons = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons");
					$this->setPersons( $Persons->fromXmlReader( $xr ) );
					break;
				case "Staff":
					$Staff = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons\\Staff");
					$this->setStaff( $Staff->fromXmlReader( $xr ) );
					break;
				case "Forms":
					$Forms = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Forms");
					$this->setForms( $Forms->fromXmlReader( $xr ) );
					break;
				case "Unions":
					$Unions = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions");
					$this->setUnions( $Unions->fromXmlReader( $xr ) );
					break;
				case "Documents":
					$Documents = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents");
					$this->setDocuments( $Documents->fromXmlReader( $xr ) );
					break;
				case "Digests":
					$Digests = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Digests");
					$this->setDigests( $Digests->fromXmlReader( $xr ) );
					break;
				case "Events":
					$Events = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Events");
					$this->setEvents( $Events->fromXmlReader( $xr ) );
					break;
				default:
					parent::elementsFromXmlReader( $xr );
			}
		}
		/**
		 * Чтение данных JSON объекта, результата работы json_decode,
		 * в объект
		 * @param mixed array | stdObject
		 *
		 */
		public function fromJSON( $arg ) {
			parent::fromJSON( $arg );
			$props = [];
			if( is_array( $arg ) ) {
				$props = $arg;
			} elseif( is_object( $arg ) ) {
				foreach( $arg as $k=>$v ) {
					$props[$k] = $v;
				}
			}
			if(isset($props["Ref"])) {
				if( is_array($props["Ref"]) ) {
					foreach($props["Ref"] as $k=>$v) {
						$Ref = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Resources\\Ref");
						$Ref->fromJSON($v);
						$this->setRef($Ref);
					}
				}
			}
			if(isset($props["Persons"])) {
				$Persons = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons");
				$Persons->fromJSON($props["Persons"]);
				$this->setPersons($Persons);
			}
			if(isset($props["Staff"])) {
				$Staff = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons\\Staff");
				$Staff->fromJSON($props["Staff"]);
				$this->setStaff($Staff);
			}
			if(isset($props["Forms"])) {
				$Forms = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Forms");
				$Forms->fromJSON($props["Forms"]);
				$this->setForms($Forms);
			}
			if(isset($props["Unions"])) {
				$Unions = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions");
				$Unions->fromJSON($props["Unions"]);
				$this->setUnions($Unions);
			}
			if(isset($props["Documents"])) {
				$Documents = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents");
				$Documents->fromJSON($props["Documents"]);
				$this->setDocuments($Documents);
			}
			if(isset($props["Digests"])) {
				$Digests = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Digests");
				$Digests->fromJSON($props["Digests"]);
				$this->setDigests($Digests);
			}
			if(isset($props["Events"])) {
				$Events = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Events");
				$Events->fromJSON($props["Events"]);
				$this->setEvents($Events);
			}
		}
		
	}
		

