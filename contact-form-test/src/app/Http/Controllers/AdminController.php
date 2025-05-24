<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query(); 

        // 🔍 検索処理
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->input('gender')!== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('contact_type')) {
            $query->where('category_id', $request->input('contact_type'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // ✅ ページネーション + 検索条件保持
        $results = $query->with('category')->orderByDesc('created_at')->paginate(7)->appends($request->query());

        $categories = Category::orderBy('id')->pluck('content', 'id');
        return view('admin.admin', compact('results', 'categories'));
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('contact_type')) {
            $query->where('category_id', $request->input('contact_type'));
        }

        $contacts = $query->orderByDesc('created_at')->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts.csv",
        ];

        $callback = function () use ($contacts) {
            $handle = fopen('php://output' , 'w');

            foreach($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name ,
                    ['1'=>'男性','2'=>'女性','3'=>'その他'][$contact->gender] ?? '不明',
                    $contact->email,
                    $contact->category->content ?? '不明'
                ]);
            }

            fclose($handle);
        };
        return new StreamedResponse($callback, 200 , $headers);
    }

}