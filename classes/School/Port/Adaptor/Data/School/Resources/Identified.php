<?php
	namespace School\Port\Adaptor\Data\School\Resources;
		
	class Identified extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Resources";
		const ROOT = "Identified";
		const PREF = NULL;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Photos = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Docs = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Articles = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Albums = null;
		/**
		 * @maxOccurs 1 
		 * @var \Integer
		 */
		protected $Letters = null;
		public function __construct() {
			parent::__construct();
			
			$this->_properties["photos"] = array(
				"prop"=>"Photos",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Photos
			);
			$this->_properties["docs"] = array(
				"prop"=>"Docs",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Docs
			);
			$this->_properties["articles"] = array(
				"prop"=>"Articles",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Articles
			);
			$this->_properties["albums"] = array(
				"prop"=>"Albums",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Albums
			);
			$this->_properties["letters"] = array(
				"prop"=>"Letters",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Letters
			);
		}
		/**
		 * @param \Integer $val
		 */
		public function setPhotos (  $val ) {
			$this->Photos = $val;
			$this->_properties["photos"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setDocs (  $val ) {
			$this->Docs = $val;
			$this->_properties["docs"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setArticles (  $val ) {
			$this->Articles = $val;
			$this->_properties["articles"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setAlbums (  $val ) {
			$this->Albums = $val;
			$this->_properties["albums"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \Integer $val
		 */
		public function setLetters (  $val ) {
			$this->Letters = $val;
			$this->_properties["letters"]["text"] = $val;
			return $this;
		}
		/**
		 * @return \Integer
		 */
		public function getPhotos() {
			return $this->Photos;
		}
		/**
		 * @return \Integer
		 */
		public function getDocs() {
			return $this->Docs;
		}
		/**
		 * @return \Integer
		 */
		public function getArticles() {
			return $this->Articles;
		}
		/**
		 * @return \Integer
		 */
		public function getAlbums() {
			return $this->Albums;
		}
		/**
		 * @return \Integer
		 */
		public function getLetters() {
			return $this->Letters;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Resources\IdentifiedValidator( $this, $handler );
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
			if( ($prop = $this->getPhotos()) !== NULL ) {
				$xw->writeElement( 'photos', $prop );
			}
			if( ($prop = $this->getDocs()) !== NULL ) {
				$xw->writeElement( 'docs', $prop );
			}
			if( ($prop = $this->getArticles()) !== NULL ) {
				$xw->writeElement( 'articles', $prop );
			}
			if( ($prop = $this->getAlbums()) !== NULL ) {
				$xw->writeElement( 'albums', $prop );
			}
			if( ($prop = $this->getLetters()) !== NULL ) {
				$xw->writeElement( 'letters', $prop );
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
				case "photos":
					$this->setPhotos( $xr->readString() );
					break;
				case "docs":
					$this->setDocs( $xr->readString() );
					break;
				case "articles":
					$this->setArticles( $xr->readString() );
					break;
				case "albums":
					$this->setAlbums( $xr->readString() );
					break;
				case "letters":
					$this->setLetters( $xr->readString() );
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
			if(isset($props["photos"])) {
				$this->setPhotos($props["photos"]);
			}
			if(isset($props["docs"])) {
				$this->setDocs($props["docs"]);
			}
			if(isset($props["articles"])) {
				$this->setArticles($props["articles"]);
			}
			if(isset($props["albums"])) {
				$this->setAlbums($props["albums"]);
			}
			if(isset($props["letters"])) {
				$this->setLetters($props["letters"]);
			}
		}
		
	}
		

