<?php

namespace App\Providers;

use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
// use BeyondCode\LaravelWebSockets\WebSocketsServiceProvider;

WebSocketsRouter::route('mqtt', function ($connection) {
    // Subscribe to the MQTT broker
    $mqttClient = new MqttClient('mqtt://IPADDRESS'); // Replace with your MQTT broker URL
    $mqttClient->connect();
    $mqttClient->subscribe('sensor/readings');

    // Listen for incoming MQTT messages
    $mqttClient->on('message', function (MqttMessage $message) {
        // Parse the MQTT message as JSON
        $jsonData = json_decode($message->getPayload());

        // Broadcast the JSON data to all connected WebSocket clients
        broadcast(new SensorReadingEvent($jsonData));
    });

    // Handle any errors that occur
    $mqttClient->on('error', function (MqttException $e) {
        Log::error('MQTT error: ' . $e->getMessage());
    });

    // Close the MQTT connection when the WebSocket connection closes
    $connection->onClose(function () {
        $mqttClient->disconnect();
    });
});

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
