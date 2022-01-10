<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $feedback = Feedback::create($request->all());
        dd($feedback);
        return view('alert');
    }
}
