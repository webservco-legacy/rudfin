<?php
/**
 * $Id$
 *
 * Application controller library.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    FinApp
 * @subpackage ControllerApp
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
 * ControllerApp
 *
 * Application controller library.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage ControllerApp
 *
 */
class ControllerApp extends Controller
{

    /**
     * Get output.
     *
     * @param array $contentData
     * @param string $customTemplate
     *
     * @return string
     */
    public function GetOutput( $contentData = array(), $customTemplate = NULL )
    {
        /**
         * Initialize output.
         *
         * This is actually not required,
         * but we need it here so we can use the
         * Output library configuration data.
         */
        $this->Output()->Init();

        /**
         * Use AJAX output?
         *
         * @var bool
         */
        $ajax = ( !empty( $_POST['token'] ) && ( $_SESSION['token'] == $_POST['token'] ) ) ? TRUE : FALSE;

        /**
         * Get tempplate name.
         *
         * @var string
         */
        $template_name = $this->Module()->GetTemplateName( $this->_mRequest, $ajax, $customTemplate );

        /**
         * Get default data.
         *
         * @var array
         */
        $default_data = $this->Module()->GetDefaultData();

        /**
         * Get all data.
         *
         * @var array
         */
        $data = array_merge_recursive( $default_data, $contentData );

        return $this->Output()->Out( $template_name, $data );
    }
}
?>