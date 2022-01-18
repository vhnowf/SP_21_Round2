<?php

namespace App\Http\Controllers\Api;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    
    public function show() {
        return view('feedback.index');
    }

  
    public function handleForm(Request $request) {
        $messages = [
            'email.email' => 'Định dạng email không chính xác',
            'email.required' => 'Phải nhập email',
            'subject.required' => 'Bắt buộc phải nhập chủ đề',
            'subject.max' => 'Chủ đề không được vượt quá 50 ký tự',
            'message.required' => 'Nội dung mô tả góp ý bắt buộc nhập'
        ];
        
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|max:50',
            'message' => 'required|max:200'
        ], $messages);
    }

       /**
     * Create Feedback
     * @OA\Post (
     *     path="/feedbacks/store",
     *     tags={"Feedback"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      type="object",
     *                      @OA\Property(
     *                          property="subject",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="message",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "email":"example@gmail.com",
     *                     "subject":"example title",
     *                     "message":"example content"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *          
     *              @OA\Property(property="email", type="string", example="example@gmail.com"),
     *              @OA\Property(property="subject", type="string", example="subject"),
     *              @OA\Property(property="message", type="string", example="message"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="id", type="number", example=1),
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
    public function alert(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input,[
            'email' => 'required|email',
            'subject' => 'required|max:50|min:1',
            'message' => 'required|max:200|min:1'
        ]);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()
            ], 400);
        }
        $category = Category::create($input);
        return $this->sendResponse($category,'Category created successfully.');

        $feedback = Feedback::create($request->all());
        return response()->json([
            'success' => true,
            'msg' => 'Create feedback successfully'
        ], 200);
    }
}
