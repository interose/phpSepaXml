<?php
/**
 * php-sepa-xml
 *
 * @license   GNU LGPL v3.0 - For details have a look at the LICENSE file
 * @copyright ©2017 Furtmeier Hard- und Software
 * @link      https://github.com/nemiah/php-sepa-xml
 *
 * @author    Nena Furtmeier <support@furtmeier.it>
 */

namespace nemiah\phpSepaXml;

class SEPAFile {

	protected function start($type) {
		libxml_use_internal_errors(true);
		if ($type == "pain")
			return new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.008.003.02" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:iso:std:iso:20022:tech:xsd:pain.008.003.02 pain.008.003.02.xsd" />');
		
		return null;
	}

	public function errors() {
		$t = "";
		$errors = libxml_get_errors();
		foreach ($errors as $error)
			$t .= ($t != "" ? "<br />" : "").$this->libxml_display_error($error);
		
		libxml_clear_errors();
		
		return $t;
	}

	function libxml_display_error($error) {
		switch ($error->level) {
			case LIBXML_ERR_WARNING:
				$return .= "<b>Warning $error->code</b>: ";
			break;
			
			case LIBXML_ERR_ERROR:
				$return .= "<b>Error $error->code</b>: ";
			break;
		
			case LIBXML_ERR_FATAL:
				$return .= "<b>Fatal Error $error->code</b>: ";
			break;
		}
		
		$return .= trim($error->message);
		if($error->file)
			$return .= "<br />in <b>$error->file</b>";
		
		$return .= "<br />on line <b>$error->line</b>\n";

		return $return;
	}

}