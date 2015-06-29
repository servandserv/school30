<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Unions extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "Unions";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Unions\Union[]
		 */
		protected $Union = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Union"] = array(
				"prop"=>"Union",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Union
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Union $val
		 */
		public function setUnion ( \School\Port\Adaptor\Data\School\Unions\Union $val ) {
			$this->Union[] = $val;
			$this->_properties["Union"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Union[]
		 */
		public function setUnionArray ( array $vals ) {
			$this->Union = $vals;
			$this->_properties["Union"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Unions\Union | []
		 */
		public function getUnion($index = null) {
			if( $index !== null ) {
				$res = isset($this->Union[$index]) ? $this->Union[$index] : null;
			} else {
				$res = $this->Union;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\UnionsValidator( $this, $handler );
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
			if( $props = $this->getUnion() ) {
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
				case "Union":
					$Union = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Union");
					$this->setUnion( $Union->fromXmlReader( $xr ) );
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
			if(isset($props["Union"])) {
				if( is_array($props["Union"]) ) {
					foreach($props["Union"] as $k=>$v) {
						$Union = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Union");
						$Union->fromJSON($v);
						$this->setUnion($Union);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Union = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Union");
					$Union->fromJSON($v);
					$this->setUnion($Union);
				}
			}
		}
		
	}
		

