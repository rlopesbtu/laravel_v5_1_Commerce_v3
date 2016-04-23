<?php namespace CodeCommerce\Http\Controllers;
use CodeCommerce\product;
use CodeCommerce\category;
use CodeCommerce\Http\Requests;
use CodeCommerce\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use CodeCommerce\Tag;

class ProductsController extends Controller
{

    private $productModel;


    public function __construct(product $productModel)
    {
     //   $this->middleware('auth'); //auth é o nome do middleware que está declarado no Kernel.php
        $this->productModel = $productModel;

    }

	public function index()
    {

        $products = $this->productModel->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name','id');
        return view('products.create', compact('categories'));
    }

   public function store(Requests\productRequest $request)
    {
        $input = $request->all();

        $arrayTags = $this->tagToArray($input['tags']);

        $product = $this->productModel->fill($input);
        $product->save();

        $product->tags()->sync($arrayTags);


        return redirect()->route('products');
    }



    public function edit($id, Category $category)
    {
        $categories = $category->lists('name','id');
        $product = $this->productModel->find($id);
        return view('products.edit',compact('product','categories'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        return view('products.delete', compact('product'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        foreach($product->images()->getResults() as $image) {
            $this->removeImage($image);
        }
        $product->delete();
        return redirect()->route('products');
    }

    private function removeImage(ProductImage $image)
    {

        $meuStorage = Storage::disk('public_local');
        if($meuStorage->exists($image->id.'.'.$image->extension)){
            $meuStorage->delete($image->id.'.'.$image->extension);
        }
        $image->delete();
     }

    public function update(Requests\productRequest $request, $id)
    {

       $input = $request->all();
       $arrayTags = $this->tagToArray($input['tags']);

       $this->productModel->find($id)->update($request->all());
       $product = Product::find($id);
       $product->tags()->sync($arrayTags);

       return redirect()->route('products');
    }

    public function images($id)
    {
       $product = $this->productModel->find($id);

        return view('products.images', compact('product'));
    }


    public function createImage($id)
    {
        $product = Product::find($id);
        return view('products.create_image', compact('product'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param ProductImage $productImage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);
        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));
        return redirect()->route('products.images',['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);
        $meuStorage = Storage::disk('public_local');
        if($meuStorage->exists($image->id.'.'.$image->extension)){
            $meuStorage->delete($image->id.'.'.$image->extension);
        }
        $product = $image->product;
        $image->delete();
        return redirect()->route('products.images',['id'=>$product->id]);
    }


    private function tagToArray($tags)
    {
        $tags = explode(",", $tags);
        $tags = array_map('trim', $tags);
        $tagCollection = [];
        foreach ($tags as $tag) {
           $t = Tag::firstOrCreate(['name' => $tag]);

            array_push($tagCollection, $t->id);
        }

        return $tagCollection;
    }

}
