<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Images extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Images";
		const ROOT = "Images";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Images\Image[]
		 */
		protected $Image = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Image"] = array(
				"prop"=>"Image",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Image
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Images\Image $val
		 */
		public function setImage ( \School\Port\Adaptor\Data\School\Images\Image $val ) {
			$this->Image[] = $val;
			$this->_properties["Image"]["text"][] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Images\Image[]
		 */
		public function setImageArray ( array $vals ) {
			$this->Image = $vals;
			$this->_properties["Image"]["text"] = $vals;
		}
		/**
		 * @return \AnyComplexType | []
		 */
		public function getImage($index = null) {
			if( $index !== null ) {
				$res = isset($this->Image[$index]) ? $this->Image[$index] : null;
			} else {
				$res = $this->Image;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\ImagesValidator( $this, $handler );
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
			if( $props = $this->getImage() ) {
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
				case "Image":
					$Image = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Images\Image");
					$this->setImage( $Image->fromXmlReader( $xr ) );
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
			if(isset($props["Image"])) {
				if( is_array($props["Image"]) ) {
					foreach($props["Image"] as $k=>$v) {
						$Image = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Images\Image");
						$Image->fromJSON($v);
						$this->setImage($Image);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Image = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Images\Image");
					$Image->fromJSON($v);
					$this->setImage($Image);
				}
			}
		}
		
	}
		

