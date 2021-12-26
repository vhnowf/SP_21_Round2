<?php

namespace App\Http\Controllers\Admin;

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

    public function index()
    {
      $feedbacks = Feedback::all();
      
      return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
    //    abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbacks.create');
    }

   // public function store(StoreCouponRequest $request)
    //{
    //}

    public function edit()
    {
      //  abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.feedbacks.edit');
    }

  //  public function update(UpdateCouponRequest $request, Coupon $coupon)
   // {
    //    return redirect()->route('admin.feedbacks.index');
   // }

    public function show(Feedback $feedback)
    {
        return view('admin.feedbacks.show', compact('feedback'));
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
