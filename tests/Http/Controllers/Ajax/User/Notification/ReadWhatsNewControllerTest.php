<?php

declare(strict_types=1);

namespace Tests\Http\Controllers\Ajax\User\Notification;

use App\Http\Controllers\Ajax\User\Notification\ReadWhatsNewController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

final class ReadWhatsNewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testReadNewsMarksUserAsRead(): void
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        // dd($user);
        $this->assertEquals(0, $user->is_read_news);

        $requestData = ['user_news' => 1];
        $request = new Request($requestData);

        // Act
        $controller = new ReadWhatsNewController();
        $response = $controller($request);

        // Assert
        $this->assertEquals(1, $user->fresh()->is_read_news);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response->getContent());
    }
}
