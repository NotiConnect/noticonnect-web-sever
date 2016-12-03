<?php namespace NotiConnect\Models;
// Brian Wilson

class Notification 
{
	private $uuid; // ID of \NotiConnect\Models\Relational\Notification
	private $packageName;
	private $title;
	private $text;
	private $subText;
	private $group;
	private $iconBase64;

	public function __construct(string $uuid, string $packageName, string $title, string $text,
	 							string $subText, string $group, string $iconBase64) 
	{

        if (is_null($uuid)) {
            echo 'UUID Missing!'.PHP_EOL;
        }

		$this->setId($uuid)
             ->setPackageName($packageName)
			 ->setTitle($title)
			 ->setText($text)
			 ->setSubText($subText)
			 ->setGroup($group)
			 ->setIconBase64($iconBase64);
	}

	/**
	 * Gets the value of id.
	 *
	 * @return mixed
	 */
	public function getUUID() 
	{
		return $this->uuid;
	}

	/**
	 * Sets the value of id.
	 *
	 * @param mixed $id the $id of the notification
	 * 
	 * @return self
	 */
	public function setUUID($id) 
	{
		$this->uuid = $id;
		return $this;
	}

    /**
     * Gets the value of packageName.
     *
     * @return mixed
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * Sets the value of packageName.
     *
     * @param mixed $packageName the package name
     *
     * @return self
     */
    private function setPackageName($packageName)
    {
        $this->packageName = $packageName;

        return $this;
    }

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    private function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of text.
     *
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the value of text.
     *
     * @param mixed $text the text
     *
     * @return self
     */
    private function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Gets the value of subText.
     *
     * @return mixed
     */
    public function getSubText()
    {
        return $this->subText;
    }

    /**
     * Sets the value of subText.
     *
     * @param mixed $subText the sub text
     *
     * @return self
     */
    private function setSubText($subText)
    {
        $this->subText = $subText;

        return $this;
    }

    /**
     * Gets the value of group.
     *
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Sets the value of group.
     *
     * @param mixed $group the group
     *
     * @return self
     */
    private function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Gets the value of iconBase64.
     *
     * @return mixed
     */
    public function getIconBase64()
    {
        return $this->iconBase64;
    }

    /**
     * Sets the value of iconBase64.
     *
     * @param mixed $iconBase64 the icon base64
     *
     * @return self
     */
    private function setIconBase64($iconBase64)
    {
        $this->iconBase64 = $iconBase64;

        return $this;
    }
}