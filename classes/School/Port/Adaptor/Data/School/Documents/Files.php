<?php
	namespace School\Port\Adaptor\Data\School\Documents;
		
	class Files extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "Files";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Documents\File[]
		 */
		protected $File = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["File"] = array(
				"prop"=>"File",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->File
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\File $val
		 */
		public function setFile ( \School\Port\Adaptor\Data\School\Documents\File $val ) {
			$this->File[] = $val;
			$this->_properties["File"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\File[]
		 */
		public function setFileArray ( array $vals ) {
			$this->File = $vals;
			$this->_properties["File"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Documents\File | []
		 */
		public function getFile($index = null) {
			if( $index !== null ) {
				$res = isset($this->File[$index]) ? $this->File[$index] : null;
			} else {
				$res = $this->File;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Documents\FilesValidator( $this, $handler );
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
			if( $props = $this->getFile() ) {
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
				case "File":
					$File = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\File");
					$this->setFile( $File->fromXmlReader( $xr ) );
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
			if(isset($props["File"])) {
				if( is_array($props["File"]) ) {
					foreach($props["File"] as $k=>$v) {
						$File = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\File");
						$File->fromJSON($v);
						$this->setFile($File);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$File = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\File");
					$File->fromJSON($v);
					$this->setFile($File);
				}
			}
		}
		
	}
		

