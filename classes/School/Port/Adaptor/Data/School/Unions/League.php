<?php
	namespace School\Port\Adaptor\Data\School\Unions;
		
	class League extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "League";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $ID = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Cohort = null;
		/**
		 * @maxOccurs unbounded 
		 * @var \Integer[]
		 */
		protected $Year = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["ID"] = array(
				"prop"=>"ID",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->ID
			);
			$this->_properties["cohort"] = array(
				"prop"=>"Cohort",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Cohort
			);
			$this->_properties["year"] = array(
				"prop"=>"Year",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Year
			);
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
		public function setCohort (  $val ) {
			$this->Cohort = $val;
			$this->_properties["cohort"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setYear (  $val ) {
			$this->Year[] = $val;
			$this->_properties["year"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param \Integer[]
		 */
		public function setYearArray ( array $vals ) {
			$this->Year = $vals;
			$this->_properties["year"]["text"] = $vals;
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
		public function getCohort() {
			return $this->Cohort;
		}
		/**
		 * @return \Integer | []
		 */
		public function getYear($index = null) {
			if( $index !== null ) {
				$res = isset($this->Year[$index]) ? $this->Year[$index] : null;
			} else {
				$res = $this->Year;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Unions\LeagueValidator( $this, $handler );
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
			if( ($prop = $this->getID()) !== NULL ) {
				$xw->writeElement( 'ID', $prop );
			}
			if( ($prop = $this->getCohort()) !== NULL ) {
				$xw->writeElement( 'cohort', $prop );
			}
			if( $props = $this->getYear() ) {
				foreach( $props as $prop ) {
				$xw->writeElement( 'year', $prop );
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
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "cohort":
					$this->setCohort( $xr->readString() );
					break;
				case "year":
					$this->setYear( $xr->readString() );
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
			if(isset($props["ID"])) {
				$this->setID($props["ID"]);
			}
			if(isset($props["cohort"])) {
				$this->setCohort($props["cohort"]);
			}
			if(isset($props["year"])) {
				if( is_array($props["year"]) ) {
					$this->setYearArray($props["year"]);
				}
			}
		}
		
	}
		

