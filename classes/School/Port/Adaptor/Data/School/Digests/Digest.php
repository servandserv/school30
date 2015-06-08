<?php
	namespace School\Port\Adaptor\Data\School\Digests;
		
	class Digest extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Digests";
		const ROOT = "Digest";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $ID = null;
		/**
		 * @maxOccurs 1 
		 * @var \Date
		 */
		protected $Published = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Title = null;
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
			
			$this->_properties["ID"] = array(
				"prop"=>"ID",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->ID
			);
			$this->_properties["published"] = array(
				"prop"=>"Published",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Published
			);
			$this->_properties["title"] = array(
				"prop"=>"Title",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Title
			);
			$this->_properties["comments"] = array(
				"prop"=>"Comments",
				"ns"=>"",
				"minOccurs"=>1,
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
		 * @param \String $val
		 */
		public function setID (  $val ) {
			$this->ID = $val;
			$this->_properties["ID"]["text"] = $val;
		}
		/**
		 * @param \Date $val
		 */
		public function setPublished (  $val ) {
			$this->Published = $val;
			$this->_properties["published"]["text"] = $val;
		}
		/**
		 * @param \String $val
		 */
		public function setTitle (  $val ) {
			$this->Title = $val;
			$this->_properties["title"]["text"] = $val;
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
		 * @return \String
		 */
		public function getID() {
			return $this->ID;
		}
		/**
		 * @return \Date
		 */
		public function getPublished() {
			return $this->Published;
		}
		/**
		 * @return \String
		 */
		public function getTitle() {
			return $this->Title;
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
			$validator = new \School\Port\Adaptor\Data\School\Digests\DigestValidator( $this, $handler );
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
			if( ($prop = $this->getPublished()) !== NULL ) {
				$xw->writeElement( 'published', $prop );
			}
			if( ($prop = $this->getTitle()) !== NULL ) {
				$xw->writeElement( 'title', $prop );
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
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "published":
					$this->setPublished( $xr->readString() );
					break;
				case "title":
					$this->setTitle( $xr->readString() );
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
			if(isset($props["ID"])) {
				$this->setID($props["ID"]);
			}
			if(isset($props["published"])) {
				$this->setPublished($props["published"]);
			}
			if(isset($props["title"])) {
				$this->setTitle($props["title"]);
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
		

