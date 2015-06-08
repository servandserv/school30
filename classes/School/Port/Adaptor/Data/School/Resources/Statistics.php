<?php
	namespace School\Port\Adaptor\Data\School\Resources;
		
	class Statistics extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Statistics";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Resources\Total
		 */
		protected $Total = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Resources\Identified
		 */
		protected $Identified = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Resources\Published
		 */
		protected $Published = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Total"] = array(
				"prop"=>"Total",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Total
			);
			$this->_properties["Identified"] = array(
				"prop"=>"Identified",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Identified
			);
			$this->_properties["Published"] = array(
				"prop"=>"Published",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Published
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Total $val
		 */
		public function setTotal ( \School\Port\Adaptor\Data\School\Resources\Total $val ) {
			$this->Total = $val;
			$this->_properties["Total"]["text"] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Identified $val
		 */
		public function setIdentified ( \School\Port\Adaptor\Data\School\Resources\Identified $val ) {
			$this->Identified = $val;
			$this->_properties["Identified"]["text"] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Published $val
		 */
		public function setPublished ( \School\Port\Adaptor\Data\School\Resources\Published $val ) {
			$this->Published = $val;
			$this->_properties["Published"]["text"] = $val;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getTotal() {
			return $this->Total;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getIdentified() {
			return $this->Identified;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getPublished() {
			return $this->Published;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Resources\StatisticsValidator( $this, $handler );
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
			if( ($prop = $this->getTotal()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getIdentified()) !== NULL ) {
					$prop->toXmlWriter( $xw );
			}
			if( ($prop = $this->getPublished()) !== NULL ) {
					$prop->toXmlWriter( $xw );
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
				case "Total":
					$Total = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Resources\Total");
					$this->setTotal( $Total->fromXmlReader( $xr ) );
					break;
				case "Identified":
					$Identified = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Resources\Identified");
					$this->setIdentified( $Identified->fromXmlReader( $xr ) );
					break;
				case "Published":
					$Published = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Resources\Published");
					$this->setPublished( $Published->fromXmlReader( $xr ) );
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
			if(isset($props["Total"])) {
				$Total = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Resources\Total");
				$Total->fromJSON($props["Total"]);
				$this->setTotal($Total);
			}
			if(isset($props["Identified"])) {
				$Identified = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Resources\Identified");
				$Identified->fromJSON($props["Identified"]);
				$this->setIdentified($Identified);
			}
			if(isset($props["Published"])) {
				$Published = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Resources\Published");
				$Published->fromJSON($props["Published"]);
				$this->setPublished($Published);
			}
		}
		
	}
		

