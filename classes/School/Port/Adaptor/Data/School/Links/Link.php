<?php
	namespace School\Port\Adaptor\Data\School\Links;
		
	class Link extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Links";
		const ROOT = "Link";
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
		protected $Source = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Destination = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $DtStart = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $DtEnd = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Type = null;
		/**
		 * @maxOccurs 1 
		 * @var \String
		 */
		protected $Comments = null;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		protected $Ref = [];
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
			$this->_properties["source"] = array(
				"prop"=>"Source",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Source
			);
			$this->_properties["destination"] = array(
				"prop"=>"Destination",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Destination
			);
			$this->_properties["dtStart"] = array(
				"prop"=>"DtStart",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->DtStart
			);
			$this->_properties["dtEnd"] = array(
				"prop"=>"DtEnd",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->DtEnd
			);
			$this->_properties["type"] = array(
				"prop"=>"Type",
				"ns"=>"",
				"minOccurs"=>1,
				"text"=>$this->Type
			);
			$this->_properties["comments"] = array(
				"prop"=>"Comments",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Comments
			);
			$this->_properties["Ref"] = array(
				"prop"=>"Ref",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Ref
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
		public function setSource (  $val ) {
			$this->Source = $val;
			$this->_properties["source"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setDestination (  $val ) {
			$this->Destination = $val;
			$this->_properties["destination"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setDtStart (  $val ) {
			$this->DtStart = $val;
			$this->_properties["dtStart"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setDtEnd (  $val ) {
			$this->DtEnd = $val;
			$this->_properties["dtEnd"]["text"] = $val;
			return $this;
		}
		/**
		 * @param \String $val
		 */
		public function setType (  $val ) {
			$this->Type = $val;
			$this->_properties["type"]["text"] = $val;
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
		 * @param School\Port\Adaptor\Data\School\Resources\Ref $val
		 */
		public function setRef ( \School\Port\Adaptor\Data\School\Resources\Ref $val ) {
			$this->Ref[] = $val;
			$this->_properties["Ref"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Resources\Ref[]
		 */
		public function setRefArray ( array $vals ) {
			$this->Ref = $vals;
			$this->_properties["Ref"]["text"] = $vals;
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
		public function getSource() {
			return $this->Source;
		}
		/**
		 * @return \String
		 */
		public function getDestination() {
			return $this->Destination;
		}
		/**
		 * @return \String
		 */
		public function getDtStart() {
			return $this->DtStart;
		}
		/**
		 * @return \String
		 */
		public function getDtEnd() {
			return $this->DtEnd;
		}
		/**
		 * @return \String
		 */
		public function getType() {
			return $this->Type;
		}
		/**
		 * @return \String
		 */
		public function getComments() {
			return $this->Comments;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Resources\Ref | []
		 */
		public function getRef($index = null) {
			if( $index !== null ) {
				$res = isset($this->Ref[$index]) ? $this->Ref[$index] : null;
			} else {
				$res = $this->Ref;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Links\LinkValidator( $this, $handler );
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
			if( ($prop = $this->getSource()) !== NULL ) {
				$xw->writeElement( 'source', $prop );
			}
			if( ($prop = $this->getDestination()) !== NULL ) {
				$xw->writeElement( 'destination', $prop );
			}
			if( ($prop = $this->getDtStart()) !== NULL ) {
				$xw->writeElement( 'dtStart', $prop );
			}
			if( ($prop = $this->getDtEnd()) !== NULL ) {
				$xw->writeElement( 'dtEnd', $prop );
			}
			if( ($prop = $this->getType()) !== NULL ) {
				$xw->writeElement( 'type', $prop );
			}
			if( ($prop = $this->getComments()) !== NULL ) {
				$xw->writeElement( 'comments', $prop );
			}
			if( $props = $this->getRef() ) {
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
				case "autouid":
					$this->setAutouid( $xr->readString() );
					break;
				case "ID":
					$this->setID( $xr->readString() );
					break;
				case "source":
					$this->setSource( $xr->readString() );
					break;
				case "destination":
					$this->setDestination( $xr->readString() );
					break;
				case "dtStart":
					$this->setDtStart( $xr->readString() );
					break;
				case "dtEnd":
					$this->setDtEnd( $xr->readString() );
					break;
				case "type":
					$this->setType( $xr->readString() );
					break;
				case "comments":
					$this->setComments( $xr->readString() );
					break;
				case "Ref":
					$Ref = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Resources\\Ref");
					$this->setRef( $Ref->fromXmlReader( $xr ) );
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
			if(isset($props["source"])) {
				$this->setSource($props["source"]);
			}
			if(isset($props["destination"])) {
				$this->setDestination($props["destination"]);
			}
			if(isset($props["dtStart"])) {
				$this->setDtStart($props["dtStart"]);
			}
			if(isset($props["dtEnd"])) {
				$this->setDtEnd($props["dtEnd"]);
			}
			if(isset($props["type"])) {
				$this->setType($props["type"]);
			}
			if(isset($props["comments"])) {
				$this->setComments($props["comments"]);
			}
			if(isset($props["Ref"])) {
				if( is_array($props["Ref"]) ) {
					foreach($props["Ref"] as $k=>$v) {
						$Ref = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Resources\\Ref");
						$Ref->fromJSON($v);
						$this->setRef($Ref);
					}
				}
			}
		}
		
	}
		

