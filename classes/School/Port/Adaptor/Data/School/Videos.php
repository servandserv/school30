<?php
	namespace School\Port\Adaptor\Data\School;
		
	class Videos extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Videos";
		const ROOT = "Videos";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Videos\Video[]
		 */
		protected $Video = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Video"] = array(
				"prop"=>"Video",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Video
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Videos\Video $val
		 */
		public function setVideo ( \School\Port\Adaptor\Data\School\Videos\Video $val ) {
			$this->Video[] = $val;
			$this->_properties["Video"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Videos\Video[]
		 */
		public function setVideoArray ( array $vals ) {
			$this->Video = $vals;
			$this->_properties["Video"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Videos\Video | []
		 */
		public function getVideo($index = null) {
			if( $index !== null ) {
				$res = isset($this->Video[$index]) ? $this->Video[$index] : null;
			} else {
				$res = $this->Video;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\VideosValidator( $this, $handler );
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
			if( $props = $this->getVideo() ) {
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
				case "Video":
					$Video = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Videos\\Video");
					$this->setVideo( $Video->fromXmlReader( $xr ) );
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
			if(isset($props["Video"])) {
				if( is_array($props["Video"]) ) {
					foreach($props["Video"] as $k=>$v) {
						$Video = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Videos\\Video");
						$Video->fromJSON($v);
						$this->setVideo($Video);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Video = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Videos\\Video");
					$Video->fromJSON($v);
					$this->setVideo($Video);
				}
			}
		}
		
	}
		

