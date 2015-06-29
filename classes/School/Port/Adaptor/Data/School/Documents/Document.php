<?php
	namespace School\Port\Adaptor\Data\School\Documents;
		
	class Document extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "Document";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Autouid = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $ID = null;
		/**
		 * @maxOccurs 1 
		 * @var \Int
		 */
		protected $Type = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Year = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Path = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Published = null;
		/**
		 * @maxOccurs 1 
		 * @var \Int
		 */
		protected $Readiness = "0";
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Comments = null;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Documents\File[]
		 */
		protected $File = [];
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
			$this->_properties["type"] = array(
				"prop"=>"Type",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Type
			);
			$this->_properties["year"] = array(
				"prop"=>"Year",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Year
			);
			$this->_properties["path"] = array(
				"prop"=>"Path",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Path
			);
			$this->_properties["published"] = array(
				"prop"=>"Published",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Published
			);
			$this->_properties["readiness"] = array(
				"prop"=>"Readiness",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Readiness
			);
			$this->_properties["comments"] = array(
				"prop"=>"Comments",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Comments
			);
			$this->_properties["File"] = array(
				"prop"=>"File",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->File
			);
			$this->_properties["Link"] = array(
				"prop"=>"Link",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Link
			);
		}
		/**
		 * @param \String $val
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
		 * @param \Int $val
		 */
		public function setType (  $val ) {
			$this->Type = $val;
			$this->_properties["type"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setYear (  $val ) {
			$this->Year = $val;
			$this->_properties["year"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setPath (  $val ) {
			$this->Path = $val;
			$this->_properties["path"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setPublished (  $val ) {
			$this->Published = $val;
			$this->_properties["published"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Int $val
		 */
		public function setReadiness (  $val ) {
			$this->Readiness = $val;
			$this->_properties["readiness"]["text"] = $val;
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
		 * @param School\Port\Adaptor\Data\School\Links\Link $val
		 */
		public function setLink ( \School\Port\Adaptor\Data\School\Links\Link $val ) {
			$this->Link = $val;
			$this->_properties["Link"]["text"] = $val;
			return $this;
		}
		/**
		 * @return \String
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
		 * @return \Int
		 */
		public function getType() {
			return $this->Type;
		}
		/**
		 * @return \String
		 */
		public function getYear() {
			return $this->Year;
		}
		/**
		 * @return \String
		 */
		public function getPath() {
			return $this->Path;
		}
		/**
		 * @return \Integer
		 */
		public function getPublished() {
			return $this->Published;
		}
		/**
		 * @return \Int
		 */
		public function getReadiness() {
			return $this->Readiness;
		}
		/**
		 * @return \String
		 */
		public function getComments() {
			return $this->Comments;
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
		/**
		 * @return School\Port\Adaptor\Data\School\Links\Link
		 */
		public function getLink() {
			return $this->Link;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Documents\DocumentValidator( $this, $handler );
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
			if( ($prop = $this->getType()) !== NULL ) {
				$xw->writeElement( 'type', $prop );
			}
			if( ($prop = $this->getYear()) !== NULL ) {
				$xw->writeElement( 'year', $prop );
			}
			if( ($prop = $this->getPath()) !== NULL ) {
				$xw->writeElement( 'path', $prop );
			}
			if( ($prop = $this->getPublished()) !== NULL ) {
				$xw->writeElement( 'published', $prop );
			}
			if( ($prop = $this->getReadiness()) !== NULL ) {
				$xw->writeElement( 'readiness', $prop );
			}
			if( ($prop = $this->getComments()) !== NULL ) {
				$xw->writeElement( 'comments', $prop );
			}
			if( $props = $this->getFile() ) {
				foreach( $props as $prop ) {
					$prop->toXmlWriter( $xw );
				}
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
				case "type":
					$this->setType( $xr->readString() );
					break;
				case "year":
					$this->setYear( $xr->readString() );
					break;
				case "path":
					$this->setPath( $xr->readString() );
					break;
				case "published":
					$this->setPublished( $xr->readString() );
					break;
				case "readiness":
					$this->setReadiness( $xr->readString() );
					break;
				case "comments":
					$this->setComments( $xr->readString() );
					break;
				case "File":
					$File = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\File");
					$this->setFile( $File->fromXmlReader( $xr ) );
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
			if(isset($props["type"])) {
				$this->setType($props["type"]);
			}
			if(isset($props["year"])) {
				$this->setYear($props["year"]);
			}
			if(isset($props["path"])) {
				$this->setPath($props["path"]);
			}
			if(isset($props["published"])) {
				$this->setPublished($props["published"]);
			}
			if(isset($props["readiness"])) {
				$this->setReadiness($props["readiness"]);
			}
			if(isset($props["comments"])) {
				$this->setComments($props["comments"]);
			}
			if(isset($props["File"])) {
				if( is_array($props["File"]) ) {
					foreach($props["File"] as $k=>$v) {
						$File = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Documents\\File");
						$File->fromJSON($v);
						$this->setFile($File);
					}
				}
			}
			if(isset($props["Link"])) {
				$Link = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Links\\Link");
				$Link->fromJSON($props["Link"]);
				$this->setLink($Link);
			}
		}
		
	}
		

