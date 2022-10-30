<?php

namespace Mts\Response;

class Response
{
    private $status = 200;

    public function status($status = 200)
    {
        $this->status = $status;
        return $this;
    }

    public function toJson($data = [])
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($this->status);
        switch ($this->status) {
            case 200 :
                echo json_encode(['status' => 1, 'data' => $data]);
                break;
            case 404:
                echo json_encode(['error' => 'url not found']);
                break;
            default:
                echo json_encode($data);
        }
        app()->close(1);
    }

}