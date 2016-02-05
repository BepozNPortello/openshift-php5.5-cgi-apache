<?php
namespace PartKeepr\AuthBundle\Action;

use Dunglas\ApiBundle\Action\ActionUtilTrait;
use Dunglas\ApiBundle\Exception\RuntimeException;
use Dunglas\ApiBundle\Model\DataProviderInterface;
use PartKeepr\AuthBundle\Entity\User;
use PartKeepr\AuthBundle\Exceptions\UserProtectedException;
use PartKeepr\AuthBundle\Services\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Custom API action deleting an user
 */
class DeleteUserAction
{
    use ActionUtilTrait;

    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(DataProviderInterface $dataProvider, UserService $userService)
    {
        $this->dataProvider = $dataProvider;
        $this->userService = $userService;
    }

    /**
     * Returns an item to delete.
     *
     * @param Request    $request
     * @param string|int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     * @throws RuntimeException
     * @throws UserProtectedException
     */
    public function __invoke(Request $request, $id)
    {
        list($resourceType) = $this->extractAttributes($request);

        /**
         * @var User $item
         */
        $item = $this->getItem($this->dataProvider, $resourceType, $id);

        if ($item->isProtected()) {
            throw new UserProtectedException();
        }

        $this->userService->deleteFOSUser($item);


        return $item;
    }
}
