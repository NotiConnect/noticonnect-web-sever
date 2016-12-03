<?php namespace NotiConnect\Repositories\Contracts;
// Brian Wilson

use NotiConnect\Models\Notification;

interface NotificationRepository 
{
	public function get(string $uuid);
	public function getAll();

	public function add(Notification $notification);
	public function update(Notification $notification);

	public function delete(string $uuid);
}
