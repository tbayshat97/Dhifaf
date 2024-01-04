<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AgeGroup;
use App\Enums\ProductGender;
use App\Enums\ProductStatus;
use App\Enums\StockStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Division;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\CrossSaleProduct;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\RelatedProduct;
use App\Models\Size;
use App\Models\UpSaleProduct;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['name' => __('admin-content.products')],
        ];

        $pageConfigs = ['pageHeader' => true];

        $brands = Brand::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $statuses = ProductStatus::asSelectArray();
        $total = Product::count();

        return view('backend.products.list', compact('breadcrumbs', 'pageConfigs', 'brands', 'total', 'categories', 'statuses'));
    }

    public function featured()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['name' => __('admin-content.products')],
        ];

        $pageConfigs = ['pageHeader' => true];

        $brands = Brand::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $statuses = ProductStatus::asSelectArray();
        $total = Product::where('is_featured', true)->count();

        return view('backend.products.featured', compact('breadcrumbs', 'pageConfigs', 'total', 'brands', 'categories', 'statuses'));
    }

    public function newArrival()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['name' => __('admin-content.products')],
        ];

        $pageConfigs = ['pageHeader' => true];

        $brands = Brand::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $statuses = ProductStatus::asSelectArray();
        $total = Product::where('new_arrival', true)->count();

        return view('backend.products.new', compact('breadcrumbs', 'pageConfigs', 'total', 'brands', 'categories', 'statuses'));
    }

    public function onSaleProducts()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['name' => __('admin-content.products')],
        ];

        $pageConfigs = ['pageHeader' => true];

        $brands = Brand::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $statuses = ProductStatus::asSelectArray();
        $total = Product::whereNotNull('sale_price')->count();

        return view('backend.products.on-sale', compact('breadcrumbs', 'pageConfigs', 'total', 'brands', 'categories', 'statuses'));
    }

    public function ajax(Request $request)
    {
        $recordsFiltered = 0;
        $products = Product::query();

        if ($request->filled('new_arrival') && !is_null($request->new_arrival)) {
            $products->where('new_arrival', true);
        }

        if ($request->filled('is_featured') && !is_null($request->is_featured)) {
            $products->where('is_featured', true);
        }

        if ($request->filled('sale_price') && !is_null($request->sale_price)) {
            $products->whereNotNull('sale_price');
        }

        if ($request->filled('code') && !is_null($request->code)) {
            $products->where('code', $request->code);
        }

        if ($request->filled('title') && !is_null($request->title)) {
            $products->whereTranslationLike('title', '%' . trim($request->title) . '%');
        }

        if ($request->filled('code') && !is_null($request->code)) {
            $products->where('code', $request->code);
        }

        if ($request->filled('barcode') && !is_null($request->barcode)) {
            $products->where('barcode', $request->barcode);
        }

        if ($request->filled('price') && !is_null($request->price)) {
            $products->where('price', $request->price);
        }

        if ($request->filled('brand') && !is_null($request->brand)) {
            $products->whereIn('brand_id', [$request->brand]);
        }

        if ($request->filled('categories') && !is_null($request->categories) && count($request->categories)) {
            $products->whereJsonContains('categories', array_map(function ($item) {
                return intval($item);
            }, $request->categories));
        }

        if ($request->filled('status') && !is_null($request->status)) {
            $products->whereIn('status', [(int) $request->status]);
        }

        $recordsFiltered = $products->count();

        $products = $products->skip($request->start)->take($request->length)->orderBy('updated_at', 'desc')->get();

        $data = [];
        $minQty = Setting::where('option_key', 'minimum_qty')->first();
        $minProductQty = $minQty->option_value;

        foreach ($products as $value) {
            $data[] = [
                'id' => $value->id,
                'code' => $value->code,
                'barcode' => $value->barcode,
                'show_url' => route('admin.product.show', $value->id),
                'delete_url' => route('admin.product.destroy', $value->id),
                'image' => $value->getProductImage(),
                'title' => optional($value->translateOrDefault())->title,
                'stock_status' => $value->stock_status,
                'created_at' => $value->created_at->diffForHumans(),
                'updated_at' => $value->updated_at->diffForHumans(),
                'price' => $value->price,
                'qty' => $value->qty,
                'minQty' => $minProductQty,
                'sale_price' => $value->sale_price,
                'featured' => $value->is_featured,
                'is_variant' => $value->is_variant,
                'status' => ProductStatus::fromValue($value->status)->description,
                'related' => route('admin.related-product.show', $value),
                'cross' => route('admin.cross-sale-product.show', $value),
                'up' => route('admin.up-sale-product.show', $value),
                'rate' => route('admin.product.reviews', $value),
            ];
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => Product::count(),
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];
    }

    public function reviews(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['name' => optional($product->translateOrDefault())->title . ' reviews'],
        ];

        $pageConfigs = ['pageHeader' => true];

        return view('backend.products.reviews', compact('breadcrumbs', 'pageConfigs', 'product'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $divisions = Division::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $categories = Category::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $subcategories = [];

        if ($product->category()) {
            $subcategories = $product->category()->sub()->get()->mapWithKeys(function ($item) {
                return [$item->id => $item->translateOrDefault()->name];
            });
        }

        $brands = Brand::whereNull('parent_brand_id')->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $subBrands = [];

        if ($product->brand) {
            $subBrands = $product->brand->childs->mapWithKeys(function ($item) {
                return [$item->id => $item->translateOrDefault()->name];
            });
        }

        $sizes = Size::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $colors = Color::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->translateOrDefault()->name];
        });

        $ageGroup = AgeGroup::asSelectArray();
        $stockStatus = StockStatus::asSelectArray();
        $productGender = ProductGender::asSelectArray();
        $statuses = ProductStatus::asSelectArray();

        $langs = $this->lang;

        $category = json_decode($product->categories);

        $category = is_array($category) ? $category[0] : null;

        $sub_category = json_decode($product->sub_categories);

        $sub_category = is_array($sub_category) ? $sub_category[0] : null;

        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => "admin/product", 'name' => __('admin-content.products')], ['name' => __('admin-content.update')]
        ];

        $addNewBtn = "admin.product.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.products.show', compact(['subcategories', 'sub_category', 'category', 'categories', 'divisions', 'sizes', 'colors', 'brands', 'subBrands', 'statuses', 'langs', 'product', 'breadcrumbs', 'pageConfigs', 'ageGroup', 'stockStatus', 'productGender']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->brand_id = $request->brand;
            $product->sub_brand_id = $request->sub_brand;
            $product->division_id = $request->division;
            $product->categories = json_encode([(int) $request->category]);
            $product->sub_categories = json_encode([(int) $request->subcategory]);
            $product->sale_price = $request->sale_price;

            if ($request->sale_price_from) {
                $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->sale_price_from);
                $product->sale_price_from = $date->format('Y-m-d H:i:s');
            }

            if ($request->sale_price_to) {
                $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->sale_price_to);
                $product->sale_price_to = $date->format('Y-m-d H:i:s');
            }

            if ($request->new_from && $request->new_to) {
                $product->new_arrival = true;
                $new_from = Carbon::createFromFormat('Y-m-d\TH:i', $request->new_from);
                $product->new_from = $new_from->format('Y-m-d H:i:s');

                $new_to = Carbon::createFromFormat('Y-m-d\TH:i', $request->new_to);
                $product->new_to = $new_to->format('Y-m-d H:i:s');
            } else {
                $product->new_arrival = false;
            }

            $product->stock_status = $request->stock_status ? intval($request->stock_status) : null;
            $product->gender = $request->gender ? intval($request->gender) : null;
            $product->age_group = $request->age_group ? intval($request->age_group) : null;
            $product->status = $request->status ? intval($request->status) : null;
            $product->is_featured = ($request->has('is_featured')) ? true : false;
            $product->track_inventory = ($request->has('track_inventory')) ? true : false;
            $product->is_variant = ($request->has('is_variant') && (int) $request->is_variant) ? true : false;
            $product->best_sellers = ($request->has('best_sellers')) ? true : false;
            $product->special_offer = ($request->has('special_offer')) ? true : false;
            $product->new_arrival = ($request->has('new_arrival')) ? true : false;
            $product->search_appearance = ($request->has('search_appearance')) ? true : false;

            $tags = [];

            if ($request->tags) {
                foreach (json_decode($request->tags) as $tag) {
                    array_push($tags, $tag->value);
                }
            }

            $product->tags = json_encode($tags);
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->color_id = $request->color;
            $product->size_id = $request->size;

            if ($request->file('image')) {
                $oldImage = $product->getProductImage();
                $image = uploadFile('product', $request->file('image'), $oldImage);
                $productImage[] = saveFileUploaderMedia($image,  $request->file('image'), 'product');

                $product->image = json_encode($productImage);
            }

            if ($request->file('switcher')) {
                $oldSwitcher = $product->getProductSwitcher();
                $Switcher = uploadFile('product', $request->file('switcher'), $oldSwitcher);
                $productSwitcher[] = saveFileUploaderMedia($Switcher,  $request->file('switcher'), 'product');

                $product->switcher = json_encode($productSwitcher);
            }

            $current_images = getCurrentFileUploaderMedia($request->get('fileuploader-list-gallery'));

            $updated_images = getUpdatedFileUploaderMedia($product->gallery, $current_images);

            if ($request->hasfile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $image = uploadFile('product', $file);
                    $updated_images[] = saveFileUploaderMedia($image,  $file, 'product');
                }
            }

            $product->gallery = json_encode($updated_images);

            $product->save();

            if (!empty($product)) {
                foreach ($this->lang as $lang) {
                    $product->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                    $product->translateOrNew($lang['code'])->description = trim($request->get('description_' . $lang['code']));
                    $product->translateOrNew($lang['code'])->ingredients = trim($request->get('ingredients_' . $lang['code']));
                    $product->translateOrNew($lang['code'])->how_to_use = trim($request->get('how_to_use_' . $lang['code']));

                    $product->save();
                }
            }

            return redirect()->route('admin.product.show', $product->id)->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('admin.product.index'))->with('success', __('system-messages.delete'));
    }

    public function relatedProductShow(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.index'), 'name' => __('admin-content.products'), 'name' => optional($product->translateOrDefault())->title . ' related products'],
        ];

        $pageConfigs = ['pageHeader' => true];

        $products = $product->related();

        return view('backend.products.related.list', compact('product', 'products', 'breadcrumbs', 'pageConfigs'));
    }

    public function relatedDataAjax(Product $product, Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::whereNotIn('id', $product->relatedIds())->whereTranslationLike('title', '%' . trim($search) . '%')->get()->mapWithKeys(function ($item) {
                return [$item->id => optional($item->translateOrDefault())->title];
            });
        }

        return response()->json($data);
    }

    public function relatedProductUpdate(Request $request, Product $product)
    {
        $relatedProduct = new RelatedProduct();
        $relatedProduct->product_id = $product->id;
        $relatedProduct->related_id =  $request->related;
        $relatedProduct->save();

        return redirect()->back()->with('success', __('system-messages.add'));
    }

    public function relatedProductDelete(Request $request, Product $related)
    {
        RelatedProduct::where('product_id', $request->product_id)->where('related_id', $related->id)->delete();

        return redirect()->back()->with('success', __('system-messages.delete'));
    }

    public function crossSaleProductShow(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.index'), 'name' => __('admin-content.products'), 'name' => optional($product->translateOrDefault())->title . ' cross selling products'],
        ];

        $pageConfigs = ['pageHeader' => true];


        $products = $product->crossSale();

        return view('backend.products.cross-sale.list', compact('product', 'products', 'breadcrumbs', 'pageConfigs'));
    }

    public function crossDataAjax(Product $product, Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::whereNotIn('id', $product->crossSaleIds())->whereTranslationLike('title', '%' . trim($search) . '%')->get()->mapWithKeys(function ($item) {
                return [$item->id => optional($item->translateOrDefault())->title];
            });
        }

        return response()->json($data);
    }

    public function crossSaleProductUpdate(Request $request, Product $product)
    {
        $crossSaleProduct =  new CrossSaleProduct();
        $crossSaleProduct->product_id = $product->id;
        $crossSaleProduct->cross_sale_id = $request->cross;
        $crossSaleProduct->save();

        return redirect()->back()->with('success', __('system-messages.add'));
    }

    public function crossSaleProductDelete(Request $request, Product $crossSale)
    {
        CrossSaleProduct::where('product_id', $request->product_id)->where('cross_sale_id', $crossSale->id)->delete();

        return redirect()->back()->with('success', __('system-messages.delete'));
    }

    public function upSaleProductShow(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.index'), 'name' => __('admin-content.products'), 'name' => optional($product->translateOrDefault())->title . ' up selling products'],
        ];

        $pageConfigs = ['pageHeader' => true];

        $products = $product->upSale();

        return view('backend.products.up-sale.list', compact('product', 'products', 'breadcrumbs', 'pageConfigs'));
    }

    public function upDataAjax(Product $product, Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::whereNotIn('id', $product->upSaleIds())->whereTranslationLike('title', '%' . trim($search) . '%')->get()->mapWithKeys(function ($item) {
                return [$item->id => optional($item->translateOrDefault())->title];
            });
        }

        return response()->json($data);
    }

    public function upSaleProductUpdate(Request $request, Product $product)
    {
        $upSaleProduct =  new UpSaleProduct();
        $upSaleProduct->product_id = $product->id;
        $upSaleProduct->up_sale_id = $request->up;
        $upSaleProduct->save();

        return redirect()->back()->with('success', __('system-messages.add'));
    }

    public function upSaleProductDelete(Request $request, Product $upSale)
    {
        UpSaleProduct::where('product_id', $request->product_id)->where('up_sale_id', $upSale->id)->delete();

        return redirect()->back()->with('success', __('system-messages.delete'));
    }

    public function groupProductShow(Product $product)
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => __('admin-content.dashboard')], ['link' => route('admin.product.index'), 'name' => __('admin-content.products'), 'name' => optional($product->translateOrDefault())->title . ' Group'],
        ];

        $pageConfigs = ['pageHeader' => true];

        $products =  optional($product->group)->products() ? optional($product->group)->products() : [];

        return view('backend.products.group.list', compact('product', 'products', 'breadcrumbs', 'pageConfigs'));
    }

    public function groupDataAjax(Product $product, Request $request)
    {
        $data = [];

        $notInProducts = optional($product->group)->productsIds() ? optional($product->group)->productsIds() : [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::whereNotIn('id', $notInProducts)->whereTranslationLike('title', '%' . trim($search) . '%')->get()->mapWithKeys(function ($item) {
                return [$item->id => optional($item->translateOrDefault())->title];
            });
        }

        return response()->json($data);
    }

    public function groupProductUpdate(Request $request, Product $product)
    {
        if ($product->group) {
            $group = $product->group;
            $all = $product->group->productsIds();

            if (($key = array_search($product->id, $all)) !== false) {
                unset($all[$key]);
            }

            $all[] = $request->group;

            $group->product_id = $product->id;

            $group->product_group = json_encode(array_map(function ($item) {
                return intval($item);
            }, array_values($all)));

            $group->save();
        } else {
            $group = new ProductGroup();
            $group->product_id = $product->id;
            $group->product_group = json_encode([(int) $request->group]);
            $group->save();
        }

        return redirect()->back()->with('success', __('system-messages.add'));
    }

    public function groupProductDelete(Request $request, Product $product)
    {
        $parent = Product::find($request->product_id);

        $all = $parent->group->productsIds();

        $all = array_map(function ($item) {
            return intval($item);
        }, $all);

        if (($key = array_search($product->id, $all)) !== false) {
            unset($all[$key]);
        }

        if (($key = array_search($parent->group->product_id, $all)) !== false) {
            unset($all[$key]);
        }

        $group = $parent->group;

        $group->product_group = json_encode(array_values($all));
        $group->save();

        return redirect()->back()->with('success', __('system-messages.delete'));
    }

    public function groupProductDefault(Request $request)
    {
        $oldProduct = Product::find($request->oldDefault);

        $all = $oldProduct->group->productsIds();

        if (($key = array_search((int) $request->newDefault, $all)) !== false) {
            unset($all[$key]);
        }

        $all[] = $oldProduct->id;

        $products = array_map(function ($item) {
            return intval($item);
        }, $all);

        $group = $oldProduct->group;
        $group->product_id = (int) $request->newDefault;
        $group->product_group = json_encode(array_values(array_unique($products)));
        $group->save();

        return response()->json([
            'message' => __('system-messages.update'),
            'url' => route('admin.group-product.show', $group->product_id),
        ]);
    }

    public function subCategories(Request $request)
    {
        $subCategory = SubCategory::where('category_id', $request->id)->get();

        $output = [];

        foreach ($subCategory as $sub) {
            $output[$sub->id] = $sub->translateOrDefault()->name;
        }

        return $output;
    }

    public function subBrands(Request $request)
    {
        $brand = Brand::find($request->id);

        $output = [];

        foreach ($brand->childs as $sub) {
            $output[$sub->id] = $sub->translateOrDefault()->name;
        }

        return $output;
    }
}
