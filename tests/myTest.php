<?php

use PHPUnit\Framework\TestCase;
use App\ClassicTrader\Core\Database;

class MyTest extends TestCase
{
    public function testExample()
    {
        // Create a mock for the Database class, mocking the 'get' method
        $databaseMock = $this->createMock(Database::class);

        // Configure the mock
        $databaseMock->method('get')
            ->willReturn([
                'id' => 1,
                'name' => 'Test',
                // ... other fields ...
            ]);

        // Now, you can use $databaseMock as an instance of Database.
        // Calls to the 'get' method will return the array specified above.
        $result = $databaseMock->get('table', ['*'], ['id' => 1]);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Test', $result['name']);
    }
}