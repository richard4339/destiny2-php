# Creating Mock Test Files

Use `MockClient` instead of `Client` and call `setMockFile()` to give the library a file. Then calling a function regularly will also output the JSON output to `src/mock/[YOUR FILE NAME]-[TIMESTAMP].json`, which can then be moved to wherever is required.

```
<?php

require 'vendor/autoload.php';

$client = new \Destiny\MockClient('[YOUR API KEY]');

$client->setMockFile('getClanMembers');

$results = $client->getClanMembers([YOUR CLAN ID]);
```