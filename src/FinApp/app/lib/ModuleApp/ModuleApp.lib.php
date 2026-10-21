<?php
/**
 * $Id$
 *
 * Application module library.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @copyright  Copyright (c) 2008 - 2011, RudiSoft.Net
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @package    FinApp
 * @subpackage ModuleApp
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
 * ModuleApp
 *
 * Application module library.
 *
 * @author     Radu Maier <rudisoft@rudisoft.net>
 * @package    FinApp
 * @subpackage ModuleApp
 *
 */
class ModuleApp extends Module
{
    /**
     * Get default output data.
     *
     * @return array
     */
    public function GetDefaultData()
    {
        /**
         * @var array
         */
        $default_data = array();

        /**
         * @var array
         */
        $default_data['url_app'] = Core::Config()->Get( 'url.app' );

        /**
         * @var array
         */
        $default_data['url_skin'] = Core::Config()->Get( 'url.app' ) .
        Core::Config()->Get( 'dir.app.usr' ) . '/' .
        Core::Config()->Get( 'dir.app.skins' ) . '/' .
        Core::Config()->Get( 'output.skin' ) . '/';

        /**
         * @var array
         */
        $default_data['url_scripts'] = Core::Config()->Get( 'url.app' ) .
        Core::Config()->Get( 'dir.app.usr' ) . '/scripts/';

        /**
         * @var array
         */
        $default_data['title_app'] = Core::Config()->Get( 'app.title' );

        /**
         * @var array
         */
        $default_data['token'] = !empty( $_SESSION['token'] ) ? $_SESSION['token'] : NULL;

        return $default_data;
    }

    /**
     * Get template name.
     *
     * @param array $request
     * @param bool $ajax
     * @param string $customTemplate
     *
     * @return string
     */
    public function GetTemplateName( $request, $ajax = FALSE, $customTemplate = NULL )
    {
        if ( !empty( $request['action'] ) && !empty( $request['module'] ) )
        {
            /**
             * @var string
             */
            $template_suffix = !empty( $customTemplate ) ? $customTemplate : $request['action'];
            /**
             * @var string
             */
            $template_name = strtolower( ltrim( $request['module'], 'Module_' ) . '_' . $template_suffix );
        }
        else
        {
            $template_name = !empty( $customTemplate ) ? $customTemplate : 'error';
        }

        return ( TRUE !== $ajax ) ? $template_name : $template_name . '_ajax';
    }

    /**
     * Load custom configuration files.
     *
     * $customConfig can be a stringor an array
     *
     * @param mixed $customConfig
     *
     * @return bool
     */
    public function LoadCustomConfig( $customConfig )
    {
        if ( is_array( $customConfig ) )
        {
            /**
             * Call self recursively.
             */
            array_map( array( $this, __FUNCTION__ ), $customConfig );
        }
        else
        {
            /**
             * @var string
             */
            $module_name = ltrim( $request['module'], 'Module_' );

            /**
             * @var string
             */
            $config_file = Core::Config()->Get( 'path.app' ) .
            'etc/mod/' . $module_name . 
            '/' .  strtolower( $module_name ) . '.' . $customConfig . '.cfg.xml';

            /**
             * Load custom configuration file.
             */
            Core::Config()->Set( $config_file );
        }

        return TRUE;
    }
}
?>