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
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Validation implements SingletonInterface
{

    /** @var Configuration */
    protected $extensionConfiguration;

    public function __construct()
    {
        $this->extensionConfiguration = GeneralUtility::makeInstance(Configuration::class);
    }

    /**
     * Validate the request
     *
     * @param string $mode
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function validate(string $mode, ServerRequestInterface $request): bool
    {
        $status = false;
        if (isset($request->getServerParams()['PHP_AUTH_USER']) && isset($request->getServerParams()['PHP_AUTH_PW'])) {

            $username = $request->getServerParams()['PHP_AUTH_USER'];
            $password = $request->getServerParams()['PHP_AUTH_PW'];

            if ($this->compareUser($mode, $username, $password)) {
                $status = true;
            }
        }

        return $status;
    }

    /**
     * Compare the user with the provided userlist
     *
     * @param string $mode either backend or frontend
     * @param string $username
     * @param string $password
     * @return bool
     */
    protected function compareUser(string $mode, string $username, string $password): bool
    {
        if ($mode !== 'backend' && $mode !== 'frontend') {
            throw new \UnexpectedValueException(sprintf('Mode "%s" is not supported', $mode), 1555482218);
        }

        $valid = false;
        if (empty($username) || empty($password)) {
            return false;
        }

        $userList = ($mode === 'backend') ? $this->extensionConfiguration->getBackendUsers() : $this->extensionConfiguration->getFrontendUsers();
        if (isset($userList[$username]) && $userList[$username] === $password) {
            $valid = true;
        }

        return $valid;
    }

}
