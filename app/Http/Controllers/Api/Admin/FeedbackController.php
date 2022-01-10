<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCouponRequest;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Feedback;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FeedbackController extends Controller
{

    /**
     * Show list feedbacks
     * @OA\Get (
     *     path="/feedbacks",
     *     tags={"Feedback"},
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
     *                         property="email",
     *                         type="string",
     *                         example="example@gmail.com"
     *                     ),
     *                      @OA\Property(
     *                         property="subject",
     *                         type="string",
     *                         example="example subject"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         example="example message"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
      $feedbacks = Feedback::all();
      
      return response()->json($feedbacks);
    }

    public function create()
    {
    //    abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbacks.create');
    }

   // public function store(StoreCouponRequest $request)
    //{
    //}

    public function edit($id, Feedback $feedback)
    {
      //  abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response()->json($id,$feedback);
    }

  //  public function update(UpdateCouponRequest $request, Coupon $coupon)
   // {
    //    return redirect()->route('admin.feedbacks.index');
   // }

    public function show(Feedback $feedback)
    {
        return response()->json($feedback);
    }

    public function destroy()
    {
      //  abort_if(Gate::denies('coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //    $coupon->delete();

        return back();
    }

  //  public function massDestroy(MassDestroyCouponRequest $request)
 //   {
    //    Coupon::whereIn('id', request('ids'))->delete();

  //      return response(null, Response::HTTP_NO_CONTENT);
  //  }


}
