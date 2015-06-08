<?php
	namespace School\Port\Adaptor\Data\School\Resources;
		
	class Resource extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Resource";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $ID = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Type = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Key1 = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Key2 = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Key3 = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Key4 = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["ID"] = array(
				"prop"=>"ID",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->ID
			);
			$this->_properties["type"] = array(
				"prop"=>"Type",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Type
			);
			$this->_properties["key1"] = array(
				"prop"=>"Key1",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Key1
			);
			$this->_properties["key2"] = array(
				"prop"=>"Key2",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Key2
			);
			$this->_properties["key3"] = array(
				"prop"=>"Key3",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Key3
			);
			$this->_properties["key4"] = array(
				"prop"=>"Key4",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Key4
			);
		}
		/**
		 * @param \String $val
		 */
		public function setID (  $val ) {
			$this->ID = $val;
			$this->_properties["ID"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setType (  $val ) {
			$this->Type = $val;
			$this->_properties["type"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setKey1 (  $val ) {
			$this->Key1 = $val;
			$this->_properties["key1"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setKey2 (  $val ) {
			$this->Key2 = $val;
			$this->_properties["key2"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setKey3 (  $val ) {
			$this->Key3 = $val;
			$this->_properties["key3"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setKey4 (  $val ) {
			$this->Key4 = $val;
			$this->_properties["key4"]["text"] = $val;
		}
		/**
		 * @return \String
		 */
		public function getID() {
			return $this->ID;
		}
		/**
		 * @return \String
		 */
		public function getType() {
			return $this->Type;
		}
		/**
		 * @return \String
		 */
		public function getKey1() {
			return $this->Key1;
		}
		/**
		 * @return \String
		 */
		public function getKey2() {
			return $this->Key2;
		}
		/**
		 * @return \String
		 */
		public function getKey3() {
			return $this->Key3;
		}
		/**
		 * @return \String
		 */
		public function getKey4() {
			return $this->Key4;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Resources\ResourceValidator( $this, $handler );
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
			if( ($prop = $this->getID()) !== NULL ) {
				$xw->writeElement( 'ID', $prop );
			}
			if( ($prop = $this->getType()) !== NULL ) {
				$xw->writeElement( 'type', $prop );
			}
			if( ($prop = $this->getKey1()) !== NULL ) {
				$xw->writeElement( 'key1', $prop );
			}
			if( ($prop = $this->getKey2()) !== NULL ) {
				$xw->writeElement( 'key2', $prop );
			}
			if( ($prop = $this->getKey3()) !== NULL ) {
				$xw->writeElement( 'key3', $prop );
			}
			if( ($prop = $this->getKey4()) !== NULL ) {
				$xw->writeElement( 'key4', $prop );
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
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "type":
					$this->setType( $xr->readString() );
					break;
				case "key1":
					$this->setKey1( $xr->readString() );
					break;
				case "key2":
					$this->setKey2( $xr->readString() );
					break;
				case "key3":
					$this->setKey3( $xr->readString() );
					break;
				case "key4":
					$this->setKey4( $xr->readString() );
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
			if(isset($props["ID"])) {
				$this->setID($props["ID"]);
			}
			if(isset($props["type"])) {
				$this->setType($props["type"]);
			}
			if(isset($props["key1"])) {
				$this->setKey1($props["key1"]);
			}
			if(isset($props["key2"])) {
				$this->setKey2($props["key2"]);
			}
			if(isset($props["key3"])) {
				$this->setKey3($props["key3"]);
			}
			if(isset($props["key4"])) {
				$this->setKey4($props["key4"]);
			}
		}
		
	}
		

