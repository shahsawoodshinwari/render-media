<?php

namespace App\Traits;

use Kreait\Firebase\Factory;
use App\Models\FirebaseToken;
use Kreait\Firebase\Messaging;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\MessageTarget;

/**
 * Trait FirebaseMessagingTrait
 *
 * This trait provides methods to send notifications using Firebase Cloud Messaging (FCM).
 * It requires the Kreait/Firebase package for messaging functionality.
 * Make sure to install the required packages before using this trait.
 *
 * Usage:
 * - Include this trait in a class where you want to use the Firebase Messaging functionality.
 * - You can then use the methods provided by this trait to send notifications to topics or specific devices.
 */
trait FirebaseMessagingTrait
{
  /**
   * Get the Messaging instance for Firebase Cloud Messaging.
   *
   * @return Messaging
   */
  protected function getMessagingInstance(): Messaging
  {
    // Get the path to the firebase-credentials.json file in the storage/public folder
    $credentialsPath = storage_path('firebase/firebase-credentials.json');

    // Create a new Firebase instance with the service account credentials
    $firebase = (new Factory())->withServiceAccount($credentialsPath);

    // Create and return the Messaging instance
    return $firebase->createMessaging();
  }

  /**
   * Send a notification to a specific topic using Firebase Cloud Messaging.
   *
   * @param string $topic The topic to send the notification to.
   * @param string $title The title of the notification.
   * @param string $message The message content of the notification.
   * @param array $body Additional data to include in the notification.
   * @return bool Returns true if the notification was sent successfully, otherwise false.
   */
  public function sendNotificationToTopic($topic, $title, $message, $body)
  {
    // Create the notification and message objects
    $notification = Notification::create($title, $message);
    $message = CloudMessage::withTarget(MessageTarget::TOPIC, $topic)
        ->withNotification($notification)
        ->withData($body);

    // Send the notification using the Messaging instance
    $messaging = $this->getMessagingInstance();
    $messaging->send($message);

    return true;
  }

  /**
   * Send a notification to a specific user's device token using Firebase Cloud Messaging.
   *
   * @param string $token The device token of the user to send the notification to.
   * @param string $title The title of the notification.
   * @param string $message The message content of the notification.
   * @param array $body Additional data to include in the notification.
   * @return bool Returns true if the notification was sent successfully, otherwise false.
   */
  public function sendNotificationToSpecificDevice($token, $title, $message, $body)
  {
    // Create the notification and message objects
    $notification = Notification::create($title, $message);
    $message = CloudMessage::withTarget(MessageTarget::TOKEN, $token)
        ->withNotification($notification)
        ->withData($body);

    // Send the notification using the Messaging instance
    $messaging = $this->getMessagingInstance();
    $messaging->send($message);

    return true;
  }

  /**
   * Send a notification to multiple user devices using Firebase Cloud Messaging.
   *
   * @param array $tokens An array of device tokens to send the notification to.
   * @param string $title The title of the notification.
   * @param string $message The message content of the notification.
   * @param array $data Additional data to include in the notification.
   * @return array An array containing the result of the notification sending.
   */
  public function sendNotificationToMultipleDevices($tokens, $title, $message, $data)
  {
    // Create the notification and message objects
    $notification = Notification::create($title, $message);
    $cloudMessage = CloudMessage::new()
        ->withNotification($notification)
        ->withData($data);

    // Send the multicast notification using the Messaging instance
    $messaging = $this->getMessagingInstance();
    $sendReport = $messaging->sendMulticast($cloudMessage, $tokens);

    // Get success and failure counts
    $successCount = $sendReport->successes()->count();
    $failureCount = $sendReport->failures()->count();

    // Determine response status and message
    $code = 206;
    $status = 'partial_success';
    $message = 'Some notifications failed to send';

    if ($successCount === count($tokens) && $failureCount === 0) {
      $code = 200;
      $status = 'success';
      $message = 'All notifications were sent successfully';
    } elseif ($failureCount === count($tokens)) {
      $code = 400;
      $status = 'failure';
      $message = 'No notifications were sent';
    }
    // Prepare the response
    $response = [
        'code' => $code,
        'status' => $status,
        'successCount' => $successCount,
        'failureCount' => $failureCount,
        'message' => $message,
    ];

    return $response;
  }

  public function subscribeToTopic($topic, $deviceToken)
  {
    $messaging = $this->getMessagingInstance();
    $messaging->subscribeToTopic($topic, $deviceToken);
    return true;
  }

  public function unsubscribeFromTopic($topic, $deviceToken)
  {
    $messaging = $this->getMessagingInstance();
    $messaging->unsubscribeFromTopic($topic, $deviceToken);
    return true;
  }

  public static function updateFirebaseToken(Model $model, String $newFcmToken, String $oldFcmToken = null)
  {
    $firebaseToken = FirebaseToken::where('token', $oldFcmToken)->first();
    if ($firebaseToken) {
      $firebaseToken->token = $newFcmToken;
      $firebaseToken->save();
    } else {
      $firebaseToken = FirebaseToken::where('token', $newFcmToken)->first();
      if (!$firebaseToken) {
        $model->firebaseTokens()->create(['token' => $newFcmToken]);
      }
    }
    return true;
  }
}
