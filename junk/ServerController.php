<?php
namespace app\commands;

use svbackend\wschat\components\Chat;
use svbackend\wschat\components\ChatManager;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class ServerController extends \yii\console\Controller
{
    public function actionRun()
    {
        $manager = Yii::configure(new ChatManager(), [
            'userClassName' => Users::class, // Your User Active Record model class
        ]);
        $server = IoServer::factory(new HttpServer(new WsServer(new Chat($manager))), 8080);

        // If there no connections for a long time - db connection will be closed and new users will get the error
        // so u need to keep connection alive like that
        // Что бы база данных не разрывала соединения изза неактивности
        $server->loop->addPeriodicTimer(60, function () use ($server) {
            try{
                Yii::$app->db->createCommand("DO 1")->execute();
            }catch (Exception $e){
                Yii::$app->db->close();
                Yii::$app->db->open();
            }
            // Also u can send messages to your cliens right there
            /*
            foreach ($server->app->clients as $client) {
                $client->send("hello client");
            }*/
        });

        $server->run();
        echo 'Server was started successfully. Setup logging to get more details.'.PHP_EOL;
    }
}