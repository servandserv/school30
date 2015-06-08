<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Digests extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Digests";
		const ROOT = "Digests";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Digests\Digest[]
		 */
		protected $Digest = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Digest"] = array(
				"prop"=>"Digest",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Digest
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Digests\Digest $val
		 */
		public function setDigest ( \School\Port\Adaptor\Data\School\Digests\Digest $val ) {
			$this->Digest[] = $val;
			$this->_properties["Digest"]["text"][] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Digests\Digest[]
		 */
		public function setDigestArray ( array $vals ) {
			$this->Digest = $vals;
			$this->_properties["Digest"]["text"] = $vals;
		}
		/**
		 * @return \AnyComplexType | []
		 */
		public function getDigest($index = null) {
			if( $index !== null ) {
				$res = isset($this->Digest[$index]) ? $this->Digest[$index] : null;
			} else {
				$res = $this->Digest;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\DigestsValidator( $this, $handler );
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
			if( $props = $this->getDigest() ) {
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
				case "Digest":
					$Digest = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Digests\Digest");
					$this->setDigest( $Digest->fromXmlReader( $xr ) );
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
			if(isset($props["Digest"])) {
				if( is_array($props["Digest"]) ) {
					foreach($props["Digest"] as $k=>$v) {
						$Digest = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Digests\Digest");
						$Digest->fromJSON($v);
						$this->setDigest($Digest);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Digest = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Digests\Digest");
					$Digest->fromJSON($v);
					$this->setDigest($Digest);
				}
			}
		}
		
	}
		

