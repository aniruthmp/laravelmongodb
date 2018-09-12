<?php

namespace App\Http\Controllers;

use Bschmitt\Amqp\Amqp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RabbitController extends Controller
{
    public function send(Request $request)
    {
        $connection = new Connection();
        // Initialize a Producer object with a connection
        $bowlerProducer = new Producer($connection);

        // Setup the producer's exchange name and other optional parameters: exchange type, passive, durable, auto delete and delivery mode
        $bowlerProducer->setup('amq.direct', 'direct', false, true, false, 2);

        // Send a message with an optional routingKey
        $bowlerProducer->send($request->getContent(), null);
        $response = new Response(
            'Success',
            Response::HTTP_OK
        );
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }

    public function recieve()
    {
        $amqp = new Amqp;
        $amqp->consume('authors', function ($message, $resolver) {
            var_dump($message->body);
            $resolver->acknowledge($message);
        });
    }

}
