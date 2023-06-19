<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Entities\Product;
use Modules\Store\Entities\Store;
use Modules\OrderManagement\Entities\Order;
use Modules\OrderManagement\Entities\SubOrder;

class Dashboard
{
    public function __construct(ProductRepository $productservice)
    {
        $this->productservice = $productservice;
    }

    public static function getActiveStore()
    {
        $records = Store::ActiveOrVerified()->Store()->count();
        return $records;
    }

    public static function getPendingStore()
    {
        $records = Store::Pending()->Store()->count();
        return $records;
    }

    public static function getRejectedStore()
    {
        $records = Store::Rejected()->Store()->count();
        return $records;
    }

    public static function getActiveProduct()
    {
        $records = Product::Active()->WithoutParent()->Store()->count();
        return $records;
    }

    public static function getPendingProduct()
    {
        $records = Product::Pending()->WithoutParent()->Store()->count();
        return $records;
    }

    public static function getunderReviewProduct()
    {
        $records = Product::UnderReview()->WithoutParent()->Store()->count();
        return $records;
    }

    public static function getInactiveProduct()
    {
        $records = Product::Inactive()->WithoutParent()->Store()->count();
        return $records;
    }

    public static function getNewOrder()
    {
        $records = SubOrder::Checkout()->Store()->count();
        return $records;
    }

    public static function getProcessingOrder()
    {
        $records = SubOrder::Paid()->Store()->count();
        return $records;
    }

    public static function getShippingOrder()
    {
        $records = SubOrder::InShipping()->Store()->count();
        return $records;
    }

    public static function getCustomerPendingReviewOrder()
    {
        $records = SubOrder::CustomerPendingReview()->Store()->count();
        return $records;
    }

    public static function getTodaySale()
    {
        $records = SubOrder::Paid()->Store()->Today()->sum('grand_total');
        return $records;
    }

    public static function getCurrentMonthSale()
    {
        $records = SubOrder::Paid()->Store()->CurrentMonth()->sum('grand_total');
        return $records;
    }

    public static function getCurrentMonthRefund()
    {
        $records = SubOrder::Refund()->Store()->CurrentMonth()->sum('grand_total');
        return $records;
    }

    public static function getCurrentMonthCancel()
    {
        $records = SubOrder::SellerCancel()->Store()->CurrentMonth()->sum('grand_total');
        return $records;
    }




}
