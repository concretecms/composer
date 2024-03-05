<?php

use function Concrete5\Composer\mix;
use function Concrete5\Composer\mixAsset;

it('mix works', function () {
    expect(mix('/foo', __DIR__ . '/../fixtures'))
        ->toBe('/baz')
        ->and(mix('/foo', __DIR__ . '/../fixtures/hotdir'))
        ->toBe('https://example.com:1337/foo');
});

it('mixAsset works', function () {
    $list = Mockery::spy(\Concrete\Core\Asset\AssetList::class);
    $registered = null;
    $list->expects('registerAsset')->twice()->with(Mockery::capture($registered));

    expect(mixAsset('/foo', 'js', __DIR__ . '/../fixtures', $list))
        ->toBe($registered)
        ->getAssetPosition()->toBe(\Concrete\Core\Asset\AssetInterface::ASSET_POSITION_FOOTER)
        ->getAssetURL()->toBe('/baz')

        // Test with hotdir
        ->and(mixAsset('/foo', 'js', __DIR__ . '/../fixtures/hotdir', $list))
        ->toBe($registered)
        ->getAssetPosition()->toBe(\Concrete\Core\Asset\AssetInterface::ASSET_POSITION_FOOTER)
        ->getAssetURL()->toBe('https://example.com:1337/foo');
});