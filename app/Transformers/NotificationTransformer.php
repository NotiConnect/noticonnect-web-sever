<?php namespace NotiConnect\Transformers;
// Brian Wilson

use Leauge\Fractal;

use NotiConnect\Models\Notification;

class NotificationTransformer extends Fractal\TransformerAbstract
{
	public function transform(Notification $notification)
	{
		return [
			'uuid' => $notification->getUUID(),
			'packageName' => $notification->getPackageName(),
			'title' => $notification->getTitle(),
			'text' => $notification->getText(),
			'subText' => $notification->getSubText(),
			'group' => $notification->getGroup(),
			'iconBase64' => $notification->getIconBase64()
		];
	}
}