<?php

test('it greets user',function(){
    $response = $this->get('/api/v2/welcome?first_name=Ziad');
    $response->assertStatus(200)
        ->assertJson([
            "data" => [
                "greeting" => "Hello, Ziad",
                "version" => "v2" 
            ],
        ]); 
});

test('it greets guest',function(){
    $response = $this->get('/api/v2/welcome');
    $response->assertStatus(200)
        ->assertJson([
            "data" => [
                "greeting" => "Hello, Guest",
                "version" => "v2" 
            ],
        ]); 
});