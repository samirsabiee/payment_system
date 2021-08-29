<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Support\Discount\Coupon\CouponValidator;
use App\Support\Discount\Coupon\Validator\Contracts\CouponValidatorInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponsController extends Controller
{

    private CouponValidator $validator;

    /**
     * CouponsController constructor.
     * @param CouponValidator $validator
     */
    public function __construct(CouponValidator $validator)
    {
        $this->middleware('auth');
        $this->validator = $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponRequest $request
     * @return RedirectResponse
     */
    public function store(CouponRequest $request): RedirectResponse
    {
        try {
            $coupon = Coupon::where('code', $request->coupon)->firstOrFail();
            $this->validator->isValid($coupon);
            session()->put(['coupon' => $coupon]);
            return redirect()->back()->with('success', true);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', true);
        }
    }

    public function remove(): RedirectResponse
    {
        session()->forget('coupon');
        return redirect()->back();
    }
}
