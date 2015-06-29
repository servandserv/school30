<?php
	namespace School\Port\Adaptor\Data\School\Unions;
		
	class Cohorts extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "Cohorts";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Unions\Cohort[]
		 */
		protected $Cohort = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Cohort"] = array(
				"prop"=>"Cohort",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Cohort
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Cohort $val
		 */
		public function setCohort ( \School\Port\Adaptor\Data\School\Unions\Cohort $val ) {
			$this->Cohort[] = $val;
			$this->_properties["Cohort"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Cohort[]
		 */
		public function setCohortArray ( array $vals ) {
			$this->Cohort = $vals;
			$this->_properties["Cohort"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Unions\Cohort | []
		 */
		public function getCohort($index = null) {
			if( $index !== null ) {
				$res = isset($this->Cohort[$index]) ? $this->Cohort[$index] : null;
			} else {
				$res = $this->Cohort;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Unions\CohortsValidator( $this, $handler );
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
			if( $props = $this->getCohort() ) {
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
				case "Cohort":
					$Cohort = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Cohort");
					$this->setCohort( $Cohort->fromXmlReader( $xr ) );
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
			if(isset($props["Cohort"])) {
				if( is_array($props["Cohort"]) ) {
					foreach($props["Cohort"] as $k=>$v) {
						$Cohort = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Cohort");
						$Cohort->fromJSON($v);
						$this->setCohort($Cohort);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Cohort = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Cohort");
					$Cohort->fromJSON($v);
					$this->setCohort($Cohort);
				}
			}
		}
		
	}
		

