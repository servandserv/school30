<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Events extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Events";
		const ROOT = "Events";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Events\Event[]
		 */
		protected $Event = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Event"] = array(
				"prop"=>"Event",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Event
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Events\Event $val
		 */
		public function setEvent ( \School\Port\Adaptor\Data\School\Events\Event $val ) {
			$this->Event[] = $val;
			$this->_properties["Event"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Events\Event[]
		 */
		public function setEventArray ( array $vals ) {
			$this->Event = $vals;
			$this->_properties["Event"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Events\Event | []
		 */
		public function getEvent($index = null) {
			if( $index !== null ) {
				$res = isset($this->Event[$index]) ? $this->Event[$index] : null;
			} else {
				$res = $this->Event;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\EventsValidator( $this, $handler );
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
			if( $props = $this->getEvent() ) {
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
				case "Event":
					$Event = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Events\\Event");
					$this->setEvent( $Event->fromXmlReader( $xr ) );
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
			if(isset($props["Event"])) {
				if( is_array($props["Event"]) ) {
					foreach($props["Event"] as $k=>$v) {
						$Event = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Events\\Event");
						$Event->fromJSON($v);
						$this->setEvent($Event);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Event = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Events\\Event");
					$Event->fromJSON($v);
					$this->setEvent($Event);
				}
			}
		}
		
	}
		

