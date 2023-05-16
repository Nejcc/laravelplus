<?php

declare(strict_types=1);

namespace Tests\Http\Controllers\Ajax\User\Notification;

use App\Http\Controllers\Ajax\User\Notification\ReadWhatsNewController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

final class ReadWhatsNewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testReadNewsMarksUserAsRead(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertEquals(0, $user->is_read_news);

        $requestData = ['user_news' => 1];
        $request = new Request($requestData);

        // Act
        $controller = new ReadWhatsNewController();
        $response = $controller($request);

        // Assert
        $this->assertEquals(1, $user->fresh()->is_read_news);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('home'), $response->getTargetUrl());
    }
}
