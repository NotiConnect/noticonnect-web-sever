<?php namespace NotiConnect\Http\Controllers;
// Brian Wilson

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use League\Fractal;

use NotiConnect\Repositories\Contracts\NotificationRepository;
use NotiConnect\Transformers\NotificationTransformer;
use NotiConnect\Validators\NotificationValidator;
use NotiConnect\Models\Business\Notification;
use NotiConnect\Http\Requests;

class NotificationController extends Controller
{
    private $repository;

    public function __construct(/*NotificationRepository $repository*/)
    {
        $this->middleware('auth:api');
        //$this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $repository = resolve(NotificationRepository::class, [Auth::user()]);
        $notifications = $repository->getAll();

        $resource = new Fractal\Resource\Collection($notifications);
        $manager = new Fractal\Manager();

        $json = $manager->createData($resource)->toJson();

        return response($json, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Remove this route
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $repository = resolve(NotificationRepository::class, [Auth::user()]);
        $validator = new NotificationValidator($request);

        if ($validator->isValid()) {
            $notification = new Notification($request['uuid'],
                                             $request['package_name'], 
                                             $request['title'],
                                             $request['text'],
                                             $request['sub_text'],
                                             $request['group'],
                                             $request['icon_base64']
                            );
            $repository->add($notification);

            return response('{"message":"OK"}', 200);
        } else {
            return response('{"error":"Bad request"}', 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = resolve(NotificationRepository::class, [Auth::user()]);
        $notification = $repository->get($id);

        // Create new single item fractal resource
        $resource = new Fractal\Resource\Item($notification, new NotificationTransformer());
        $manager = new Fractal\Manager();

        $json = $manager->createData($resource)->toJson();
        return response($json, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $repository = resolve(NotificationRepository::class, [Auth::user()]);
        $validator = new NotificationValidator($request);
        if ($validator->isValid()) {
            
            $notification = new Notification($uuid,
                                             $request['package_name'], 
                                             $request['title'],
                                             $request['text'],
                                             $request['sub_text'],
                                             $request['group'],
                                             $request['icon_base64']
                            );
            $repository->put($id, $notification);

            return response('{"message":"OK"}', 200);
        } else {
            return response('{"error":"Bad request"}', 402);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $repository = resolve(NotificationRepository::class, [Auth::user()]);
        $repository->delete($id);
        return response('{"message":"OK"}');
    }
}
