<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirestoreService
{
  /**
   * The Firestore client.
   */
  protected $firestore;

  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    $this->firestore = new FirestoreClient([
      'keyFilePath' => storage_path('firebase/firebase-credentials.json'),
    ]);
  }

  /**
   * Get all messages from a collection.
   */
  public function receiveMessages($collection): array
  {
    $documents = $this->firestore->collection($collection)->documents();
    $messages = [];

    foreach ($documents as $document) {
      $messages[] = $document->data();
    }

    return $messages;
  }
}
