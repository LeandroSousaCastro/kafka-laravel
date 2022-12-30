<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Contracts\KafkaConsumerMessage;

class MyTopicConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "consume:my-topic";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Consume Kafka messages from 'my-topic'.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $consumer = kafka::createConsumer(['my-topic'])
            ->withBrokers('host.docker.internal:9092')
            ->withAutoCommit()
            ->withHandler(function(KafkaConsumerMessage $message) {
                // Handle your message here
                var_dump($message);
            })
            ->build();
            
            $consumer->consume();
    }
}
