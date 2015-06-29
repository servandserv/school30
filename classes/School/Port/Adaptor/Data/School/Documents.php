<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Documents extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "Documents";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Documents\Document[]
		 */
		protected $Document = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Document"] = array(
				"prop"=>"Document",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Document
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\Document $val
		 */
		public function setDocument ( \School\Port\Adaptor\Data\School\Documents\Document $val ) {
			$this->Document[] = $val;
			$this->_properties["Document"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\Document[]
		 */
		public function setDocumentArray ( array $vals ) {
			$this->Document = $vals;
			$this->_properties["Document"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Documents\Document | []
		 */
		public function getDocument($index = null) {
			if( $index !== null ) {
				$res = isset($this->Document[$index]) ? $this->Document[$index] : null;
			} else {
				$res = $this->Document;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\DocumentsValidator( $this, $handler );
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
			if( $props = $this->getDocument() ) {
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
				case "Document":
					$Document = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\Document");
					$this->setDocument( $Document->fromXmlReader( $xr ) );
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
			if(isset($props["Document"])) {
				if( is_array($props["Document"]) ) {
					foreach($props["Document"] as $k=>$v) {
						$Document = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\Document");
						$Document->fromJSON($v);
						$this->setDocument($Document);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Document = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\Document");
					$Document->fromJSON($v);
					$this->setDocument($Document);
				}
			}
		}
		
	}
		

