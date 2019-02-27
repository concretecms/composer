<?php
declare(strict_types=1);

namespace ConcreteComposer\Foo\Bar;

use Symfony\Component\HttpFoundation\Response;
use Concrete\Core\Http\ResponseFactoryInterface;
use Concrete\Core\User\UserInfoRepository;
use Concrete\Core\Validation\CSRF\Token;

/**
 * Autoloading for the "\ConcreteComposer" namespace is managed in /composer.json
 */
class FooBar
{

    /**
     * The UserInfoRepository instance that demonstrates integration with c5 services
     *
     * @var UserInfoRepository
     */
    protected $repository;

    /**
     * A response factory for generating a response to output
     * @var ResponseFactoryInterface
     */
    protected $responseFactory;

    /**
     * The validator we use to prevent XSRF
     *
     * @var Token
     */
    private $token;

    public function __construct(UserInfoRepository $repository, Token $token, ResponseFactoryInterface $responseFactory)
    {
        $this->repository = $repository;
        $this->responseFactory = $responseFactory;
        $this->token = $token;
    }

    /**
     * Example controller style function to demonstrate testing
     *
     * @param int $userId
     * @param string $token
     *
     * @return Response
     */
    public function getUserInfo(int $userId, string $token): Response
    {
        // Make sure our token is valid
        if (!$this->token->validate('find_user_id', $token)) {
            return $this->responseFactory->error($this->token->getErrorMessage(), Response::HTTP_FORBIDDEN);
        }

        // Find our user
        $userInfo = $this->repository->getByID($userId);
        if (!$userInfo) {
            return $this->responseFactory->notFound($this->token->getErrorMessage());
        }

        // Output the user info
        return $this->responseFactory->json(['id' => $userInfo->getUserID(), 'name' => $userInfo->getUserName()]);
    }
}
