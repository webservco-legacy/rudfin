<?php
/**
 * $Id$
 *
 * Daybooks module.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    FinApp
 * @subpackage DaybooksModule
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
 * Module_Daybooks
 *
 * Model class for Daybooks module.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage DaybooksModule
 *
 */
class Module_Daybooks extends ModuleApp
{
	public function GetBooks()
	{
		$data = array();

		$db_data = array( 'book_date', 'book_account', 'book_type', 'book_amount', 'book_document', 'book_notes',);
		$db_table = 'fin_daybooks';
		$db_options = NULL;

		$data = Core::Database()->Retrieve( $db_data, $db_table, $db_options );

		return $data;
	}
}
?>