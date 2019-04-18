<?php

declare(strict_types=1);

namespace StudioMitte\BasicAuthentication\Middleware;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use StudioMitte\BasicAuthentication\Service\Configuration;
use StudioMitte\BasicAuthentication\Service\Validation;
use TYPO3\CMS\Backend\Exception\BackendLockedException;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;

abstract class AbstractBasicAuthentication
{


    /** @var Validation */
    protected $validationService;

    /** @var Configuration */
    protected $extensionConfiguration;

    public function __construct()
    {
        $this->validationService = GeneralUtility::makeInstance(Validation::class);
        $this->extensionConfiguration = GeneralUtility::makeInstance(Configuration::class);
    }

}
