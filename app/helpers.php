<?php

if (!function_exists("sendResponse")) {
  function sendResponse($message, $code, $status, $data)
  {
    $meta = [
      "message" => $message,
      "code" => $code,
      "status" => $status
    ];

    return response()->json([
      "meta" => $meta,
      "data" => $data
    ]);
  }
}
