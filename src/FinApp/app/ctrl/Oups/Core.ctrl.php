<?php
/**
 * $Id$
 *
 * Core controlller.
 *
 * Module: Oups
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    FinApp
 * @subpackage OupsModule
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
 * Controller_Oups_Core
 *
 * Core Controller for Oups module.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage OupsModule
 *
 */
class Controller_Oups_Core extends ControllerApp
{
	public function Oups404()
	{
		/**
		 * @var string
		 */
		$data['title'] = 'Page Not Found';

		/**
		 * @var string
		 */
		$data['page'] = 'error';

		header('HTTP/1.1 404 Not Found');

		echo $this->GetOutput( $data );

		return TRUE;
	}
}
?>