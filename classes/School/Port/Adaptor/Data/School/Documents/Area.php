<?php
	namespace School\Port\Adaptor\Data\School\Documents;
		
	/**
	 * Область изображения
	 * 
	 */
	class Area extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "Area";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Double
		 */
		protected $X = null;
		/**
		 * @maxOccurs 1 
		 * @var \Double
		 */
		protected $Y = null;
		/**
		 * @maxOccurs 1 
		 * @var \Double
		 */
		protected $Width = null;
		/**
		 * @maxOccurs 1 
		 * @var \Double
		 */
		protected $Height = null;
		/**
		 * @maxOccurs unbound 
		 * @var School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		protected $Ref = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["x"] = array(
				"prop"=>"X",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->X
			);
			$this->_properties["y"] = array(
				"prop"=>"Y",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Y
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
			$this->_properties["Ref"] = array(
				"prop"=>"Ref",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Ref
			);
		}
		/**
		 * @param \Double $val
		 */
		public function setX (  $val ) {
			$this->X = $val;
			$this->_properties["x"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Double $val
		 */
		public function setY (  $val ) {
			$this->Y = $val;
			$this->_properties["y"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Double $val
		 */
		public function setWidth (  $val ) {
			$this->Width = $val;
			$this->_properties["width"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Double $val
		 */
		public function setHeight (  $val ) {
			$this->Height = $val;
			$this->_properties["height"]["text"] = $val;
			return $this;
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
		 * @return \Double
		 */
		public function getX() {
			return $this->X;
		}
		/**
		 * @return \Double
		 */
		public function getY() {
			return $this->Y;
		}
		/**
		 * @return \Double
		 */
		public function getWidth() {
			return $this->Width;
		}
		/**
		 * @return \Double
		 */
		public function getHeight() {
			return $this->Height;
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
			$validator = new \School\Port\Adaptor\Data\School\Documents\AreaValidator( $this, $handler );
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
			if( ($prop = $this->getX()) !== NULL ) {
				$xw->writeElement( 'x', $prop );
			}
			if( ($prop = $this->getY()) !== NULL ) {
				$xw->writeElement( 'y', $prop );
			}
			if( ($prop = $this->getWidth()) !== NULL ) {
				$xw->writeElement( 'width', $prop );
			}
			if( ($prop = $this->getHeight()) !== NULL ) {
				$xw->writeElement( 'height', $prop );
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
				case "x":
					$this->setX( $xr->readString() );
					break;
				case "y":
					$this->setY( $xr->readString() );
					break;
				case "width":
					$this->setWidth( $xr->readString() );
					break;
				case "height":
					$this->setHeight( $xr->readString() );
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
			if(isset($props["x"])) {
				$this->setX($props["x"]);
			}
			if(isset($props["y"])) {
				$this->setY($props["y"]);
			}
			if(isset($props["width"])) {
				$this->setWidth($props["width"]);
			}
			if(isset($props["height"])) {
				$this->setHeight($props["height"]);
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
		

