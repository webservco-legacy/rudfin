<?php
/**
 * $Id$
 *
 * Daybook object.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    FinApp
 * @subpackage ShowObject
 * @version    $Revision$
 * @since      Version 5
 * @access     public
 * @filesource
 */

/**
 * Security check.
 */
if ( !defined( '_RUDWEB' ) )
{
	/**
	 * Stop script execution.
	 */
	exit();
}

/**
 * Daybook
 *
 * Daybook object.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage DaybookObject
 *
 */
class Daybook extends Object
{
	/**
	 * Object properties.
	 *
	 * @var array
	 */
	public $mProp = array(
		'list' => array(
			'bin.book_id' => NULL,
			'book_date' => NULL,
			'book_account' => NULL,
			'book_type' => NULL,
			'book_amount' => NULL,
			'book_document' => NULL,
			'book_notes' => NULL,
	),
		'store' => array(
			'bin.book_id' => NULL,
			'book_date' => NULL,
			'book_account' => NULL,
			'book_type' => NULL,
			'book_amount' => NULL,
			'book_document' => NULL,
			'book_notes' => NULL,
	),
		'i18n' => array(
	),
	);

	/**
	 * Object tables.
	 *
	 * Use NULL for default.
	 *
	 * @var string
	 */
	protected $_mTable = array( 'store' => 'fin_daybooks', 'i18n' => NULL );
}
?>