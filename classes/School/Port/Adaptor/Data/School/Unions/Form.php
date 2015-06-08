<?php
	namespace School\Port\Adaptor\Data\School\Unions;
		
	class Form extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "Form";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Autouid = null;
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
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Year = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $League = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Comments = null;
		/**
		 * @maxOccurs 1 
		 * @var School\Port\Adaptor\Data\School\Links\Link
		 */
		protected $Link = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["autouid"] = array(
				"prop"=>"Autouid",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Autouid
			);
			$this->_properties["ID"] = array(
				"prop"=>"ID",
				"ns"=>"",
				"minOccurs"=>0,
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
				"minOccurs"=>1,
				"text"=>$this->Year
			);
			$this->_properties["league"] = array(
				"prop"=>"League",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->League
			);
			$this->_properties["comments"] = array(
				"prop"=>"Comments",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Comments
			);
			$this->_properties["Link"] = array(
				"prop"=>"Link",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Link
			);
		}
		/**
		 * @param \Integer $val
		 */
		public function setAutouid (  $val ) {
			$this->Autouid = $val;
			$this->_properties["autouid"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setID (  $val ) {
			$this->ID = $val;
			$this->_properties["ID"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setCohort (  $val ) {
			$this->Cohort = $val;
			$this->_properties["cohort"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setYear (  $val ) {
			$this->Year = $val;
			$this->_properties["year"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setLeague (  $val ) {
			$this->League = $val;
			$this->_properties["league"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setComments (  $val ) {
			$this->Comments = $val;
			$this->_properties["comments"]["text"] = $val;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Links\Link $val
		 */
		public function setLink ( \School\Port\Adaptor\Data\School\Links\Link $val ) {
			$this->Link = $val;
			$this->_properties["Link"]["text"] = $val;
		}
		/**
		 * @return \Integer
		 */
		public function getAutouid() {
			return $this->Autouid;
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
		 * @return \Integer
		 */
		public function getYear() {
			return $this->Year;
		}
		/**
		 * @return \String
		 */
		public function getLeague() {
			return $this->League;
		}
		/**
		 * @return \String
		 */
		public function getComments() {
			return $this->Comments;
		}
		/**
		 * @return \AnyComplexType
		 */
		public function getLink() {
			return $this->Link;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Unions\FormValidator( $this, $handler );
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
			if( ($prop = $this->getAutouid()) !== NULL ) {
				$xw->writeElement( 'autouid', $prop );
			}
			if( ($prop = $this->getID()) !== NULL ) {
				$xw->writeElement( 'ID', $prop );
			}
			if( ($prop = $this->getCohort()) !== NULL ) {
				$xw->writeElement( 'cohort', $prop );
			}
			if( ($prop = $this->getYear()) !== NULL ) {
				$xw->writeElement( 'year', $prop );
			}
			if( ($prop = $this->getLeague()) !== NULL ) {
				$xw->writeElement( 'league', $prop );
			}
			if( ($prop = $this->getComments()) !== NULL ) {
				$xw->writeElement( 'comments', $prop );
			}
			if( ($prop = $this->getLink()) !== NULL ) {
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
				case "autouid":
					$this->setAutouid( $xr->readString() );
					break;
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "cohort":
					$this->setCohort( $xr->readString() );
					break;
				case "year":
					$this->setYear( $xr->readString() );
					break;
				case "league":
					$this->setLeague( $xr->readString() );
					break;
				case "comments":
					$this->setComments( $xr->readString() );
					break;
				case "Link":
					$Link = \Adaptor_Bindings::create( "\\"."School\Port\Adaptor\Data\School\Links\Link");
					$this->setLink( $Link->fromXmlReader( $xr ) );
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
			if(isset($props["autouid"])) {
				$this->setAutouid($props["autouid"]);
			}
			if(isset($props["ID"])) {
				$this->setID($props["ID"]);
			}
			if(isset($props["cohort"])) {
				$this->setCohort($props["cohort"]);
			}
			if(isset($props["year"])) {
				$this->setYear($props["year"]);
			}
			if(isset($props["league"])) {
				$this->setLeague($props["league"]);
			}
			if(isset($props["comments"])) {
				$this->setComments($props["comments"]);
			}
			if(isset($props["Link"])) {
				$Link = \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Links\Link");
				$Link->fromJSON($props["Link"]);
				$this->setLink($Link);
			}
		}
		
	}
		

