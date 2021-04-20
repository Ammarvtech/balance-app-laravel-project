<?php
use App\User; 

//Notificatation overall the application
function getNotification($title,$body,$user_id,$notification_type = ""){
	//dd("here");
    $user_id=  $user_id;
   // $notification_type=$notification_type ?? "";
    $firebaseToken = User::where('id',$user_id)->whereNotNull('device_token')->pluck('device_token')->all();
    // dd($firebaseToken);

    $SERVER_API_KEY = 'AAAAYQe0JR8:APA91bHnLr80OjHxDwHWStmCDJjPociWYa52GSqOA0qmjCmg5HNHS5L5XCdMHNQNe3_1hW3MYwoYZ8Gdiqv6BbM9ohmPTC4Y2rlmFAGcmdZ4J2iT8h3EFhE0o2PzaiMt68F1Bl2I0iW6';

    $data = [
    "registration_ids" => $firebaseToken,
    "notification" => [
    "title" => $title,
    "body" => $body,  
    "notification_type" => $notification_type,
    'sound'=>"default",  
    ]
    ];
    $dataString = json_encode($data);

    $headers = [
    'Authorization: key=' . $SERVER_API_KEY,
    'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    return curl_exec($ch);
}
  
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}
