<?php
	namespace School\Port\Adaptor\Data\School\Unions;
		
	class Forms extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {
			
		const NS = "urn:ru:battleship:School:Unions";
		const ROOT = "Forms";
		const PREF = NULL;
		/**
		 * @maxOccurs unbounded 
		 * @var School\Port\Adaptor\Data\School\Unions\Form[]
		 */
		protected $Form = [];
		public function __construct() {
			parent::__construct();
			
			$this->_properties["Form"] = array(
				"prop"=>"Form",
				"ns"=>"",
				"minOccurs"=>0,
				"text"=>$this->Form
			);
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Form $val
		 */
		public function setForm ( \School\Port\Adaptor\Data\School\Unions\Form $val ) {
			$this->Form[] = $val;
			$this->_properties["Form"]["text"][] = $val;
			return $this;
		}
		/**
		 * @param School\Port\Adaptor\Data\School\Unions\Form[]
		 */
		public function setFormArray ( array $vals ) {
			$this->Form = $vals;
			$this->_properties["Form"]["text"] = $vals;
		}
		/**
		 * @return School\Port\Adaptor\Data\School\Unions\Form | []
		 */
		public function getForm($index = null) {
			if( $index !== null ) {
				$res = isset($this->Form[$index]) ? $this->Form[$index] : null;
			} else {
				$res = $this->Form;
			}
			return $res;
		}
		
		public function validateType( \Happymeal\Port\Adaptor\Data\ValidationHandler $handler ) {
			$validator = new \School\Port\Adaptor\Data\School\Unions\FormsValidator( $this, $handler );
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
			if( $props = $this->getForm() ) {
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
				case "Form":
					$Form = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Form");
					$this->setForm( $Form->fromXmlReader( $xr ) );
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
			if(isset($props["Form"])) {
				if( is_array($props["Form"]) ) {
					foreach($props["Form"] as $k=>$v) {
						$Form = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Form");
						$Form->fromJSON($v);
						$this->setForm($Form);
					}
				}
			} elseif(array_keys($props) == array_keys(array_keys($props))) {
				foreach($props as $v) {
					$Form = \Adaptor_Bindings::create("\\School\\Port\\Adaptor\\Data\\School\\Unions\\Form");
					$Form->fromJSON($v);
					$this->setForm($Form);
				}
			}
		}
		
	}
		

