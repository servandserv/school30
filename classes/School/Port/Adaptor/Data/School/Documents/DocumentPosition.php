<?php

	namespace School\Port\Adaptor\Data\School\Documents;
		
	class DocumentPosition extends \Happymeal\Port\Adaptor\Data\XML\Schema\Int {
		const NS = "urn:ru:battleship:School:Documents";
		const ROOT = "DocumentPosition";
		const PREF = NULL;
		
		public function __construct( $val ) {
			parent::__construct( $val );
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
			parent::toXmlWriter($xw,$xmlname,$xmlns,$mode);
		}
	}
		

