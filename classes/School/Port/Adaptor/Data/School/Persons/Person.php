<?php
	namespace School\Port\Adaptor\Data\School\Persons;
		
	class Person extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Persons";
		const ROOT = "Person";
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
		protected $FullName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $FirstName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $LastName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $NewName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $MiddleName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $EnFullName = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $DOB = null;
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
			$this->_properties["fullName"] = array(
				"prop"=>"FullName",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->FullName
			);
			$this->_properties["firstName"] = array(
				"prop"=>"FirstName",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->FirstName
			);
			$this->_properties["lastName"] = array(
				"prop"=>"LastName",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->LastName
			);
			$this->_properties["newName"] = array(
				"prop"=>"NewName",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->NewName
			);
			$this->_properties["middleName"] = array(
				"prop"=>"MiddleName",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->MiddleName
			);
			$this->_properties["enFullName"] = array(
				"prop"=>"EnFullName",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->EnFullName
			);
			$this->_properties["DOB"] = array(
				"prop"=>"DOB",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->DOB
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
			return $this;
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
		public function setFullName (  $val ) {
			$this->FullName = $val;
			$this->_properties["fullName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setFirstName (  $val ) {
			$this->FirstName = $val;
			$this->_properties["firstName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setLastName (  $val ) {
			$this->LastName = $val;
			$this->_properties["lastName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setNewName (  $val ) {
			$this->NewName = $val;
			$this->_properties["newName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setMiddleName (  $val ) {
			$this->MiddleName = $val;
			$this->_properties["middleName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setEnFullName (  $val ) {
			$this->EnFullName = $val;
			$this->_properties["enFullName"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setDOB (  $val ) {
			$this->DOB = $val;
			$this->_properties["DOB"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setComments (  $val ) {
			$this->Comments = $val;
			$this->_properties["comments"]["text"] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Links\Link $val
		 */
		public function setLink ( \School\Port\Adaptor\Data\School\Links\Link $val ) {
			$this->Link = $val;
			$this->_properties["Link"]["text"] = $val;
			return $this;
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
		public function getFullName() {
			return $this->FullName;
		}
		/**
		 * @return \String
		 */
		public function getFirstName() {
			return $this->FirstName;
		}
		/**
		 * @return \String
		 */
		public function getLastName() {
			return $this->LastName;
		}
		/**
		 * @return \String
		 */
		public function getNewName() {
			return $this->NewName;
		}
		/**
		 * @return \String
		 */
		public function getMiddleName() {
			return $this->MiddleName;
		}
		/**
		 * @return \String
		 */
		public function getEnFullName() {
			return $this->EnFullName;
		}
		/**
		 * @return \String
		 */
		public function getDOB() {
			return $this->DOB;
		}
		/**
		 * @return \String
		 */
		public function getComments() {
			return $this->Comments;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Links\Link
		 */
		public function getLink() {
			return $this->Link;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Persons\PersonValidator( $this, $handler );
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
			if( ($prop = $this->getFullName()) !== NULL ) {
				$xw->writeElement( 'fullName', $prop );
			}
			if( ($prop = $this->getFirstName()) !== NULL ) {
				$xw->writeElement( 'firstName', $prop );
			}
			if( ($prop = $this->getLastName()) !== NULL ) {
				$xw->writeElement( 'lastName', $prop );
			}
			if( ($prop = $this->getNewName()) !== NULL ) {
				$xw->writeElement( 'newName', $prop );
			}
			if( ($prop = $this->getMiddleName()) !== NULL ) {
				$xw->writeElement( 'middleName', $prop );
			}
			if( ($prop = $this->getEnFullName()) !== NULL ) {
				$xw->writeElement( 'enFullName', $prop );
			}
			if( ($prop = $this->getDOB()) !== NULL ) {
				$xw->writeElement( 'DOB', $prop );
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
				case "fullName":
					$this->setFullName( $xr->readString() );
					break;
				case "firstName":
					$this->setFirstName( $xr->readString() );
					break;
				case "lastName":
					$this->setLastName( $xr->readString() );
					break;
				case "newName":
					$this->setNewName( $xr->readString() );
					break;
				case "middleName":
					$this->setMiddleName( $xr->readString() );
					break;
				case "enFullName":
					$this->setEnFullName( $xr->readString() );
					break;
				case "DOB":
					$this->setDOB( $xr->readString() );
					break;
				case "comments":
					$this->setComments( $xr->readString() );
					break;
				case "Link":
					$Link = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Links\\Link");
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
			if(isset($props["fullName"])) {
				$this->setFullName($props["fullName"]);
			}
			if(isset($props["firstName"])) {
				$this->setFirstName($props["firstName"]);
			}
			if(isset($props["lastName"])) {
				$this->setLastName($props["lastName"]);
			}
			if(isset($props["newName"])) {
				$this->setNewName($props["newName"]);
			}
			if(isset($props["middleName"])) {
				$this->setMiddleName($props["middleName"]);
			}
			if(isset($props["enFullName"])) {
				$this->setEnFullName($props["enFullName"]);
			}
			if(isset($props["DOB"])) {
				$this->setDOB($props["DOB"]);
			}
			if(isset($props["comments"])) {
				$this->setComments($props["comments"]);
			}
			if(isset($props["Link"])) {
				$Link = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Links\\Link");
				$Link->fromJSON($props["Link"]);
				$this->setLink($Link);
			}
		}
		
	}
		

