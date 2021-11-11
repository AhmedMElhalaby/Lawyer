<?php

namespace App\Http\Requests\Api\Ticket;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Ticket\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'title'=>'required|string',
            'message'=>'required',
            'attachment'=>'sometimes|mimes:jpeg,jpg,png'
        ];
    }
    public function run(): JsonResponse
    {
        $Ticket =new  Ticket();
        if (auth('api')->check()) {
            $logged = auth('api')->user();
            $Ticket->setUserId($logged->getId());
            if ($this->filled('name')){
                $Ticket->setName($this->name);
            }else{
                $Ticket->setName($logged->getName());
            }
            if ($this->filled('email')){
                $Ticket->setEmail($this->email);
            }else{
                $Ticket->setEmail($logged->getEmail());
            }
        }
        else{
            if (!$this->filled('name')){
                return $this->failJsonResponse([__('validation.required', ['attribute' => __('crud.Ticket.name')])],422);
            }
            if (!$this->filled('email')){
                return $this->failJsonResponse([__('validation.required', ['attribute' => __('crud.Ticket.email')])],422);
            }
            $Ticket->setName($this->name);
            $Ticket->setEmail($this->email);
        }
        $Ticket->setTitle($this->title);
        $Ticket->setMessage($this->message);
        if($this->hasFile('attachment')) {
            $Ticket->setAttachment($this->file('attachment'));
        }
        $Ticket->save();
        return $this->successJsonResponse([__('messages.saved_successfully')],new TicketResource($Ticket),'Ticket');
    }
}
