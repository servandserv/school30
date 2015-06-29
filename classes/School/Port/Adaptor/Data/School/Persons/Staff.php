<?php
	namespace School\Port\Adaptor\Data\School\Persons;
		
	class Staff extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Persons";
		const ROOT = "Staff";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Persons\Person[]
		 */
		protected $Person = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Person"] = array(
				"prop"=>"Person",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Person
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Persons\Person $val
		 */
		public function setPerson ( \School\Port\Adaptor\Data\School\Persons\Person $val ) {
			$this->Person[] = $val;
			$this->_properties["Person"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Persons\Person[]
		 */
		public function setPersonArray ( array $vals ) {
			$this->Person = $vals;
			$this->_properties["Person"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Persons\Person | []
		 */
		public function getPerson($index = null) {
			if( $index !== null ) {
				$res = isset($this->Person[$index]) ? $this->Person[$index] : null;
			} else {
				$res = $this->Person;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Persons\StaffValidator( $this, $handler );
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
			if( $props = $this->getPerson() ) {
				foreach( $props as $prop ) {
					$prop->toXmlWriter( $xw );
				}
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
				case "Person":
					$Person = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons\\Person");
					$this->setPerson( $Person->fromXmlReader( $xr ) );
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
			if(isset($props["Person"])) {
				if( is_array($props["Person"]) ) {
					foreach($props["Person"] as $k=>$v) {
						$Person = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons\\Person");
						$Person->fromJSON($v);
						$this->setPerson($Person);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Person = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Persons\\Person");
					$Person->fromJSON($v);
					$this->setPerson($Person);
				}
			}
		}
		
	}
		

