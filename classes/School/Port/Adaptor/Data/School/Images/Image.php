<?php
	namespace School\Port\Adaptor\Data\School\Images;
		
	class Image extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Images";
		const ROOT = "Image";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Autoid = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $ID = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Src = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Name = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Width = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Height = null;
		/**
		 * @maxOccurs unbound 
		 * @var School\Port\Adaptor\Data\School\Images\Area[]
		 */
		protected $Area = [];
		/**
		 * @maxOccurs unbound 
		 * @var School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		protected $Ref = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["autoid"] = array(
				"prop"=>"Autoid",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Autoid
			);
			$this->_properties["ID"] = array(
				"prop"=>"ID",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->ID
			);
			$this->_properties["src"] = array(
				"prop"=>"Src",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Src
			);
			$this->_properties["name"] = array(
				"prop"=>"Name",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Name
			);
			$this->_properties["width"] = array(
				"prop"=>"Width",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Width
			);
			$this->_properties["height"] = array(
				"prop"=>"Height",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Height
			);
			$this->_properties["Area"] = array(
				"prop"=>"Area",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Area
			);
			$this->_properties["Ref"] = array(
				"prop"=>"Ref",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Ref
			);
		}
		/**
		 * @param \Integer $val
		 */
		public function setAutoid (  $val ) {
			$this->Autoid = $val;
			$this->_properties["autoid"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setID (  $val ) {
			$this->ID = $val;
			$this->_properties["ID"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setSrc (  $val ) {
			$this->Src = $val;
			$this->_properties["src"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setName (  $val ) {
			$this->Name = $val;
			$this->_properties["name"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setWidth (  $val ) {
			$this->Width = $val;
			$this->_properties["width"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setHeight (  $val ) {
			$this->Height = $val;
			$this->_properties["height"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Images\Area $val
		 */
		public function setArea ( \School\Port\Adaptor\Data\School\Images\Area $val ) {
			$this->Area[] = $val;
			$this->_properties["Area"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Images\Area[]
		 */
		public function setAreaArray ( array $vals ) {
			$this->Area = $vals;
			$this->_properties["Area"]["text"] = $vals;
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
		 * @return \Integer
		 */
		public function getAutoid() {
			return $this->Autoid;
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
		public function getSrc() {
			return $this->Src;
		}
		/**
		 * @return \String
		 */
		public function getName() {
			return $this->Name;
		}
		/**
		 * @return \Integer
		 */
		public function getWidth() {
			return $this->Width;
		}
		/**
		 * @return \Integer
		 */
		public function getHeight() {
			return $this->Height;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Images\Area | []
		 */
		public function getArea($index = null) {
			if( $index !== null ) {
				$res = isset($this->Area[$index]) ? $this->Area[$index] : null;
			} else {
				$res = $this->Area;
			}
			return $res;
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
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Images\ImageValidator( $this, $handler );
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
			if( ($prop = $this->getAutoid()) !== NULL ) {
				$xw->writeElement( 'autoid', $prop );
			}
			if( ($prop = $this->getID()) !== NULL ) {
				$xw->writeElement( 'ID', $prop );
			}
			if( ($prop = $this->getSrc()) !== NULL ) {
				$xw->writeElement( 'src', $prop );
			}
			if( ($prop = $this->getName()) !== NULL ) {
				$xw->writeElement( 'name', $prop );
			}
			if( ($prop = $this->getWidth()) !== NULL ) {
				$xw->writeElement( 'width', $prop );
			}
			if( ($prop = $this->getHeight()) !== NULL ) {
				$xw->writeElement( 'height', $prop );
			}
			if( $props = $this->getArea() ) {
				foreach( $props as $prop ) {
					$prop->toXmlWriter( $xw );
				}
			}
			if( $props = $this->getRef() ) {
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
				case "autoid":
					$this->setAutoid( $xr->readString() );
					break;
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "src":
					$this->setSrc( $xr->readString() );
					break;
				case "name":
					$this->setName( $xr->readString() );
					break;
				case "width":
					$this->setWidth( $xr->readString() );
					break;
				case "height":
					$this->setHeight( $xr->readString() );
					break;
				case "Area":
					$Area = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Images\\Area");
					$this->setArea( $Area->fromXmlReader( $xr ) );
					break;
				case "Ref":
					$Ref = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Resources\\Ref");
					$this->setRef( $Ref->fromXmlReader( $xr ) );
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
			if(isset($props["autoid"])) {
				$this->setAutoid($props["autoid"]);
			}
			if(isset($props["ID"])) {
				$this->setID($props["ID"]);
			}
			if(isset($props["src"])) {
				$this->setSrc($props["src"]);
			}
			if(isset($props["name"])) {
				$this->setName($props["name"]);
			}
			if(isset($props["width"])) {
				$this->setWidth($props["width"]);
			}
			if(isset($props["height"])) {
				$this->setHeight($props["height"]);
			}
			if(isset($props["Area"])) {
				if( is_array($props["Area"]) ) {
					foreach($props["Area"] as $k=>$v) {
						$Area = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Images\\Area");
						$Area->fromJSON($v);
						$this->setArea($Area);
					}
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
		}
		
	}
		

