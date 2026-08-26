<?php

use App\Adapters\LocalSmsAdapter;
use App\Clients\LocalSmsClient;

uses(Tests\TestCase::class);

it('returns the local message_id',function(){
    $local = Mockery::mock(LocalSmsClient::class);
    $local->shouldReceive('sendSms')
        ->once()
        ->with('+201001234567','Hi','OBJECTS')
        ->andReturn(['message_id'=>'local_9']);
    
        $adapter = new LocalSmsAdapter($local,'OBJECTS');

        expect($adapter->send('+201001234567', 'Hi'))->toBe('local_9');
});