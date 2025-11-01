<?php

namespace App\Http\Controllers;

use App\DataTables\BonDeLivraisonDataTable;
use App\Models\BonDeLivraison;
use App\Models\BonDeLivraisonProduct;
use App\Models\Proposal;
use App\Models\ProposalProduct;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BonDeLivraisonController extends Controller
{
    public function index(BonDeLivraisonDataTable $dataTable)
    {
        // Remove permission check temporarily for testing
        $status = BonDeLivraison::$statues;
        $customer = User::where('workspace_id', '=', getActiveWorkSpace())->where('type','Client')->get()->pluck('name', 'id');

        return $dataTable->render('bon_de_livraison.index', compact('customer', 'status'));
    }

    public function show($e_id)
    {
        try {
            $id = Crypt::decrypt($e_id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Bon de Livraison Not Found.'));
        }
        $bonDeLivraison = BonDeLivraison::find($id);
        if($bonDeLivraison)
        {
            $customer = $bonDeLivraison->customer;
            $iteams = $bonDeLivraison->items;
            $status = BonDeLivraison::$statues;
            $company_settings = getCompanyAllSetting();

            return view('bon_de_livraison.view', compact('bonDeLivraison', 'customer', 'iteams', 'status', 'company_settings'));
        }
        else
        {
            return redirect()->back()->with('error', __('Bon de Livraison Not Found.'));
        }
    }

    public function bonDeLivraisonNumber()
    {
        $latest = BonDeLivraison::where('workspace', '=', getActiveWorkSpace())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->bon_de_livraison_id + 1;
    }

    public function convert($proposal_id)
    {
        if(Auth::user()->isAbleTo('proposal convert invoice') || Auth::user()->isAbleTo('proposal manage'))
        {
            $proposal = Proposal::where('id', $proposal_id)->first();
            $proposal->is_convert_bon_de_livraison = 1;
            
            $bonDeLivraison = new BonDeLivraison();

            $bonDeLivraison->bon_de_livraison_id = $this->bonDeLivraisonNumber();
            $bonDeLivraison->customer_id = $proposal->customer_id;
            $bonDeLivraison->proposal_id = $proposal->id;
            $bonDeLivraison->account_type = $proposal->account_type;
            $bonDeLivraison->issue_date = date('Y-m-d');
            $bonDeLivraison->send_date = null;
            $bonDeLivraison->category_id = $proposal->category_id;
            $bonDeLivraison->status = 0;
            $bonDeLivraison->bon_de_livraison_module = $proposal->proposal_module;
            $bonDeLivraison->bon_de_livraison_template = $proposal->proposal_template;
            $bonDeLivraison->workspace = $proposal->workspace;
            $bonDeLivraison->created_by = $proposal->created_by;
            $bonDeLivraison->save();

            $proposal->converted_bon_de_livraison_id = $bonDeLivraison->id;
            $proposal->save();

            if($bonDeLivraison)
            {
                $proposalProduct = ProposalProduct::where('proposal_id', $proposal_id)->get();
                foreach($proposalProduct as $product)
                {
                    $bonDeLivraisonProduct = new BonDeLivraisonProduct();
                    $bonDeLivraisonProduct->bon_de_livraison_id = $bonDeLivraison->id;
                    $bonDeLivraisonProduct->product_type = $product->product_type;
                    $bonDeLivraisonProduct->product_id = $product->product_id;
                    $bonDeLivraisonProduct->quantity = $product->quantity;
                    $bonDeLivraisonProduct->tax = $product->tax;
                    $bonDeLivraisonProduct->discount = $product->discount;
                    $bonDeLivraisonProduct->price = $product->price;
                    $bonDeLivraisonProduct->description = $product->description;
                    $bonDeLivraisonProduct->save();
                }
            }

            return redirect()->back()->with('success', __('Proposal to Bon de Livraison converted successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($id)
    {
        $bonDeLivraison = BonDeLivraison::find($id);
        if($bonDeLivraison)
        {
            BonDeLivraisonProduct::where('bon_de_livraison_id', '=', $bonDeLivraison->id)->delete();
            $bonDeLivraison->delete();

            return redirect()->route('bon-de-livraison.index')->with('success', __('Bon de Livraison deleted successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Bon de Livraison not found.'));
        }
    }

    public function statusChange(Request $request, $id)
    {
        $status = $request->status;
        $bonDeLivraison = BonDeLivraison::find($id);
        $bonDeLivraison->status = $status;
        $bonDeLivraison->save();

        return redirect()->back()->with('success', __('Status changed successfully.'));
    }

    public function saveTemplateSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if(isset($post['bon_de_livraison_logo']))
        {
            $validator = \Validator::make(
                $request->all(),
                [
                    'bon_de_livraison_logo' => 'image|mimes:png,jpg,jpeg|max:2048',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $bon_de_livraison_logo = 'bon_de_livraison_logo' . time() . '.' . $request->bon_de_livraison_logo->getClientOriginalExtension();
            $dir        = 'uploads/bon_de_livraison_logo/';
            $image_path = $dir . $bon_de_livraison_logo;
            
            if(\File::exists($image_path))
            {
                \File::delete($image_path);
            }
            
            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
            
            $path = upload_file($request, 'bon_de_livraison_logo', $bon_de_livraison_logo, $dir, []);
            if($path['flag'] == 0)
            {
                return redirect()->back()->with('error', __($path['msg']));
            }
            $url = $path['url'];
        }
        else
        {
            $validator = \Validator::make(
                $request->all(),
                [
                    'bon_de_livraison_template' => 'required',
                    'bon_de_livraison_color' => 'required',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
        }
        
        if (isset($post['bon_de_livraison_template']) && (!isset($post['bon_de_livraison_color']) || empty($post['bon_de_livraison_color'])))
        {
            $post['bon_de_livraison_color'] = "ffffff";
        }
        
        if(isset($post['bon_de_livraison_logo']))
        {
            $post['bon_de_livraison_logo'] = $url;
        }
        
        if(!isset($post['bon_de_livraison_shipping_display']))
        {
            $post['bon_de_livraison_shipping_display'] = 'off';
        }
        
        if(!isset($post['bon_de_livraison_qr_display']))
        {
            $post['bon_de_livraison_qr_display'] = 'off';
        }
        
        foreach ($post as $key => $value) {
            $data = [
                'key' => $key,
                'workspace' => getActiveWorkSpace(),
                'created_by' => creatorId(),
            ];
            Setting::updateOrInsert($data, ['value' => $value]);
        }
        
        comapnySettingCacheForget();
        return redirect()->back()->with('success', __('Delivery Note Print setting saved successfully.'));
    }

    public function previewBonDeLivraison($template, $color)
    {
        $bonDeLivraison = new BonDeLivraison();

        $customer                   = new \stdClass();
        $customer->email            = '<Email>';
        $customer->shipping_name    = '<Customer Name>';
        $customer->shipping_country = '<Country>';
        $customer->shipping_state   = '<State>';
        $customer->shipping_city    = '<City>';
        $customer->shipping_phone   = '<Customer Phone Number>';
        $customer->shipping_zip     = '<Zip>';
        $customer->shipping_address = '<Address>';
        $customer->billing_name     = '<Customer Name>';
        $customer->billing_country  = '<Country>';
        $customer->billing_state    = '<State>';
        $customer->billing_city     = '<City>';
        $customer->billing_phone    = '<Customer Phone Number>';
        $customer->billing_zip      = '<Zip>';
        $customer->billing_address  = '<Address>';

        $totalTaxPrice = 0;
        $taxesData     = [];

        $items = [];
        for($i = 1; $i <= 3; $i++)
        {
            $item           = new \stdClass();
            $item->name     = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax      = 5;
            $item->discount = 50;
            $item->price    = 100;
            $item->description = 'In publishing and graphic design, Lorem ipsum is a placeholder';

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach($taxes as $k => $tax)
            {
                $taxPrice         = 10;
                $totalTaxPrice    += $taxPrice;
                $itemTax['name']  = 'Tax ' . $k;
                $itemTax['rate']  = '10 %';
                $itemTax['price'] = '$10';
                $itemTaxes[]      = $itemTax;
                if(array_key_exists('Tax ' . $k, $taxesData))
                {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                }
                else
                {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $item->tax_price = 10;
            $items[]       = $item;
        }

        $bonDeLivraison->bon_de_livraison_id = 1;
        $bonDeLivraison->issue_date  = date('Y-m-d H:i:s');
        $bonDeLivraison->due_date    = date('Y-m-d H:i:s');
        $bonDeLivraison->itemData    = $items;
        $bonDeLivraison->totalTaxPrice = 60;
        $bonDeLivraison->totalQuantity = 3;
        $bonDeLivraison->totalRate     = 300;
        $bonDeLivraison->totalDiscount = 10;
        $bonDeLivraison->taxesData     = $taxesData;
        $bonDeLivraison->customField   = [];
        $bonDeLivraison->created_by = \Auth::user()->id;
        $bonDeLivraison->workspace = getActiveWorkSpace();
        
        $customFields = [];
        $preview = 1;
        $color = '#' . $color;
        $font_color = User::getFontColor($color);
        
        $company_logo = get_file(sidebar_logo());
        $company_settings = getCompanyAllSetting();
        
        $bon_de_livraison_logo = isset($company_settings['bon_de_livraison_logo']) ? $company_settings['bon_de_livraison_logo'] : '';
        
        if(!empty($bon_de_livraison_logo))
        {
            $img = get_file($bon_de_livraison_logo);
        }
        else
        {
            $img = $company_logo;
        }
        
        $settings['site_rtl']                = company_setting('site_rtl');
        $settings['company_name']            = 'Company Name';
        $settings['company_email']           = 'demo@gmail.com';
        $settings['company_address']         = 'Company Address';
        $settings['company_city']            = 'City';
        $settings['company_state']           = 'State';
        $settings['company_zipcode']         = 'Zipcode';
        $settings['company_country']         = 'Country';
        $settings['company_telephone']       = '1234567890';
        
        // Bon de Livraison settings
        $settings['bon_de_livraison_footer_title']   = 'Footer Title';
        $settings['bon_de_livraison_footer_notes']   = 'Footer Notes';
        $settings['bon_de_livraison_footer_text']    = 'Your Company Name - Address - Phone - Registration Numbers - Tax Numbers';
        $settings['bon_de_livraison_shipping_display'] = 'on';
        $settings['bon_de_livraison_template'] = $template;
        $settings['bon_de_livraison_color']    = $color;
        $settings['bon_de_livraison_qr_display'] = 'on';
        
        // Proposal settings (for template compatibility)
        $settings['proposal_footer_title']   = 'Footer Title';
        $settings['proposal_footer_notes']   = 'Footer Notes';
        $settings['proposal_shipping_display'] = 'on';
        $settings['proposal_qr_display'] = 'on';
        $settings['proposal_template'] = $template;
        $settings['proposal_color']    = $color;

        // Pass as 'proposal' for template compatibility
        $proposal = $bonDeLivraison;
        $logo = $img;
        $is_bon_de_livraison = true; // Flag to indicate this is a delivery note
        
        // Check if the template view exists, if not use template7 as fallback
        if (!view()->exists('proposal.templates.' . $template)) {
            $template = 'template7';
        }
        
        return view('proposal.templates.' . $template, compact('proposal', 'customer', 'items', 'totalTaxPrice', 'taxesData', 'settings', 'img', 'color', 'logo', 'font_color', 'preview', 'customFields', 'is_bon_de_livraison'));
    }

    public function bonDeLivraisonPdf($bon_de_livraison_id)
    {
        $bonDeLivraisonId = Crypt::decrypt($bon_de_livraison_id);
        $bonDeLivraison   = BonDeLivraison::where('id', $bonDeLivraisonId)->first();

        if(module_is_active('Account'))
        {
            $customer = \Workdo\Account\Entities\Customer::where('user_id', $bonDeLivraison->customer_id)->first();
        }
        else
        {
            $customer = User::where('id', $bonDeLivraison->customer_id)->first();
        }

        $items         = [];
        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        
        foreach ($bonDeLivraison->items as $product) {
            $item = new \stdClass();
            if($bonDeLivraison->bon_de_livraison_module == "taskly")
            {
                $item->name = !empty($product->product())?$product->product()->title:'';
            }
            elseif($bonDeLivraison->bon_de_livraison_module == "account")
            {
                $item->name = !empty($product->product()) ? $product->product()->name : '';
                $item->product_type = !empty($product->product_type) ? $product->product_type : '';
            }
            $item->quantity    = $product->quantity;
            $item->tax         = $product->tax;
            $item->discount    = $product->discount;
            $item->price       = $product->price;
            $item->description = $product->description;

            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            if(module_is_active('ProductService'))
            {
                $taxes = \Workdo\ProductService\Entities\Tax::tax($product->tax);

                $itemTaxes = [];
                if(!empty($item->tax))
                {
                    $tax_price = 0;
                    foreach($taxes as $tax)
                    {
                        $taxPrice = BonDeLivraison::taxRate($tax->rate, $item->price, $item->quantity, $item->discount);
                        $tax_price += $taxPrice;
                        $totalTaxPrice += $taxPrice;

                        $itemTax['name']  = $tax->name;
                        $itemTax['rate']  = $tax->rate . '%';
                        $itemTax['price'] = currency_format_with_sym($taxPrice, $bonDeLivraison->created_by);
                        $itemTaxes[] = $itemTax;

                        if(array_key_exists($tax->name, $taxesData))
                        {
                            $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                        }
                        else
                        {
                            $taxesData[$tax->name] = $taxPrice;
                        }
                    }
                    $item->itemTax = $itemTaxes;
                    $item->tax_price = $tax_price;
                }
                else
                {
                    $item->itemTax = [];
                }

                $items[] = $item;
            }
        }
        
        $bonDeLivraison->itemData = $items;
        $bonDeLivraison->totalTaxPrice = $totalTaxPrice;
        $bonDeLivraison->totalQuantity = $totalQuantity;
        $bonDeLivraison->totalRate = $totalRate;
        $bonDeLivraison->totalDiscount = $totalDiscount;
        $bonDeLivraison->taxesData = $taxesData;

        if(module_is_active('CustomField')){
            $bonDeLivraison->customField = \Workdo\CustomField\Entities\CustomField::getData($bonDeLivraison, 'Base','BonDeLivraison');
            $customFields = \Workdo\CustomField\Entities\CustomField::where('workspace_id', '=', $bonDeLivraison->workspace)->where('module', '=', 'Base')->where('sub_module','BonDeLivraison')->get();
        }else{
            $customFields = null;
        }

        //Set your logo
        $company_logo = get_file(sidebar_logo());
        $company_settings = getCompanyAllSetting($bonDeLivraison->created_by, $bonDeLivraison->workspace);
        $bon_de_livraison_logo = isset($company_settings['bon_de_livraison_logo']) ? $company_settings['bon_de_livraison_logo'] : '';
        
        if(isset($bon_de_livraison_logo) && !empty($bon_de_livraison_logo))
        {
            $img = get_file($bon_de_livraison_logo);
        }
        else{
            $img = $company_logo;
        }
        
        if ($bonDeLivraison) {
            $color = '#'.(!empty($company_settings['bon_de_livraison_color']) ? $company_settings['bon_de_livraison_color'] : 'ffffff');
            $font_color = User::getFontColor($color);

            if(!empty($bonDeLivraison->bon_de_livraison_template))
            {
                $bon_de_livraison_template = $bonDeLivraison->bon_de_livraison_template;
            }
            else{
                $bon_de_livraison_template = (!empty($company_settings['bon_de_livraison_template']) ? $company_settings['bon_de_livraison_template'] : 'template7');
            }

            $settings['site_rtl'] = isset($company_settings['site_rtl']) ? $company_settings['site_rtl'] : '';
            $settings['company_name'] = isset($company_settings['company_name']) ? $company_settings['company_name'] : '';
            $settings['company_email'] = isset($company_settings['company_email']) ? $company_settings['company_email'] : '';
            $settings['company_telephone'] = isset($company_settings['company_telephone']) ? $company_settings['company_telephone'] : '';
            $settings['company_address'] = isset($company_settings['company_address']) ? $company_settings['company_address'] : '';
            $settings['company_city'] = isset($company_settings['company_city']) ? $company_settings['company_city'] : '';
            $settings['company_state'] = isset($company_settings['company_state']) ? $company_settings['company_state'] : '';
            $settings['company_zipcode'] = isset($company_settings['company_zipcode']) ? $company_settings['company_zipcode'] : '';
            $settings['company_country'] = isset($company_settings['company_country']) ? $company_settings['company_country'] : '';
            $settings['registration_number'] = isset($company_settings['registration_number']) ? $company_settings['registration_number'] : '';
            $settings['tax_type'] = isset($company_settings['tax_type']) ? $company_settings['tax_type'] : '';
            $settings['vat_number'] = isset($company_settings['vat_number']) ? $company_settings['vat_number'] : '';
            $settings['bon_de_livraison_footer_title'] = isset($company_settings['bon_de_livraison_footer_title']) ? $company_settings['bon_de_livraison_footer_title'] : '';
            $settings['bon_de_livraison_footer_notes'] = isset($company_settings['bon_de_livraison_footer_notes']) ? $company_settings['bon_de_livraison_footer_notes'] : '';
            
            // Build default footer text only with fields that have values
            if (isset($company_settings['bon_de_livraison_footer_text']) && !empty($company_settings['bon_de_livraison_footer_text'])) {
                $settings['bon_de_livraison_footer_text'] = $company_settings['bon_de_livraison_footer_text'];
            } else {
                $footer_parts = [];
                if (!empty($settings['company_name'])) $footer_parts[] = $settings['company_name'];
                if (!empty($settings['company_address'])) $footer_parts[] = $settings['company_address'];
                if (!empty($settings['company_telephone'])) $footer_parts[] = $settings['company_telephone'];
                if (!empty($settings['registration_number'])) $footer_parts[] = 'RC: ' . $settings['registration_number'];
                if (!empty($settings['tax_type']) && !empty($settings['vat_number'])) $footer_parts[] = $settings['tax_type'] . ': ' . $settings['vat_number'];
                $settings['bon_de_livraison_footer_text'] = !empty($footer_parts) ? implode(' - ', $footer_parts) : '';
            }
            $settings['bon_de_livraison_shipping_display'] = isset($company_settings['bon_de_livraison_shipping_display']) ? $company_settings['bon_de_livraison_shipping_display'] : '';
            $settings['bon_de_livraison_template'] = isset($company_settings['bon_de_livraison_template']) ? $company_settings['bon_de_livraison_template'] : '';
            $settings['bon_de_livraison_color'] = isset($company_settings['bon_de_livraison_color']) ? $company_settings['bon_de_livraison_color'] : '';
            $settings['bon_de_livraison_qr_display'] = isset($company_settings['bon_de_livraison_qr_display']) ? $company_settings['bon_de_livraison_qr_display'] : '';
            
            // Add proposal settings for template compatibility
            $settings['proposal_footer_title'] = $settings['bon_de_livraison_footer_title'];
            $settings['proposal_footer_notes'] = $settings['bon_de_livraison_footer_notes'];
            $settings['proposal_footer_text'] = $settings['bon_de_livraison_footer_text'];
            $settings['proposal_shipping_display'] = $settings['bon_de_livraison_shipping_display'];
            $settings['proposal_qr_display'] = $settings['bon_de_livraison_qr_display'];
            $settings['proposal_template'] = $settings['bon_de_livraison_template'];
            $settings['proposal_color'] = $settings['bon_de_livraison_color'];

            // Pass as 'proposal' for template compatibility
            $proposal = $bonDeLivraison;
            $proposal->proposal_id = $bonDeLivraison->bon_de_livraison_id;
            $proposal->proposal_module = $bonDeLivraison->bon_de_livraison_module;
            $is_bon_de_livraison = true;

            // Check if the template view exists, if not use template7 as fallback
            if (!view()->exists('proposal.templates.' . $bon_de_livraison_template)) {
                $bon_de_livraison_template = 'template7';
            }

            return view('proposal.templates.' . $bon_de_livraison_template, compact('proposal', 'color', 'settings', 'customer', 'img', 'font_color', 'customFields', 'is_bon_de_livraison'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}