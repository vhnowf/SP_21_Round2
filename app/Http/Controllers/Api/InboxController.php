<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use \App\Models\Message;

class InboxController extends Controller
{

      /**
     * Send Message
     * @OA\Post (
     *     path="/api/inbox/store",
     *     tags={"Inbox"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                     @OA\Property(
     *                         property="message",
     *                         type="message",
     *                         example="Example message"
     *                     ),
     *                     @OA\Property(
     *                         property="user_id",
     *                         type="number",
     *                         example=2
     *                     ),
     *                     @OA\Property(
     *                         property="receiver",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="is_seen",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="file",
     *                         type="string",
     *                         example="NULL"
     *                     ),
     *                 ),
     *                 example={
     *                     "id" : 1,
     *                     "message":"example message",
     *                     "user_id": 2,
     *                     "receiver": 1,
     *                     "is_seen" : 1,
     *                     "file" : "NULL",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="example message"),
     *              @OA\Property(property="user_id", type="number", example=2),
     *              @OA\Property(property="receiver", type="number", example=1),
     *              @OA\Property(property="is_seen", type="number", example=1),
     *              @OA\Property(property="file", type="string", example="NULL"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function index() {
        // Show just the users and not the admins as well
        $users = User::where('is_admin', false)->orderBy('id', 'DESC')->get();

        if (auth()->user()->is_admin == false) {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
            return response()->json($messages);

        }   

        return response()->json($messages);
    }


    /**
     * Display inboxes list for admin
     * @OA\Get (
     *     path="/api/inbox/{id}",
     *     tags={"Inbox"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="message",
     *                         example="Example message"
     *                     ),
     *                     @OA\Property(
     *                         property="user_id",
     *                         type="number",
     *                         example="2"
     *                     ),
     *                     @OA\Property(
     *                         property="receiver",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="is_seen",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="file",
     *                         type="string",
     *                         example="NULL"
     *                     )
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function show($id) {
        if (auth()->user()->is_admin == false) {
            abort(404);
        }

        $sender = User::findOrFail($id);

        $users = User::with(['message' => function($query) {
            return $query->orderBy('created_at', 'DESC');
        }])->where('is_admin', false)
            ->orderBy('id', 'DESC')
            ->get();

        if (auth()->user()->is_admin == false) {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
            return view('show', [
                'users' => $users,
                'messages' => $messages,
                'sender' => $sender,
            ]);
        } else {
            $messages = Message::where('user_id', $sender)->orWhere('receiver', $sender)->orderBy('id', 'DESC')->get();
        }

        return  response()->json ([
            'users' => $users,
            'messages' => $messages,
            'sender' => $sender,
        ]);
    }

}
