<?php

declare(strict_types=1);

namespace StudioMitte\BasicAuthentication\Service;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Configuration implements SingletonInterface
{

    /** @var bool */
    protected $backendEnabled = false;

    /** @var array */
    protected $backendUsers = [];

    /** @var bool */
    protected $frontendEnabled = false;

    /** @var array */
    protected $frontendUsers = [];

    public function __construct()
    {
        try {
            $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
            $configuration = $extensionConfiguration->get('basic_authentication');

            $this->backendEnabled = (bool)$configuration['backendEnabled'];
            $this->frontendEnabled = (bool)$configuration['frontendEnabled'];
            $this->backendUsers = $this->parseUserList((string)$configuration['backendUsers']);
            $this->frontendUsers = $this->parseUserList((string)$configuration['frontendUsers']);
        } catch (ExtensionConfigurationExtensionNotConfiguredException $e) {

        } catch (ExtensionConfigurationPathDoesNotExistException $e) {

        }
    }

    protected function parseUserList(string $userListString): array
    {
        $users = [];
        $userList = GeneralUtility::trimExplode('|', $userListString, true);
        foreach ($userList as $user) {
            $split = GeneralUtility::trimExplode(':', $user, true, 2);
            $users[$split[0]] = $split[1];
        }

        return $users;
    }

    /**
     * @return bool
     */
    public function isBackendEnabled(): bool
    {
        return $this->backendEnabled;
    }

    /**
     * @return array
     */
    public function getBackendUsers(): array
    {
        return $this->backendUsers;
    }

    /**
     * @return bool
     */
    public function isFrontendEnabled(): bool
    {
        return $this->frontendEnabled;
    }

    /**
     * @return array
     */
    public function getFrontendUsers(): array
    {
        return $this->frontendUsers;
    }


}
