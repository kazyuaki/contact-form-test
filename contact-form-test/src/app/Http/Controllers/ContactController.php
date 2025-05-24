<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{

    public function contact()
    {
        return view('contact.contact');
    }
    //入力 確認 送信
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        // 明示的に tel1〜3 を再代入しておく（viewで old() のために必要）
        $contact['tel1'] = $request->input('tel1');
        $contact['tel2'] = $request->input('tel2');
        $contact['tel3'] = $request->input('tel3');

        // 電話番号の結合
        $contact['tel'] = "{$contact['tel1']}-{$contact['tel2']}-{$contact['tel3']}";

        return view('contact.confirm', compact('contact'));
    }

    public function back(Request $request)
    {
        return redirect('/')->withInput(); // old() に値を戻す
    }

    public function store(ContactRequest $request)
    {
        // dd($request->all());
        $contact = $request->all();

        $contact['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $contact['gender'] = $genderMap[$request->input('gender')];

        Contact::create([
            'category_id' => $request->input('category_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tel' => $contact['tel'],
            'address' => $contact['address'],
            'building' => $contact['building'],
            'detail' => $contact['detail'],
        ]);
        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
