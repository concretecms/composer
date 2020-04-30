<?php
namespace Concrete5\Composer;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Asset\AssetPointer;
use Concrete\Core\Asset\CssAsset;
use Concrete\Core\Asset\JavascriptAsset;
use Illuminate\Support\Str;

if (!function_exists(mix::class)) {
    /**
     * Handle loading in laravel mix assets
     * This function is useful in development, do:
     * `<script src='<?= mix($theme->getThemePath() . '/js/yourfile.js') ?>'></script>`
     *
     * @param string $path
     * @param string $manifestDirectory
     *
     * @return string
     */
    function mix($path, $manifestDirectory = __DIR__ . '/../public')
    {
        // Create a static variable to store our manifests and hot file results so that we only read once
        static $manifestMap = [];

        // Normalize directory and set up file paths
        $manifestDirectory = rtrim($manifestDirectory, '/');
        $manifestPath = $manifestDirectory . '/mix-manifest.json';
        $hotPath = $manifestDirectory . '/hot';

        // First let's see if we already have this mapped, this should happen every time past the first call per path
        $hotMapped = isset($manifestMap[$hotPath]) ? $manifestMap[$hotPath] : null;
        $manifestMapped = isset($manifestMap[$manifestPath]) ? $manifestMap[$manifestPath] : null;

        if ($hotMapped) {
            return h($hotMapped . $path);
        }
        if ($manifestMapped) {
            return isset($manifestMapped[$path]) ? $manifestMapped[$path] : $path;
        }

        // Next let's try to load our hot file
        if ($hotMapped !== false && file_exists($hotPath)) {
            $url = rtrim(file_get_contents($hotPath));
            $url = rtrim(Str::startsWith($url, ['http://', 'https://']) ? $url : '//localhost:8080', '/');

            // Store the hot value for future calls
            $manifestMap[$hotPath] = $url;

            // If it isn't http or https just fall back to whatever protocol the site is using
            return h($url . $path);
        }

        // Store this to speed up hot misses
        $manifestMap[$hotPath] = false;

        // Lastly let's check our manifest file
        if ($manifestMapped !== false && file_exists($manifestPath)) {
            $manifest = json_decode(rtrim(file_get_contents($manifestPath)), true);
            $manifestMap[$manifestPath] = $manifest;

            if (isset($manifest[$path])) {
                return $manifest[$path];
            }
        } else {
            // Store this to speed up manifest misses
            $manifestMap[$manifestPath] = false;
        }

        // Fallback to just spitting out the given path
        return $path;
    }
}

if (!function_exists(mixAsset::class)) {
    /**
     * Resolve a mix built file and return an Asset instance for it
     *
     * @param string $path
     * @param null $extension
     * @param string $manifestDirectory
     *
     * @return string
     */
    function mixAsset($path, $extension = null, $manifestDirectory = __DIR__ . '/../public')
    {
        // First let's normalize the given directory
        $manifestDirectory = realpath($manifestDirectory);
        if (!$manifestDirectory || !is_dir($manifestDirectory)) {
            throw new \InvalidArgumentException('Invalid manifest directory provided.');
        }

        // Next let's resolve the actual path to the file
        $mixPath = mix($path, $manifestDirectory);
        $handle = 'mix' . '/' . $manifestDirectory . '/' . $mixPath;

        // Handle creating the proper asset type based on the extension
        $extension = $extension ?: pathinfo($path, PATHINFO_EXTENSION);
        switch (strtolower($extension)) {
            case 'js':
                $asset = new JavascriptAsset($handle);
                break;
            case 'css':
                $asset = new CssAsset($handle);
                break;
            default:
                throw new \InvalidArgumentException('Invalid extension provided. Only js and css are supported.');
        }

        // We don't necessarily know that the asset is not local but it doesn't really matter, it works to say it is
        $asset->setAssetIsLocal(false);
        $asset->setAssetUrl($mixPath);

        // Register the asset on the way out, we do this so that we can leverage the asset system's ability to load
        // dependencies only once per page even if it's required multiple times.
        $assetList = AssetList::getInstance();
        $assetList->registerAsset($asset);

        return $asset;
    }
}
