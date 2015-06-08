<?php
	namespace School\Port\Adaptor\Data\School\Documents;
		
	/**
	 * Сторона страницы документа
	 * 
	 */
	class SideType extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "SideType";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Name = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Documents\SideType\Large
		 */
		protected $Large = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Documents\SideType\Thumb
		 */
		protected $Thumb = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["name"] = array(
				"prop"=>"Name",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Name
			);
			$this->_properties["Large"] = array(
				"prop"=>"Large",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Large
			);
			$this->_properties["Thumb"] = array(
				"prop"=>"Thumb",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Thumb
			);
		}
		/**
		 * @param \String $val
		 */
		public function setName (  $val ) {
			$this->Name = $val;
			$this->_properties["name"]["text"] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\SideType\Large $val
		 */
		public function setLarge ( \School\Port\Adaptor\Data\School\Documents\SideType\Large $val ) {
			$this->Large = $val;
			$this->_properties["Large"]["text"] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Documents\SideType\Thumb $val
		 */
		public function setThumb ( \School\Port\Adaptor\Data\School\Documents\SideType\Thumb $val ) {
			$this->Thumb = $val;
			$this->_properties["Thumb"]["text"] = $val;
		}
		/**
		 * @return \String
		 */
		public function getName() {
			return $this->Name;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getLarge() {
			return $this->Large;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getThumb() {
			return $this->Thumb;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Documents\SideTypeValidator( $this, $handler );
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
			if( ($prop = $this->getName()) !== NULL ) {
				$xw->writeElement( 'name', $prop );
			}
			if( ($prop = $this->getLarge()) !== NULL ) {
					$xw->startElement( 'Large');
					$prop->toXmlWriter( $xw, NULL, NULL, \Adaptor_XML::CONTENTS );
					$xw->endElement();
			}
			if( ($prop = $this->getThumb()) !== NULL ) {
					$xw->startElement( 'Thumb');
					$prop->toXmlWriter( $xw, NULL, NULL, \Adaptor_XML::CONTENTS );
					$xw->endElement();
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
				case "name":
					$this->setName( $xr->readString() );
					break;
				case "Large":
					$Large = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Documents\SideType\Large");
					$this->setLarge( $Large->fromXmlReader( $xr ) );
					break;
				case "Thumb":
					$Thumb = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Documents\SideType\Thumb");
					$this->setThumb( $Thumb->fromXmlReader( $xr ) );
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
			if(isset($props["name"])) {
				$this->setName($props["name"]);
			}
			if(isset($props["Large"])) {
				$Large = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\SideType\Large");
				$Large->fromJSON($props["Large"]);
				$this->setLarge($Large);
			}
			if(isset($props["Thumb"])) {
				$Thumb = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\SideType\Thumb");
				$Thumb->fromJSON($props["Thumb"]);
				$this->setThumb($Thumb);
			}
		}
		
	}
		

