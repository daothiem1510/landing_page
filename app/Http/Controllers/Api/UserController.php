<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\UserRepository;
use Repositories\GroupRepository;
use \Pusher\Pusher;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepo,GroupRepository $groupRepo){
        $this->userRepo = $userRepo;
        $this->groupRepo = $groupRepo;
    }
    public function seenNotification(Request $request){
        \App\Notification::where('id',$request->id)->update(['read_at'=>date('Y-m-d H:i:s')]);
        return response()->json(['error' => false]);
    }
    public function getMessage(Request $request){
        $input = $request->all();
        $my_id = $input['from'];
        $recever_id = $input['to'];
        \App\Message::where(['from' => $recever_id, 'to' => $my_id])->update(['is_read' => 1]);
        $messages = \App\Message::where(function ($query) use ($my_id, $recever_id) {
            $query->where('from', $recever_id)->where('to', $my_id);
        })->orWhere(function ($query) use ($recever_id, $my_id) {
            $query->where('from', $my_id)->where('to', $recever_id);
        })->orderBy('created_at','ASC')->get();
        $user = $this->userRepo->find($recever_id);
        $html = '<div class="chat-box show">
            <div class="chat-head">
                <h6>'.$user->name.'</h6>
                <div class="more">
                    <span class="close-mesage"><i class="fa fa-times"></i></span>
                </div>
            </div>
            <div class="chat-list">
                <ul class="ps-container ps-theme-default ps-active-y">';
        foreach($messages as $key=>$val){
            if($val->from == $my_id){
                $html .='<li class="me">
                            <div class="chat-thumb"><img src="/img/img_avatar.png" alt="" class="avatar-img"></div>
                            <div class="notification-event">
                                <span class="chat-message-item">
                                    '.$val->message.'
                                </span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">'.date('d M y, h:i a',strtotime($val->created_at)).'</time></span>
                            </div>
                        </li>';
            }else{
                $html .='<li class="you">
                            <div class="chat-thumb"><img src="/img/img_avatar.png" alt="" class="avatar-img"></div>
                            <div class="notification-event">
                                <span class="chat-message-item">
                                    '.$val->message.'
                                </span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">'.date('d M y, h:i a',strtotime($val->created_at)).'</time></span>
                            </div>
                        </li>';
            } 
        }
        $html .='<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; height: 290px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 215px;"></div></div>
                </ul>
                <div class="text-box">
                    <input type="hidden" name="receiver_id" value="'.$recever_id.'" id="receiver_id" />
                        <input type="hidden" name="my_id" value="'.$my_id.'" id="my_id" />  
                    <input type="hidden" name="type" value="1" id="type_message" /> 
                    <label class="custom-file-upload">
                        <input type="file" class="upload-file"/>
                        <i class="fa fa-cloud-upload"></i>
                    </label>     
                    <textarea placeholder="'.trans('base.send_message').'..." name="message" id="content_message"></textarea>
                </div>
            </div>
        </div>
    </div>';
        return response()->json(['error' => false,'html'=>$html]); 
    }
     public function sendMessage(Request $request)
        {
            if($request->get('type') == 1){
                $from = $request->my_id;
                $to = $request->receiver_id;
                $message = $request->message;
                $data = new \App\Message();
                $user = $this->userRepo->find($from);
                $data->from = $from;
                $data->to = $to;
                $data->message = $message;
                $data->is_read = 0;
                $data->save();
                $options = array(
                    'cluster' => 'ap2',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                            '5f3ce4afb73cda497160', '15ad04271fdbcf026ce4', '961459', $options
                    );
                $data = ['from' => $from, 'to' => $to,'message'=>$message,'name'=>$user->name];
                $pusher->trigger('chat-message', 'send-message', $data);
            }else{
                $from = $request->my_id;
                $to = $request->receiver_id;
                $message = $request->message;
                $data = new \App\GroupMessage();
                $user = $this->userRepo->find($from);
                $group = $this->groupRepo->find($to);
                $user_id = $group->user()->pluck('id')->toArray();
                $data->from = $from;
                $data->group_id = $to;
                $data->message = $message;
                $data->save();
                $options = array(
                    'cluster' => 'ap2',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                            '5f3ce4afb73cda497160', '15ad04271fdbcf026ce4', '961459', $options
                    );
                $data = ['from' => $from, 'to' => $user_id,'message'=>$message,'user_name'=>$user->name,'group_id'=>$to];
                $pusher->trigger('chat-group-message', 'send-group-message', $data);
            }
        }
    public function sendFileMessage(Request $request)
    {
        $file = $request->file;
        $destinationPath = 'uploads';
        $files = $destinationPath . '/' . $file->getClientOriginalName();
        $file_name = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());
        $ext = pathinfo($files, PATHINFO_EXTENSION);
        if($ext == 'jpg' || $ext == 'png' || $ext == 'gif'){
            $message = '<a href="/'.$files.'" data-lighter><img src="/'.$files.'" style="width:60px;height:60px"></a>';
        }else{
            $message = '<a href="/'.$files.'">'.$file_name.' <i class="fa fa-download"></i></a>';
        }
        if($request->get('type') == 1){
            $from = $request->my_id;
            $to = $request->receiver_id;
            $data = new \App\Message();
            $user = $this->userRepo->find($from);
            $data->from = $from;
            $data->to = $to;
            $data->message = $message;
            $data->is_read = 0;
            $data->save();
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );
            $pusher = new Pusher(
                        '5f3ce4afb73cda497160', '15ad04271fdbcf026ce4', '961459', $options
                );
            $data = ['from' => $from, 'to' => $to,'message'=>$message,'name'=>$user->name];
            $pusher->trigger('chat-message', 'send-message', $data);
        }else{
            $from = $request->my_id;
            $to = $request->receiver_id;
            $data = new \App\GroupMessage();
            $user = $this->userRepo->find($from);
            $group = $this->groupRepo->find($to);
            $user_id = $group->user()->pluck('id')->toArray();
            $data->from = $from;
            $data->group_id = $to;
            $data->message = $message;
            $data->save();
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );
            $pusher = new Pusher(
                        '5f3ce4afb73cda497160', '15ad04271fdbcf026ce4', '961459', $options
                );
            $data = ['from' => $from, 'to' => $user_id,'message'=>$message,'user_name'=>$user->name,'group_id'=>$to];
            $pusher->trigger('chat-group-message', 'send-group-message', $data);
        }
    }
    public function getAllMessage(Request $request){
        $id = $request->get('id');
        $user_message = \DB::table('user')->leftjoin('messages','user.id','=','messages.to')->select('user.id','user.name')->where('user.id','<>',$id)->where('user.id','<>',1)
                            ->groupBy('user.id','user.name')->get();
        $group_message = \DB::table('groups')->leftjoin('group_messages','groups.id','=','group_messages.group_id')->select('groups.id','groups.name')
                         ->join('group_user','group_user.group_id','=','groups.id')->where('group_user.user_id','=',$id)
                            ->groupBy('groups.id','groups.name')->get();
        foreach($user_message as $key=>$val){
            $my_id = $id;
            $recever_id = $val->id;
            $message = \App\Message::where(function ($query) use ($my_id, $recever_id) {
                                                $query->where('from', $recever_id)->where('to', $my_id);
                                            })->orWhere(function ($query) use ($recever_id, $my_id) {
                                                $query->where('from', $my_id)->where('to', $recever_id);
                                            })->orderBy('created_at','DESC')->first();
            $user_message[$key]->message = $message ? $message->message :'';
            $user_message[$key]->created = $message ? date('d/m, h:i a',strtotime($message->created_at)) :'';
            $user_message[$key]->created_at = $message ? $message->created_at :'';
            $user_message[$key]->is_read = ( $message && $message->is_read == 0 && $message->to == $my_id) ? 0 : 1 ;
        }
        foreach($group_message as $key=>$val){
            $my_id = $id;
            $group_id = $val->id;
            $message = \App\GroupMessage::where('group_id',$group_id)->orderBy('created_at','DESC')->first();
            $group_message[$key]->message = $message ? $message->message :'';
            $group_message[$key]->created = $message ? date('d/m, h:i a',strtotime($message->created_at)) :'';
            $group_message[$key]->created_at = $message ? $message->created_at :'';
        }
        $group_message = collect($group_message)->sortBy('created_at')->reverse();
        $user_message = collect($user_message)->sortBy('created_at')->reverse();
        $html='';
        foreach( $group_message as $val){
            if(strpos($val->message, '</a>') == true){
                $val->message='Đã gửi 1 file';
            };
            $html .= '<li class="media content-mess top-0" class="group'.$val->id.'">
                        <a href="javascript:void(0)" style="width:100%" class="group-message" data-from="'.$id.'" data-to="'.$val->id.'">
                            <div class="mr-3 position-relative">
                                <img src="/img/img_avatar.png" width="36" height="36" class="rounded-circle" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title">
                                    <span class="font-weight-semibold">'.$val->name.'</span>
                                    <span class="text-muted float-right font-size-sm">'.$val->created.'</span>
                                </div>
                                <span class="black"> '.substr($val->message,0,40).' </span>
                            </div>
                        </a>
                    </li>';
        }
        foreach( $user_message as $val){
            if($val->is_read == 0){
                $seen='actve-message'; 
            }else{
                $seen='';
            }
            if(strpos($val->message, '</a>') == true){
                $val->message='Đã gửi 1 file';
            };
            $html .= '<li class="media '.$seen.' content-mess top-0" class="user'.$val->id.'">
                        <a href="javascript:void(0)" style="width:100%" class="message" data-from="'.$id.'" data-to="'.$val->id.'">
                            <div class="mr-3 position-relative">
                                <img src="/img/img_avatar.png" width="36" height="36" class="rounded-circle" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title">
                                    <span class="font-weight-semibold">'.$val->name.'</span>
                                    <span class="text-muted float-right font-size-sm">'.$val->created.'</span>
                                </div>
                                <span class="black"> '.substr($val->message,0,40).' </span>
                            </div>
                        </a>
                    </li>';
        }
        return response()->json(['error' => false,'html'=>$html]); 
    }
}
