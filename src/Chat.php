<?php
namespace WvsuMeet;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
  protected $clients;

  public function __construct()
  {
    $this->clients = new \SplObjectStorage;
  }

  public function onOpen(ConnectionInterface $conn)
  {
    // Store the new connection to send messages to later
    $this->clients->attach($conn);

    echo "New connection! ({$conn->resourceId})\n";
  }

  public function onMessage(ConnectionInterface $from, $msg)
  {
    $jsonMessage = json_decode($msg, associative: true);
    $numRecv = count($this->clients) - 1;
    echo sprintf(
      'Connection %d sending message "%s" to %d other connection%s' . "\n"
      ,
      $from->resourceId,
      $jsonMessage["msg"],
      $numRecv,
      $numRecv == 1 ? '' : 's'
    );

    if ($jsonMessage["chat_type"] === "global") {
      GlobalChat::store($jsonMessage);
      foreach ($this->clients as $client) {
        if ($from !== $client) {
          // The sender is not the receiver, send to each client connected
          $client->send($msg);
        }
      }
    } elseif ($jsonMessage["chat_type"] === "private") {
      PrivateChat::storeMessage($jsonMessage);

      echo "Receiver resourceId: " . $jsonMessage["receiver_id"] . "\n";
      foreach ($this->clients as $client)
      {
          if($from !== $client) {
            $client->send($msg);
          }
      }
    }
  }

  public function onClose(ConnectionInterface $conn)
  {
    // The connection is closed, remove it, as we can no longer send it messages
    $this->clients->detach($conn);

    echo "Connection {$conn->resourceId} has disconnected\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e)
  {
    echo "An error has occurred: {$e->getMessage()}\n";

    $conn->close();
  }
}