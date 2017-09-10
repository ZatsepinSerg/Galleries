<?php

namespace App\Http\Controllers;

use App\Mail\CallMasterClass;
use App\RequestCallback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showClientsRequest = RequestCallback::orderBy('status','ASC')->paginate(20);
        
        return view('admin.request_client.index',compact('showClientsRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'userName'=>'required|min:3',
            'userTelephon'=>'required|min:10|max:15',
            'userEmail'=>'required',
            'messageText'=>'required|min:30'
        ]);

        //---------сохранение в БД запроса от пользователя

        $requestCallback = new RequestCallback();
        $requestCallback->name_clients = $request->userName;
        $requestCallback->telephon = $request->userTelephon;
        $requestCallback->email = $request->userEmail;
        $requestCallback->message = $request->messageText;
        $requestCallback->save();

        //после успеха отправляем  сообщение

        Mail::to($request->userEmail)
            ->send(new CallMasterClass($request->userName, $request->userTelephon, $request->messageText));//отправка заказчику

        //Mail::to('zatsepin@accbox.info')->send(new CallMasterClass($name, $userTelephon, $messageText));//отправка админу

        return $request->userName . "----" . $request->userTelephon;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientRequest =  RequestCallback::find($id);

        return view('admin.request_client.show',compact('clientRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newMessage(){

//        $this->validate($request,[
//            'action' =>$request->action
//        ]);

         $countNewMessage = RequestCallback::where('status','=','0')->count();

        return $countNewMessage;
    }
}
