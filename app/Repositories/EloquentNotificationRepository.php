<?php namespace NotiConnect\Repositories;
// Brian Wilson

use Illuminate\Support\Facades\Auth;

use NotiConnect\Repositories\Contracts\NotificationRepository;

use NotiConnect\Notification as EloquentNotification;
use NotiConnect\Icon as EloquentIcon;

use NotiConnect\Models\Notification;

class EloquentNotificationRepository implements NotificationRepository 
{
    /**
     * Authorized user
     *
     * @var mixed $user
     */
    private $user;

    /**
     * Construct an EloquentNotificationRepository instance
     *
     * @param mixed $user Authorized user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get a single Notification belonging to a user
     * with a specific UUID
     *
     * @param string $uuid
     * @return NotiConnect\Models\Notification
     */
    public function get(string $uuid)
    {
        $data = EloquentNotification::with('icon')
            ->where('notifications.user_id', '=', $this->user->id)
            ->where('notifications.uuid', '=', $uuid)
            ->get()
            ->first();

        $notification = new Notification($data->uuid, $data->package_name, $data->title, $data->text,
            $data->sub_text, $data->group, $data->icon->base64);

        return $notification;
    }

    /**
     * Get all Notifications for the user from the database
     *
     * @see NotiConnect\Models\Notification
     * @return array Array of Notification models
     */
    public function getAll()
    {
        $entities = EloquentNotification::with('icon')
            ->where('user_id', '=', $this->user->id)
            ->get();

        $notifications = [];

        foreach ($entities as $data) {
            // copy pasta special lol
            $notification = new Notification($data->uuid, $data->package_name, $data->title, $data->text,
                $data->sub_text, $data->group, $data->icon->base64);
            array_push($notification, $notifications);
        }
        return $notifications;
    }

    /**
     * Persist a new Notification for the user to the database
     * 
     * @see NotiConnect\Models\Notification
     * @param Notification $notification
     * @return self $this
     */
    public function add(Notification $notification)
    {
        $elIcon = new EloquentIcon();
        $elIcon->base64 = $notification->getIconBase64();
        $elIcon->save();
        
        $elNotification = new EloquentNotification();
        $elNotification->uuid = $notification->getUUID();
        $elNotification->package_name = $notification->getPackageName();
        $elNotification->title = $notification->getTitle();
        $elNotification->text = $notification->getText();
        $elNotification->sub_text = $notification->getSubText();
        $elNotification->group = $notification->getGroup();
        $elNotification->user_id = $this->user->id;
        $elNotification->icon_id = $elIcon->id();
        $elNotification->save();

        return $this;
    }

    /**
     * put
     *
     * @param string $uuid
     * @param Notification $notification
     */
    /*
    public function put(string $uuid, Notification $notification)
    {
        $elNotification = EloquentNotification::find($uuid);
        $elIcon = EloquentIcon::find($elNotification->icon_id);

        $elNotification->package_name = $notification->getPackageName();
        $elNotification->title = $notification->getTitle();
        $elNotification->text = $notification->getText();
        $elNotification->sub_text = $notification->getSubText();
        $elNotification->group = $notification->getGroup();
        $elNotification->save();

        $elIcon->base64 = $notification->getIconBase64();
        $elIcon->save();

        return $this;
    }*/

    /**
     * Persist an updated Notification to the database
     *
     * @param Notification $notification
     * @return self $this
     */
    public function update(Notification $notification)
    {
        $uuid = $notification->getUUID();
 
        $elNotification = EloquentNotification::find($uuid);
        $elIcon = EloquentIcon::find($elNotification->icon_id);

        $elNotification->package_name = $notification->getPackageName();
        $elNotification->title = $notification->getTitle();
        $elNotification->text = $notification->getText();
        $elNotification->sub_text = $notification->getSubText();
        $elNotification->group = $notification->getGroup();
        $elNotification->save();

        $elIcon->base64 = $notification->getIconBase64();
        $elIcon->save();

        return $this;
    }

    /**
     * Delete an entry from the database using its UUID
     *
     * @param string $uuid
     */
    public function delete(string $uuid)
    {
        $elNotification = EloquentNotification::find($uuid);
        $elNotification->delete();
    }
}
