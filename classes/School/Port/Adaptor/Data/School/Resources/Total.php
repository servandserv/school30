<?php
	namespace School\Port\Adaptor\Data\School\Resources;
		
	class Total extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Total";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Documents = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Files = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Forms = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Persons = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Unions = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Staff = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["documents"] = array(
				"prop"=>"Documents",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Documents
			);
			$this->_properties["files"] = array(
				"prop"=>"Files",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Files
			);
			$this->_properties["forms"] = array(
				"prop"=>"Forms",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Forms
			);
			$this->_properties["persons"] = array(
				"prop"=>"Persons",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Persons
			);
			$this->_properties["unions"] = array(
				"prop"=>"Unions",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Unions
			);
			$this->_properties["staff"] = array(
				"prop"=>"Staff",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Staff
			);
		}
		/**
		 * @param \Integer $val
		 */
		public function setDocuments (  $val ) {
			$this->Documents = $val;
			$this->_properties["documents"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setFiles (  $val ) {
			$this->Files = $val;
			$this->_properties["files"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setForms (  $val ) {
			$this->Forms = $val;
			$this->_properties["forms"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setPersons (  $val ) {
			$this->Persons = $val;
			$this->_properties["persons"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setUnions (  $val ) {
			$this->Unions = $val;
			$this->_properties["unions"]["text"] = $val;
		}
		/**
		 * @param \Integer $val
		 */
		public function setStaff (  $val ) {
			$this->Staff = $val;
			$this->_properties["staff"]["text"] = $val;
		}
		/**
		 * @return \Integer
		 */
		public function getDocuments() {
			return $this->Documents;
		}
		/**
		 * @return \Integer
		 */
		public function getFiles() {
			return $this->Files;
		}
		/**
		 * @return \Integer
		 */
		public function getForms() {
			return $this->Forms;
		}
		/**
		 * @return \Integer
		 */
		public function getPersons() {
			return $this->Persons;
		}
		/**
		 * @return \Integer
		 */
		public function getUnions() {
			return $this->Unions;
		}
		/**
		 * @return \Integer
		 */
		public function getStaff() {
			return $this->Staff;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Resources\TotalValidator( $this, $handler );
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
			if( ($prop = $this->getDocuments()) !== NULL ) {
				$xw->writeElement( 'documents', $prop );
			}
			if( ($prop = $this->getFiles()) !== NULL ) {
				$xw->writeElement( 'files', $prop );
			}
			if( ($prop = $this->getForms()) !== NULL ) {
				$xw->writeElement( 'forms', $prop );
			}
			if( ($prop = $this->getPersons()) !== NULL ) {
				$xw->writeElement( 'persons', $prop );
			}
			if( ($prop = $this->getUnions()) !== NULL ) {
				$xw->writeElement( 'unions', $prop );
			}
			if( ($prop = $this->getStaff()) !== NULL ) {
				$xw->writeElement( 'staff', $prop );
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
				case "documents":
					$this->setDocuments( $xr->readString() );
					break;
				case "files":
					$this->setFiles( $xr->readString() );
					break;
				case "forms":
					$this->setForms( $xr->readString() );
					break;
				case "persons":
					$this->setPersons( $xr->readString() );
					break;
				case "unions":
					$this->setUnions( $xr->readString() );
					break;
				case "staff":
					$this->setStaff( $xr->readString() );
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
			if(isset($props["documents"])) {
				$this->setDocuments($props["documents"]);
			}
			if(isset($props["files"])) {
				$this->setFiles($props["files"]);
			}
			if(isset($props["forms"])) {
				$this->setForms($props["forms"]);
			}
			if(isset($props["persons"])) {
				$this->setPersons($props["persons"]);
			}
			if(isset($props["unions"])) {
				$this->setUnions($props["unions"]);
			}
			if(isset($props["staff"])) {
				$this->setStaff($props["staff"]);
			}
		}
		
	}
		

