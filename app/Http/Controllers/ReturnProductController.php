<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReturnProductRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\ReturnProduct;

class ReturnProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $returnproducts = ReturnProduct::all();

        return view('returnproducts.index', compact('returnproducts'));
    }

    public function store(StoreReturnProductRequest $request)
    {
        $returnproduct = ReturnProduct::create($request->validated());

        if ($request->input('photo', false)) {
            $returnproduct->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo','public');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $returnproduct->id]);
        }

        return redirect()->route('returnproducts.index');
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new ReturnProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
