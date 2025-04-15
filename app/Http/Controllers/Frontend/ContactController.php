<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    //
    public function index(){
        return view("frontend.contact");
    }

    public function store(ContactRequest $request){
        $request->validated() ;
        
        $request->merge([
            "ip_address"=> $request->ip(),
        ]);
        // return $request;
        $contact = Contact::create( $request->all());
        if(!$contact){
            Session::flash("error","contact us error");
            return redirect()->back();
        }
        Session::flash("success","contact us success");
        return redirect()->back();
    }
}
