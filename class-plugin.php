<?php

namespace HM\MUPluginsLoader;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface, EventSubscriberInterface {

	/**
	 * The composer class.
	 *
	 * @var Composer
	 */
	protected $composer;

	/**
	 * Called when the plugin is activated.
	 *
	 * @param Composer $composer The composer class.
	 */
	public function activate( Composer $composer ) {
		$this->composer = $composer;
	}

	public static function getSubscribedEvents() {
		return array(
			'post-autoload-dump' => 'installLoader',
		);
	}

	public function installLoader() {
		$extra = $this->composer->getPackage()->getExtra();
		$hm_mu_plugins = $extra['mu-plugins'] ?? [];
		$hm_mu_plugins_path = $extra['mu-plugins-path'] ?? 'wp-content/mu-plugins';

		$loader = file_get_contents( __DIR__ . '/loader.php' );
		$loader = str_replace( '$hm_mu_plugins = []', '$hm_mu_plugins = ' . var_export( $hm_mu_plugins, true ), $loader );

		$dest = dirname( $this->composer->getConfig()->get( 'vendor-dir' ) )
			. DIRECTORY_SEPARATOR . $hm_mu_plugins_path
			. DIRECTORY_SEPARATOR . 'loader.php';
		file_put_contents( $dest, $loader );
	}

}
