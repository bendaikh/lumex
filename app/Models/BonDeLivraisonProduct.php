<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonDeLivraisonProduct extends Model
{
    protected $fillable = [
        'product_type',
        'product_id',
        'bon_de_livraison_id',
        'quantity',
        'tax',
        'discount',
        'price',
        'description',
    ];

    public function product()
    {
        $bonDeLivraison = $this->hasMany(BonDeLivraison::class, 'id', 'bon_de_livraison_id')->first();

        if(!empty($bonDeLivraison) && $bonDeLivraison->bon_de_livraison_module == "account")
        {
            if(module_is_active('ProductService'))
            {
                return $this->hasOne(\Workdo\ProductService\Entities\ProductService::class, 'id', 'product_id')->first();
            }
            else
            {
                return [];
            }
        }
        elseif(!empty($bonDeLivraison) && $bonDeLivraison->bon_de_livraison_module == "taskly")
        {
            if(module_is_active('Taskly'))
            {
                return $this->hasOne(\Workdo\Taskly\Entities\Task::class, 'id', 'product_id')->first();
            }
            else
            {
                return [];
            }
        }
        elseif(!empty($bonDeLivraison) && $bonDeLivraison->bon_de_livraison_module == "cmms")
        {
            if(module_is_active('ProductService'))
            {
                return $this->hasOne(\Workdo\ProductService\Entities\ProductService::class, 'id', 'product_id')->first();
            }
            else
            {
                return [];
            }
        }
    }
}