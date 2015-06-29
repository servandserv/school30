<?php
	namespace School\Port\Adaptor\Data\School\Resources;
		
	class Ref extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Ref";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Rel = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Href = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["rel"] = array(
				"prop"=>"Rel",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Rel
			);
			$this->_properties["href"] = array(
				"prop"=>"Href",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Href
			);
		}
		/**
		 * @param \String $val
		 */
		public function setRel (  $val ) {
			$this->Rel = $val;
			$this->_properties["rel"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setHref (  $val ) {
			$this->Href = $val;
			$this->_properties["href"]["text"] = $val;
			return $this;
		}
		/**
		 * @return \String
		 */
		public function getRel() {
			return $this->Rel;
		}
		/**
		 * @return \String
		 */
		public function getHref() {
			return $this->Href;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Resources\RefValidator( $this, $handler );
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
			if( ($prop = $this->getRel()) !== NULL ) {
				$xw->writeElement( 'rel', $prop );
			}
			if( ($prop = $this->getHref()) !== NULL ) {
				$xw->writeElement( 'href', $prop );
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
				case "rel":
					$this->setRel( $xr->readString() );
					break;
				case "href":
					$this->setHref( $xr->readString() );
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
			if(isset($props["rel"])) {
				$this->setRel($props["rel"]);
			}
			if(isset($props["href"])) {
				$this->setHref($props["href"]);
			}
		}
		
	}
		

