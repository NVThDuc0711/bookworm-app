<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FilterReviewsRequest;
use App\Http\Requests\PostReviewRequest;
use App\Http\Requests\PostReviewsRequest;
use App\Respositories\ProductRepository;

class ReviewController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(FilterReviewsRequest $request)

    {
       
        $validateStatus = $this -> productRepository -> validateIDBook($request->id);
        if($validateStatus){
            $queryParamsArr = $this -> productRepository -> filterQueryParamsForLoadReviews($request);
            $reviews = $this -> productRepository -> filterReviews($request ->id, ...$queryParamsArr);
        }
        return response()->json($reviews, 200);
    }

    public function store(PostReviewRequest $request)
    {
        $validateStatus = $this -> productRepository -> validateIDBook($request->id);
        if($validateStatus){
            $paramsFiltered = $this -> productRepository -> filterParamsForCreateReview($request);
            $review = $this -> productRepository -> createReview($id, ...$paramsFiltered);
        }
        return response()->json($review, 200);
    }
}