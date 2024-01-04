<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Album;
use App\Models\Gallery;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryCollection;
use App\Http\Resources\AlbumCollection;

class GalleryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $galleries = Gallery::all();

        return $this->successResponse(200, trans('api.public.done'), 200, new GalleryCollection($galleries));
    }

    public function album(Gallery $gallery)
    {
        $albums = Album::where('gallery_id',$gallery->id)->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new AlbumCollection($albums));
    }


}
