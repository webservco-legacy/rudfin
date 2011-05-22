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
		/**
		 * @var array
		 */
		$db_data = array( 'bin.book_id', 'book_date', 'book_account', 'book_type', 'book_amount', 'book_document', 'book_notes',);

		/**
		 * @var array
		 */
		$db_table = 'fin_object_daybook';

		/**
		 * @var array
		 */
		$db_options = NULL;

		return Core::Database()->Retrieve( $db_data, $db_table, $db_options );
	}

	public function HandleBooksDelete( $request )
	{
		if ( !empty( $request['query']['delete'] ) )
		{
			/**
			 * @var array
			 */
			$db_options['conditions'] = array( 'bin.book_id', $request['query']['delete'] );

			/**
			 * @var array
			 */
			$db_options['limit'] = 1;

			Core::Database()->Delete( 'fin_daybooks', $db_options );
			
			Core::Router()->Redirect( 'daybooks' );

			return TRUE;
		}

		return FALSE;
	}

	public function HandleBooksAdd()
	{
		Core::Form()->SetMethod( 'post' );

		Core::Form()->SetData( Core::Config()->Get( 'daybooks.form.daybook_add' ) );

		/**
		 * @var array
		 */
		$form['meta'] = Core::Form()->GetMeta();

		/**
		 * @var array
		 */
		$form['errors'] = array();

		if ( !empty( $_POST ) )
		{
			/**
			 * @var bool
			 */
			$validation = Core::Form()->Validate();

			if ( FALSE !== $validation )
			{
				/**
				 * @var array
				 */
				$form['data'] = Core::Form()->GetFilteredData();

				unset($form['data']['book_add']);

				Core::Database()->Create( $form['data'], 'fin_daybooks' );

				Core::Router()->Redirect();
			}
			else
			{
				/**
				 * @var array
				 */
				$form['data'] = Core::Form()->GetData();

				/**
				 * @var array
				 */
				$form['errors'] = Core::Form()->GetErrors();
			}
		}
		else
		{
			/**
			 * @var array
			 */
			$form['data'] = Core::Form()->GetData();
		}

		return $form;
	}
}
?>