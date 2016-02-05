<?php
namespace PartKeepr\CoreBundle;

class PartKeeprVersion
{
    /**
     * Holds the PartKeepr Version.
     *
     * If 0.78, then the function will return 'GIT Development Version'.
     * 0.78 will be replaced by the build script with the actual version.
     *
     * The reason why we have a separate class for the version constant is that
     * we can easily replace it from scripts.
     */
    const PARTKEEPR_VERSION = '0.78';
}
