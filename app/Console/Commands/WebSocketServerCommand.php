<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WebSocketServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class WebSocketServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:serve {port=8080}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the WebSocket server for real-time updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $port = (int) $this->argument('port');
        $this->info("Starting WebSocket server on port {$port}");

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketServer()
                )
            ),
            $port
        );

        $this->info("WebSocket server started");
        $server->run();
    }
}
