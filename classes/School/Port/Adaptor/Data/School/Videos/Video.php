<?php
	namespace School\Port\Adaptor\Data\School\Videos;
		
	class Video extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Videos";
		const ROOT = "Video";
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
		protected $Name = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Year = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Comments = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Href = null;
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
			$this->_properties["name"] = array(
				"prop"=>"Name",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Name
			);
			$this->_properties["year"] = array(
				"prop"=>"Year",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Year
			);
			$this->_properties["comments"] = array(
				"prop"=>"Comments",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Comments
			);
			$this->_properties["href"] = array(
				"prop"=>"Href",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Href
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
		public function setName (  $val ) {
			$this->Name = $val;
			$this->_properties["name"]["text"] = $val;
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
		public function setComments (  $val ) {
			$this->Comments = $val;
			$this->_properties["comments"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setHref (  $val ) {
			$this->Href = $val;
			$this->_properties["href"]["text"] = $val;
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
		public function getName() {
			return $this->Name;
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
		public function getComments() {
			return $this->Comments;
		}
		/**
		 * @return \String
		 */
		public function getHref() {
			return $this->Href;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Links\Link
		 */
		public function getLink() {
			return $this->Link;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Videos\VideoValidator( $this, $handler );
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
			if( ($prop = $this->getName()) !== NULL ) {
				$xw->writeElement( 'name', $prop );
			}
			if( ($prop = $this->getYear()) !== NULL ) {
				$xw->writeElement( 'year', $prop );
			}
			if( ($prop = $this->getComments()) !== NULL ) {
				$xw->writeElement( 'comments', $prop );
			}
			if( ($prop = $this->getHref()) !== NULL ) {
				$xw->writeElement( 'href', $prop );
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
				case "name":
					$this->setName( $xr->readString() );
					break;
				case "year":
					$this->setYear( $xr->readString() );
					break;
				case "comments":
					$this->setComments( $xr->readString() );
					break;
				case "href":
					$this->setHref( $xr->readString() );
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
			if(isset($props["name"])) {
				$this->setName($props["name"]);
			}
			if(isset($props["year"])) {
				$this->setYear($props["year"]);
			}
			if(isset($props["comments"])) {
				$this->setComments($props["comments"]);
			}
			if(isset($props["href"])) {
				$this->setHref($props["href"]);
			}
			if(isset($props["Link"])) {
				$Link = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Links\\Link");
				$Link->fromJSON($props["Link"]);
				$this->setLink($Link);
			}
		}
		
	}
		

