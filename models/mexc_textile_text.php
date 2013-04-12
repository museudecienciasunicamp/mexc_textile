<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_textile.git Mexc Textile public repository
 */

class MexcTextileText extends MexcTextileAppModel
{
	var $name = 'MexcTextileText';
	var $validate = array();
	var $actsAs = array('Containable');
	
/**
 * Creates a empty row on database.
 * 
 * @access public
 * @return boolean|array Saved data if success or false if fail
 */
	function createEmpty()
	{
		$data = array();
		$data[$this->alias]['textile'] = '';
		
		$this->create();
		return $this->save($data, false);
	}

/**
 * Find suited for the burocrata form. Part of the Burocrata/Backstage contract.
 * 
 * @access public
 * @return array Data from find
 */
	function findBurocrata($id)
	{
		$this->contain();
		$data = $this->findById($id);
		return $data;
	}
	
	function beforeSave()
	{
		App::import('Vendor', 'Textile');
		$Textile = new Textile;
		$this->data[$this->alias]['html'] = $Textile->textileThis($this->data[$this->alias]['textile']);
		return true;
	}
}
