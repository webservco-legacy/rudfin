<?php
/**
 * $Id$
 *
 * Daybook controlller.
 *
 * Module: Daybooks
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
 * Controller_Daybooks_Daybook
 *
 * Daybook Controller for Daybooks module.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage DaybooksModule
 *
 */
class Controller_Daybooks_Daybook extends ControllerApp
{
	public function ListBooks()
	{
		/**
		 * @var string
		 */
		$data['title'] = 'Daybooks';

		/**
		 * @var string
		 */
		$data['page'] = 'daybooks';

		/**
		 * @var array
		 */
		$data['form'] = $this->Module()->HandleBooksForm();

		/**
		 * @var books
		 */
		$data['books'] = $this->Module()->GetBooks();
		
		echo $this->GetOutput( $data );

		return TRUE;
	}
}
?>