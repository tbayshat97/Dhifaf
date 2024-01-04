<?php

namespace App\Http\Controllers\API\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contact as ResourcesContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class ContactController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::where('id',1)->first();
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesContact($contact));
    }
}
