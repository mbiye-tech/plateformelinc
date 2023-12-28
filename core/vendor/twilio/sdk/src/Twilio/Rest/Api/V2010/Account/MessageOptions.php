<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class MessageOptions {
    /**
     * @param string $from The phone number that initiated the message
     * @param string $messagingServiceSid The SID of the Messaging Service you want
     *                                    to associate with the message.
     * @param string $body The text of the message you want to send. Can be up to
     *                     1,600 characters in length.
     * @param string[] $mediaUrl The URL of the media to send with the message
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $applicationSid The application to use for callbacks
     * @param string $maxPrice The total maximum price up to 4 decimal places in US
     *                         dollars acceptable for the message to be delivered.
     * @param bool $provideFeedback Whether to confirm delivery of the message
     * @param int $attempt Total numer of attempts made , this inclusive to send
     *                     out the message
     * @param int $validityPeriod The number of seconds that the message can remain
     *                            in our outgoing queue.
     * @param bool $forceDelivery Reserved
     * @param string $contentRetention Determines if the message content can be
     *                                 stored or redacted based on privacy settings
     * @param string $addressRetention Determines if the address can be stored or
     *                                 obfuscated based on privacy settings
     * @param bool $smartEncoded Whether to detect Unicode characters that have a
     *                           similar GSM-7 character and replace them
     * @param string[] $persistentAction Rich actions for Channels Messages.
     * @param string $scheduleType Pass the value `fixed` to schedule a message at
     *                             a fixed time.
     * @param \DateTime $sendAt The time that Twilio will send the message. Must be
     *                          in ISO 8601 format.
     * @param bool $sendAsMms If set to True, Twilio will deliver the message as a
     *                        single MMS message, regardless of the presence of
     *                        media.
     * @return CreateMessageOptions Options builder
     */
    public static function create(string $from = Values::NONE, string $messagingServiceSid = Values::NONE, string $body = Values::NONE, array $mediaUrl = Values::ARRAY_NONE, string $statusCallback = Values::NONE, string $applicationSid = Values::NONE, string $maxPrice = Values::NONE, bool $provideFeedback = Values::NONE, int $attempt = Values::NONE, int $validityPeriod = Values::NONE, bool $forceDelivery = Values::NONE, string $contentRetention = Values::NONE, string $addressRetention = Values::NONE, bool $smartEncoded = Values::NONE, array $persistentAction = Values::ARRAY_NONE, string $scheduleType = Values::NONE, \DateTime $sendAt = Values::NONE, bool $sendAsMms = Values::NONE): CreateMessageOptions {
        return new CreateMessageOptions($from, $messagingServiceSid, $body, $mediaUrl, $statusCallback, $applicationSid, $maxPrice, $provideFeedback, $attempt, $validityPeriod, $forceDelivery, $contentRetention, $addressRetention, $smartEncoded, $persistentAction, $scheduleType, $sendAt, $sendAsMms);
    }

    /**
     * @param string $to Filter by messages sent to this number
     * @param string $from Filter by from number
     * @param string $dateSentBefore Filter by date sent
     * @param string $dateSent Filter by date sent
     * @param string $dateSentAfter Filter by date sent
     * @return ReadMessageOptions Options builder
     */
    public static function read(string $to = Values::NONE, string $from = Values::NONE, string $dateSentBefore = Values::NONE, string $dateSent = Values::NONE, string $dateSentAfter = Values::NONE): ReadMessageOptions {
        return new ReadMessageOptions($to, $from, $dateSentBefore, $dateSent, $dateSentAfter);
    }

    /**
     * @param string $body The text of the message you want to send
     * @param string $status Set as `canceled` to cancel a message from being sent.
     * @return UpdateMessageOptions Options builder
     */
    public static function update(string $body = Values::NONE, string $status = Values::NONE): UpdateMessageOptions {
        return new UpdateMessageOptions($body, $status);
    }
}

class CreateMessageOptions extends Options {
    /**
     * @param string $from The phone number that initiated the message
     * @param string $messagingServiceSid The SID of the Messaging Service you want
     *                                    to associate with the message.
     * @param string $body The text of the message you want to send. Can be up to
     *                     1,600 characters in length.
     * @param string[] $mediaUrl The URL of the media to send with the message
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $applicationSid The application to use for callbacks
     * @param string $maxPrice The total maximum price up to 4 decimal places in US
     *                         dollars acceptable for the message to be delivered.
     * @param bool $provideFeedback Whether to confirm delivery of the message
     * @param int $attempt Total numer of attempts made , this inclusive to send
     *                     out the message
     * @param int $validityPeriod The number of seconds that the message can remain
     *                            in our outgoing queue.
     * @param bool $forceDelivery Reserved
     * @param string $contentRetention Determines if the message content can be
     *                                 stored or redacted based on privacy settings
     * @param string $addressRetention Determines if the address can be stored or
     *                                 obfuscated based on privacy settings
     * @param bool $smartEncoded Whether to detect Unicode characters that have a
     *                           similar GSM-7 character and replace them
     * @param string[] $persistentAction Rich actions for Channels Messages.
     * @param string $scheduleType Pass the value `fixed` to schedule a message at
     *                             a fixed time.
     * @param \DateTime $sendAt The time that Twilio will send the message. Must be
     *                          in ISO 8601 format.
     * @param bool $sendAsMms If set to True, Twilio will deliver the message as a
     *                        single MMS message, regardless of the presence of
     *                        media.
     */
    public function __construct(string $from = Values::NONE, string $messagingServiceSid = Values::NONE, string $body = Values::NONE, array $mediaUrl = Values::ARRAY_NONE, string $statusCallback = Values::NONE, string $applicationSid = Values::NONE, string $maxPrice = Values::NONE, bool $provideFeedback = Values::NONE, int $attempt = Values::NONE, int $validityPeriod = Values::NONE, bool $forceDelivery = Values::NONE, string $contentRetention = Values::NONE, string $addressRetention = Values::NONE, bool $smartEncoded = Values::NONE, array $persistentAction = Values::ARRAY_NONE, string $scheduleType = Values::NONE, \DateTime $sendAt = Values::NONE, bool $sendAsMms = Values::NONE) {
        $this->options['from'] = $from;
        $this->options['messagingServiceSid'] = $messagingServiceSid;
        $this->options['body'] = $body;
        $this->options['mediaUrl'] = $mediaUrl;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['applicationSid'] = $applicationSid;
        $this->options['maxPrice'] = $maxPrice;
        $this->options['provideFeedback'] = $provideFeedback;
        $this->options['attempt'] = $attempt;
        $this->options['validityPeriod'] = $validityPeriod;
        $this->options['forceDelivery'] = $forceDelivery;
        $this->options['contentRetention'] = $contentRetention;
        $this->options['addressRetention'] = $addressRetention;
        $this->options['smartEncoded'] = $smartEncoded;
        $this->options['persistentAction'] = $persistentAction;
        $this->options['scheduleType'] = $scheduleType;
        $this->options['sendAt'] = $sendAt;
        $this->options['sendAsMms'] = $sendAsMms;
    }

    /**
     * A Twilio phone number in [E.164](https://www.twilio.com/docs/glossary/what-e164) format, an [alphanumeric sender ID](https://www.twilio.com/docs/sms/send-messages#use-an-alphanumeric-sender-id), or a [Channel Endpoint address](https://www.twilio.com/docs/sms/channels#channel-addresses) that is enabled for the type of message you want to send. Phone numbers or [short codes](https://www.twilio.com/docs/sms/api/short-code) purchased from Twilio also work here. You cannot, for example, spoof messages from a private cell phone number. If you are using `messaging_service_sid`, this parameter must be empty.
     *
     * @param string $from The phone number that initiated the message
     * @return $this Fluent Builder
     */
    public function setFrom(string $from): self {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * The SID of the [Messaging Service](https://www.twilio.com/docs/sms/services#send-a-message-with-copilot) you want to associate with the Message. Set this parameter to use the [Messaging Service Settings and Copilot Features](https://www.twilio.com/console/sms/services) you have configured and leave the `from` parameter empty. When only this parameter is set, Twilio will use your enabled Copilot Features to select the `from` phone number for delivery.
     *
     * @param string $messagingServiceSid The SID of the Messaging Service you want
     *                                    to associate with the message.
     * @return $this Fluent Builder
     */
    public function setMessagingServiceSid(string $messagingServiceSid): self {
        $this->options['messagingServiceSid'] = $messagingServiceSid;
        return $this;
    }

    /**
     * The text of the message you want to send. Can be up to 1,600 characters in length.
     *
     * @param string $body The text of the message you want to send. Can be up to
     *                     1,600 characters in length.
     * @return $this Fluent Builder
     */
    public function setBody(string $body): self {
        $this->options['body'] = $body;
        return $this;
    }

    /**
     * The URL of the media to send with the message. The media can be of type `gif`, `png`, and `jpeg` and will be formatted correctly on the recipient's device. The media size limit is 5MB for supported file types (JPEG, PNG, GIF) and 500KB for [other types](https://www.twilio.com/docs/sms/accepted-mime-types) of accepted media. To send more than one image in the message body, provide multiple `media_url` parameters in the POST request. You can include up to 10 `media_url` parameters per message. You can send images in an SMS message in only the US and Canada.
     *
     * @param string[] $mediaUrl The URL of the media to send with the message
     * @return $this Fluent Builder
     */
    public function setMediaUrl(array $mediaUrl): self {
        $this->options['mediaUrl'] = $mediaUrl;
        return $this;
    }

    /**
     * The URL we should call using the `status_callback_method` to send status information to your application. If specified, we POST these message status changes to the URL: `queued`, `failed`, `sent`, `delivered`, or `undelivered`. Twilio will POST its [standard request parameters](https://www.twilio.com/docs/sms/twiml#request-parameters) as well as some additional parameters including `MessageSid`, `MessageStatus`, and `ErrorCode`. If you include this parameter with the `messaging_service_sid`, we use this URL instead of the Status Callback URL of the [Messaging Service](https://www.twilio.com/docs/sms/services/api). URLs must contain a valid hostname and underscores are not allowed.
     *
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The SID of the application that should receive message status. We POST a `message_sid` parameter and a `message_status` parameter with a value of `sent` or `failed` to the [application](https://www.twilio.com/docs/usage/api/applications)'s `message_status_callback`. If a `status_callback` parameter is also passed, it will be ignored and the application's `message_status_callback` parameter will be used.
     *
     * @param string $applicationSid The application to use for callbacks
     * @return $this Fluent Builder
     */
    public function setApplicationSid(string $applicationSid): self {
        $this->options['applicationSid'] = $applicationSid;
        return $this;
    }

    /**
     * The maximum total price in US dollars that you will pay for the message to be delivered. Can be a decimal value that has up to 4 decimal places. All messages are queued for delivery and the message cost is checked before the message is sent. If the cost exceeds `max_price`, the message will fail and a status of `Failed` is sent to the status callback. If `MaxPrice` is not set, the message cost is not checked.
     *
     * @param string $maxPrice The total maximum price up to 4 decimal places in US
     *                         dollars acceptable for the message to be delivered.
     * @return $this Fluent Builder
     */
    public function setMaxPrice(string $maxPrice): self {
        $this->options['maxPrice'] = $maxPrice;
        return $this;
    }

    /**
     * Whether to confirm delivery of the message. Set this value to `true` if you are sending messages that have a trackable user action and you intend to confirm delivery of the message using the [Message Feedback API](https://www.twilio.com/docs/sms/api/message-feedback-resource). This parameter is `false` by default.
     *
     * @param bool $provideFeedback Whether to confirm delivery of the message
     * @return $this Fluent Builder
     */
    public function setProvideFeedback(bool $provideFeedback): self {
        $this->options['provideFeedback'] = $provideFeedback;
        return $this;
    }

    /**
     * Total number of attempts made ( including this ) to send out the message regardless of the provider used
     *
     * @param int $attempt Total numer of attempts made , this inclusive to send
     *                     out the message
     * @return $this Fluent Builder
     */
    public function setAttempt(int $attempt): self {
        $this->options['attempt'] = $attempt;
        return $this;
    }

    /**
     * How long in seconds the message can remain in our outgoing message queue. After this period elapses, the message fails and we call your status callback. Can be between 1 and the default value of 14,400 seconds. After a message has been accepted by a carrier, however, we cannot guarantee that the message will not be queued after this period. We recommend that this value be at least 5 seconds.
     *
     * @param int $validityPeriod The number of seconds that the message can remain
     *                            in our outgoing queue.
     * @return $this Fluent Builder
     */
    public function setValidityPeriod(int $validityPeriod): self {
        $this->options['validityPeriod'] = $validityPeriod;
        return $this;
    }

    /**
     * Reserved
     *
     * @param bool $forceDelivery Reserved
     * @return $this Fluent Builder
     */
    public function setForceDelivery(bool $forceDelivery): self {
        $this->options['forceDelivery'] = $forceDelivery;
        return $this;
    }

    /**
     * Determines if the message content can be stored or redacted based on privacy settings
     *
     * @param string $contentRetention Determines if the message content can be
     *                                 stored or redacted based on privacy settings
     * @return $this Fluent Builder
     */
    public function setContentRetention(string $contentRetention): self {
        $this->options['contentRetention'] = $contentRetention;
        return $this;
    }

    /**
     * Determines if the address can be stored or obfuscated based on privacy settings
     *
     * @param string $addressRetention Determines if the address can be stored or
     *                                 obfuscated based on privacy settings
     * @return $this Fluent Builder
     */
    public function setAddressRetention(string $addressRetention): self {
        $this->options['addressRetention'] = $addressRetention;
        return $this;
    }

    /**
     * Whether to detect Unicode characters that have a similar GSM-7 character and replace them. Can be: `true` or `false`.
     *
     * @param bool $smartEncoded Whether to detect Unicode characters that have a
     *                           similar GSM-7 character and replace them
     * @return $this Fluent Builder
     */
    public function setSmartEncoded(bool $smartEncoded): self {
        $this->options['smartEncoded'] = $smartEncoded;
        return $this;
    }

    /**
     * Rich actions for Channels Messages.
     *
     * @param string[] $persistentAction Rich actions for Channels Messages.
     * @return $this Fluent Builder
     */
    public function setPersistentAction(array $persistentAction): self {
        $this->options['persistentAction'] = $persistentAction;
        return $this;
    }

    /**
     * Indicates your intent to schedule a message. Pass the value `fixed` to schedule a message at a fixed time.
     *
     * @param string $scheduleType Pass the value `fixed` to schedule a message at
     *                             a fixed time.
     * @return $this Fluent Builder
     */
    public function setScheduleType(string $scheduleType): self {
        $this->options['scheduleType'] = $scheduleType;
        return $this;
    }

    /**
     * The time that Twilio will send the message. Must be in ISO 8601 format.
     *
     * @param \DateTime $sendAt The time that Twilio will send the message. Must be
     *                          in ISO 8601 format.
     * @return $this Fluent Builder
     */
    public function setSendAt(\DateTime $sendAt): self {
        $this->options['sendAt'] = $sendAt;
        return $this;
    }

    /**
     * If set to True, Twilio will deliver the message as a single MMS message, regardless of the presence of media.
     *
     * @param bool $sendAsMms If set to True, Twilio will deliver the message as a
     *                        single MMS message, regardless of the presence of
     *                        media.
     * @return $this Fluent Builder
     */
    public function setSendAsMms(bool $sendAsMms): self {
        $this->options['sendAsMms'] = $sendAsMms;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.CreateMessageOptions ' . $options . ']';
    }
}

class ReadMessageOptions extends Options {
    /**
     * @param string $to Filter by messages sent to this number
     * @param string $from Filter by from number
     * @param string $dateSentBefore Filter by date sent
     * @param string $dateSent Filter by date sent
     * @param string $dateSentAfter Filter by date sent
     */
    public function __construct(string $to = Values::NONE, string $from = Values::NONE, string $dateSentBefore = Values::NONE, string $dateSent = Values::NONE, string $dateSentAfter = Values::NONE) {
        $this->options['to'] = $to;
        $this->options['from'] = $from;
        $this->options['dateSentBefore'] = $dateSentBefore;
        $this->options['dateSent'] = $dateSent;
        $this->options['dateSentAfter'] = $dateSentAfter;
    }

    /**
     * Read messages sent to only this phone number.
     *
     * @param string $to Filter by messages sent to this number
     * @return $this Fluent Builder
     */
    public function setTo(string $to): self {
        $this->options['to'] = $to;
        return $this;
    }

    /**
     * Read messages sent from only this phone number or alphanumeric sender ID.
     *
     * @param string $from Filter by from number
     * @return $this Fluent Builder
     */
    public function setFrom(string $from): self {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * The date of the messages to show. Specify a date as `YYYY-MM-DD` in GMT to read only messages sent on this date. For example: `2009-07-06`. You can also specify an inequality, such as `DateSent<=YYYY-MM-DD`, to read messages sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` to read messages sent on or after midnight on a date.
     *
     * @param string $dateSentBefore Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSentBefore(string $dateSentBefore): self {
        $this->options['dateSentBefore'] = $dateSentBefore;
        return $this;
    }

    /**
     * The date of the messages to show. Specify a date as `YYYY-MM-DD` in GMT to read only messages sent on this date. For example: `2009-07-06`. You can also specify an inequality, such as `DateSent<=YYYY-MM-DD`, to read messages sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` to read messages sent on or after midnight on a date.
     *
     * @param string $dateSent Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSent(string $dateSent): self {
        $this->options['dateSent'] = $dateSent;
        return $this;
    }

    /**
     * The date of the messages to show. Specify a date as `YYYY-MM-DD` in GMT to read only messages sent on this date. For example: `2009-07-06`. You can also specify an inequality, such as `DateSent<=YYYY-MM-DD`, to read messages sent on or before midnight on a date, and `DateSent>=YYYY-MM-DD` to read messages sent on or after midnight on a date.
     *
     * @param string $dateSentAfter Filter by date sent
     * @return $this Fluent Builder
     */
    public function setDateSentAfter(string $dateSentAfter): self {
        $this->options['dateSentAfter'] = $dateSentAfter;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.ReadMessageOptions ' . $options . ']';
    }
}

class UpdateMessageOptions extends Options {
    /**
     * @param string $body The text of the message you want to send
     * @param string $status Set as `canceled` to cancel a message from being sent.
     */
    public function __construct(string $body = Values::NONE, string $status = Values::NONE) {
        $this->options['body'] = $body;
        $this->options['status'] = $status;
    }

    /**
     * The text of the message you want to send. Can be up to 1,600 characters long.
     *
     * @param string $body The text of the message you want to send
     * @return $this Fluent Builder
     */
    public function setBody(string $body): self {
        $this->options['body'] = $body;
        return $this;
    }

    /**
     * When set as `canceled`, allows a message cancelation request if a message has not yet been sent.
     *
     * @param string $status Set as `canceled` to cancel a message from being sent.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.UpdateMessageOptions ' . $options . ']';
    }
}