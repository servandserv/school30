<?php
	namespace School\Port\Adaptor\Data\School\Unions;
		
	class Cohort extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "Cohort";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Year = null;
		/**
		 * @maxOccurs unbounded 
		 * @var \String[]
		 */
		protected $League = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["year"] = array(
				"prop"=>"Year",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Year
			);
			$this->_properties["league"] = array(
				"prop"=>"League",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->League
			);
		}
		/**
		 * @param \Integer $val
		 */
		public function setYear (  $val ) {
			$this->Year = $val;
			$this->_properties["year"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setLeague (  $val ) {
			$this->League[] = $val;
			$this->_properties["league"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param \String[]
		 */
		public function setLeagueArray ( array $vals ) {
			$this->League = $vals;
			$this->_properties["league"]["text"] = $vals;
		}
		/**
		 * @return \Integer
		 */
		public function getYear() {
			return $this->Year;
		}
		/**
		 * @return \String | []
		 */
		public function getLeague($index = null) {
			if( $index !== null ) {
				$res = isset($this->League[$index]) ? $this->League[$index] : null;
			} else {
				$res = $this->League;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Unions\CohortValidator( $this, $handler );
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
			if( ($prop = $this->getYear()) !== NULL ) {
				$xw->writeElement( 'year', $prop );
			}
			if( $props = $this->getLeague() ) {
				foreach( $props as $prop ) {
				$xw->writeElement( 'league', $prop );
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
				case "year":
					$this->setYear( $xr->readString() );
					break;
				case "league":
					$this->setLeague( $xr->readString() );
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
			if(isset($props["year"])) {
				$this->setYear($props["year"]);
			}
			if(isset($props["league"])) {
				if( is_array($props["league"]) ) {
					$this->setLeagueArray($props["league"]);
				}
			}
		}
		
	}
		

