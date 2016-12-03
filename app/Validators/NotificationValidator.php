<?php namespace NotiConnect\Validators;
// Brian Wilson

use Validator;
use Illuminate\Http\Request;

use NotiConnect\Validators\Contracts\RequestValidator;

class NotificationValidator implements RequestValidator
{
	private $data;

	private $rules = [
		'uuid' => 'required|unique:notifications|max:255',
		'package_name' => 'required|max:255',
		'title' => 'required|max:255',
		'text' => 'max:255',
		'sub_text' => 'max:255',
		'group' => 'max:255',
		'icon_base64' => 'required|max:255'
	];

	public function __construct(Request $request)
	{
		$this->data = $request->all();
	}

	public function isValid()
	{
		$validator = Validator::make($this->data, $this->rules);
		
		return ! $validator->fails();
	}
}