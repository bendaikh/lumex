<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonDeLivraison extends Model
{
    protected $fillable = [
        'bon_de_livraison_id',
        'customer_id',
        'proposal_id',
        'issue_date',
        'send_date',
        'status',
        'category_id',
        'bon_de_livraison_module',
        'bon_de_livraison_template',
        'account_type',
        'workspace',
        'created_by',
    ];

    public static $statues = [
        'Draft',
        'Sent',
        'Accepted',
        'Declined',
        'Close',
    ];

    public function customers()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function category()
    {
        return $this->hasOne(\Workdo\ProductService\Entities\Category::class, 'id', 'category_id');
    }

    public function items()
    {
        return $this->hasMany(BonDeLivraisonProduct::class, 'bon_de_livraison_id', 'id');
    }

    public static function bonDeLivraisonNumberFormat($number, $company_id = null, $workspace = null)
    {
        if(!empty($company_id) && empty($workspace))
        {
            $company_settings = getCompanyAllSetting($company_id);
        }
        elseif(!empty($company_id) && !empty($workspace))
        {
            $company_settings = getCompanyAllSetting($company_id,$workspace);
        }
        else
        {
            $company_settings = getCompanyAllSetting();
        }
        $data = !empty($company_settings['bon_de_livraison_prefix']) ? $company_settings['bon_de_livraison_prefix'] : '#BDL';
        return $data . sprintf("%05d", $number);
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        foreach ($this->items as $product) {
            $subTotal += ($product->price * $product->quantity);
        }
        return $subTotal;
    }

    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach($this->items as $product)
        {
            $totalDiscount += $product->discount;
        }
        return $totalDiscount;
    }

    public function getTotal()
    {
        return ($this->getSubTotal() - $this->getTotalDiscount()) + $this->getTotalTax();
    }

    public function getTotalTax()
    {
        $totalTax = 0;
        foreach ($this->items as $product)
        {
            $taxes = self::tax($product->tax);

            foreach ($taxes as $tax)
            {
                $totalTax += self::taxRate($tax->rate, $product->price, $product->quantity, $product->discount);
            }
        }
        return $totalTax;
    }

    public static function tax($taxes)
    {
        if(module_is_active('ProductService'))
        {
            $taxArr = explode(',', $taxes);
            $taxes  = [];
            foreach($taxArr as $tax)
            {
                $taxes[] = \Workdo\ProductService\Entities\Tax::find($tax);
            }
        }
        else
        {
            $taxes = [];
        }
        return $taxes;
    }

    public static function taxRate($taxRate, $price, $quantity, $discount = 0)
    {
        return (($price * $quantity) - $discount) * ($taxRate / 100);
    }
}