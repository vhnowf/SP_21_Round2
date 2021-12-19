<?php

namespace App\Http\Controllers;
use App\Models\feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function showForm() {
        return view('feedback');
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

    public function storeDB(Request $request) {
        $newFeedback = new feedback();
        $newFeedback->email = $request->email;
        $newFeedback->subject = $request->subject;
        $newfeedback->message = $request->message;

        $newFeedback->save();
    }

    public function alert(Request $request) {
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

        $this->storeDB($request);
        return view('alert');
    }
}
