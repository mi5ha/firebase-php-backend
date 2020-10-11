<?php
namespace FirebaseBackend;

require(dirname(__FILE__) . '/../config/config.php');

use FirebaseBackend\API;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\RawMessageFromArray;

class CloudMessaging
{
    public static function sendMulticast()
    {
        // SET POST PARAMS
        // ---------------
        $postParams = API::getPostParams();

        if ($postParams === null) {
            API::response(false, null, ['POST body must be a properly formatted JSON']);
            return;
        }

        // SET API PARAMS
        // --------------
        $deviceTokens = isset($postParams->deviceTokens) ? $postParams->deviceTokens : null;
        $notificationTitle = isset($postParams->title) ? $postParams->title : null;
        $notificationText = isset($postParams->text) ? $postParams->text : null;
        $notificationimageUrl = isset($postParams->imageUrl) ? $postParams->imageUrl : null;

        // VALIDATIONS
        // -----------
        $errorMessages = [];

        // deviceTokens
        if (!$deviceTokens || count($deviceTokens) === 0) {
            $errorMessages['deviceTokens'] = 'At least one device token must be given';
        }

        // notificationTitle
        if (!$notificationTitle) {
            $errorMessages['title'] = 'Notification title must be given';
        }

        // RETURN ERROR RESPONSE
        // ---------------------
        if (count($errorMessages) > 0) {
            API::response(false, null, $errorMessages);
            return;
        }

        // SEND NOTIFICATION
        // -----------------
        $factory = (new Factory)->withServiceAccount(FIREBASE_SERVICE_ACCOUNT_KEY);
        $messaging = $factory->createMessaging();

        // $messageObject = CloudMessage::new();
        // $message = $messageObject->withNotification([
        //     "title" => $notificationTitle,
        //     "body" => $notificationText,
        //     "image" => $notificationimageUrl,
        // ]);

        // API: https://firebase-php.readthedocs.io/en/5.9.0/cloud-messaging.html#sending-a-fully-configured-raw-message
        $message = new RawMessageFromArray([
            "notification" => [
                "title" => $notificationTitle,
                "body" => $notificationText,
                "image" => $notificationimageUrl,
            ],
        ]);
        $report = $messaging->sendMulticast($message, $deviceTokens);

        // Handle error
        $successCount = $report->successes()->count();
        $errorCount = $report->failures()->count();

        $errorMessages = [];
        if ($report->hasFailures()) {
            foreach ($report->failures()->getItems() as $failure) {
                $errorMessages[] = $failure->error()->getMessage();
            }
        }

        if (count($errorMessages) > 0) {
            API::response(
                false,
                null,
                $errorMessages
            );
            return;
        }

        // SUCCESS RESPONSE
        API::response(
            true
        );
    }
}
