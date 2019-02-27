<?php
declare(strict_types=1);

namespace ConcreteComposer\Foo\Bar;

use Concrete\Core\Http\ResponseFactoryInterface;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;
use Concrete\Core\Validation\CSRF\Token;
use ConcreteComposer\TestCase;
use Mockery as M;
use Symfony\Component\HttpFoundation\Response;

class FooBarTest extends TestCase
{
    /** @var UserInfoRepository|M\Mock */
    private $userInfoRepository;

    /** @var Token|M\Mock */
    private $tokenValidator;

    /** @var ResponseFactoryInterface|M\Mock */
    private $responseFactory;

    /** @var UserInfo|M\Mock */
    private $userInfo;

    /** @var Response|M\Mock */
    private $response;

    /** @var FooBar */
    private $instance;

    protected function setUp(): void
    {
        // Setup test doubles for our dependencies
        $this->userInfoRepository = M::mock(UserInfoRepository::class);
        $this->tokenValidator = M::mock(Token::class);
        $this->responseFactory = M::mock(ResponseFactoryInterface::class);
        $this->userInfo = M::mock(UserInfo::class);
        $this->response = M::mock(Response::class);

        $this->instance = new FooBar($this->userInfoRepository, $this->tokenValidator, $this->responseFactory);
    }

    public function testGetUserInfo(): void
    {
        // Setup our behaviors
        $this->tokenValidator->shouldReceive('validate')->with('find_user_id', 'foo')->andReturnTrue();
        $this->userInfoRepository->shouldReceive('getById')->with(1)->andReturn($this->userInfo);
        $this->userInfo->shouldIgnoreMissing('baz');
        $this->responseFactory->shouldReceive('json')->andReturn($this->response);

        // Create our class and run the test
        $result = $this->instance->getUserInfo(1, 'foo');

        $this->assertSame($this->response, $result);
    }

    public function testFailsWithBadToken(): void
    {
        // Setup our behaviors
        $this->tokenValidator->shouldReceive('validate')->with('find_user_id', 'foo')->andReturnFalse();
        $this->tokenValidator->shouldReceive('getErrorMessage')->andReturn('foo');
        $this->responseFactory->shouldReceive('error')->andReturn($this->response);

        // Create our class and run the test
        $result = $this->instance->getUserInfo(1, 'foo');

        $this->assertSame($this->response, $result);
    }

    public function testFailsWithBadUserId(): void
    {
        // Setup our behaviors
        $this->tokenValidator->shouldReceive('validate')->with('find_user_id', 'foo')->andReturnTrue();
        $this->userInfoRepository->shouldReceive('getById')->with(1)->andReturnNull();
        $this->tokenValidator->shouldReceive('getErrorMessage')->andReturn('foo');
        $this->responseFactory->shouldReceive('notFound')->andReturn($this->response);

        // Create our class and run the test
        $result = $this->instance->getUserInfo(1, 'foo');

        $this->assertSame($this->response, $result);
    }
}
