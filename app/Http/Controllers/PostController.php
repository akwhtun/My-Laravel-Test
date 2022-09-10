<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //post show
    public function create()
    {
        $address = [0 => 'Yangon', 1 => 'Mandalay', 2 => 'Pakokku', 3 => 'Myingyan', 4 => 'Pyay', 5 => 'Sagaing'];
        $posts = Post::when(
            request('searchKey'),
            function ($query) {
                $searchKey = request('searchKey');
                $query->orWhere('title', 'like', '%' . $searchKey . '%')->orWhere('description', 'like', '%' . $searchKey . '%');
            }
        )->orderBy('created_at', 'desc')->paginate(3);
        return view('create', compact('posts', 'address'));

        // $posts = Post::all();
        // dd($posts);

        // $posts = Post::where('id', '>', '6')->pluck('title');
        // $posts = Post::select('title', 'price')->get()->toArray();
        // dd($posts);

        // $posts = Post::where('id', '>', '6')->where('address', 'pyay')->get()->random()->toArray();
        // dd($posts);

        // $posts = Post::where('id', '<', '27')->where('address', 'yangon')->get()->toArray();
        // $posts = Post::orWhere('id', '<', '27')->orWhere('address', 'yangon')->get()->toArray();
        // dd($posts);

        // $posts = Post::orderBy('price', 'desc')->get()->toArray();
        // $posts = Post::select('id', 'price', 'address')->where('address', 'yangon')->whereBetween('price', [30000, 90000])->orderBy('price', 'asc')->dd();
        // $posts = Post::where('address', 'pyay')->dd();
        // dd($posts);

        // $posts = DB::table('posts')->where('id', '>', '1')->value('title');
        // $posts = Post::select('title', 'price')->where('id', '>', '1')->get()->toArray();
        // dd($posts);

        // $posts = Post::find(3)->toArray();
        // $posts = Post::where('id', '3')->first()->toArray();
        // dd($posts);

        // $posts = Post::avg('price');
        // dd($posts);

        // $posts = Post::where('address', 'pyay')->exists();
        // $posts = Post::where('address', 'london')->doesntExist();
        // dd($posts);

        // $posts = Post::select('id', 'title as postTitle', 'title')->where('id', 3)->get()->toArray();
        // dd($posts);

        // $posts = Post::select('address', DB::raw('COUNT(address) as address_count'))->groupBy('address')->get()->toArray();
        // $posts = Post::select('address', DB::raw('COUNT(address) as address_count'), DB::raw('AVG(price) as total_price'))->groupBy('address')->get()->toArray();
        // $posts = Post::select('rating', DB::raw('COUNT(rating)'))->groupBy('rating')->get()->toArray();
        // $posts = Post::select('address', DB::raw('COUNT(address)'), DB::raw('SUM(price) as total_pirce'))->groupBy('address')->get()->toArray();
        // dd($posts);

        // $posts = Post::paginate(5)->through(function ($post) {
        //     $post->title = strtoupper($post->title);
        //     $post->description = strtoupper($post->description);
        //     $post->price = $post->price * 2;
        //     return $post;
        // });
        // dd($posts->toArray());

        // $posts = Post::when(request('key'), function ($p) {
        //     $searchKey = request('key');
        //     $p->where('title', 'like', '%' . $searchKey . '%');
        // })->get();
        // dd($posts->toArray());
    }

    //post Create
    public function postCreate(Request $request)
    {
        $this->getValidationCheck($request);
        $data = $this->getData($request);
        if ($request->hasFile('postImage')) {
            // dd($request->file('postImage')->getClientOriginalName());
            // dd($request->file('postImage'));
            // $request->file('postImage')->store('myImage');
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs(('public'), $fileName);
            $data['image'] = $fileName;
        }
        // dd($data);
        Post::create($data);
        return redirect()->route('post#home')->with(['insertSuccess' => 'Post ဖန္တီးျခင္းေအာင္ျမင္ပါသည္👍✔']);
    }

    //post delete
    public function postDelete($id)
    {
        // Post::where('id', $id)->delete();
        // return redirect()->route('post#home');

        $data = Post::find($id)->delete();
        return back()->with(['deleteSuccess' => 'ဖ်က္လိုက္ပါျပီ။']);
    }

    //post view
    public function postView($id)
    {
        // $data = Post::where('id', $id)->get()->toArray();
        $data = Post::where('id', $id)->first();
        return view('view', compact('data'));
    }

    //post edit
    public function postEdit($id)
    {
        $address = [0 => 'Yangon', 1 => 'Mandalay', 2 => 'Pakokku', 3 => 'Myingyan', 4 => 'Pyay', 5 => 'Sagaing'];
        $editData = Post::where('id', $id)->first()->toArray();
        // dd($editData);
        return view('edit', compact('editData', 'address'));
    }

    //post Update
    public function postUpdate(Request $request)
    {
        $this->getValidationCheck($request);
        $updateData = $this->getData($request);
        $id = $request->postId;
        if ($request->hasFile('postImage')) {
            $oldImage = Post::select('image')->where('id', $id)->first();
            $oldImageName = $oldImage['image'];
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs(('public'), $fileName);
            $updateData['image'] = $fileName;
        }
        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#home')->with(['updateSuccess' => 'update လုပ္ျခင္းေအာင္ျမင္ပါသည္🤞✔']);
    }

    //pirvate create
    private function getData($request)
    {
        $data = [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'address' => $request->postAddress,
            'price' => $request->postPrice,
            'rating' => $request->postRating,
        ];
        return $data;
    }

    //private validation check
    private function getValidationCheck($request)
    {
        $validationRules = [
            'postTitle' => 'required|min:5|unique:posts,title,' . $request->postId,
            'postDescription' => 'required|min:10',
            'postPrice' => 'required',
            'postRating' => 'required',
            'postImage' => 'mimes:jpg,jpeg,png'
        ];
        $validationMessages = [
            'postTitle.required' => 'post title ျဖည့္ရန္လိုအပ္ပါသည္။',
            'postTitle.min' => 'post title သည္ အနည္းဆံုး ၅လံုးအထက္ရွိရမည္။',
            'postTitle.unique' => 'post title တူေနပါသည္။ ထပ္မံျကိုးစားပါ။',
            'postDescription.required' => 'post description ျဖည့္ရန္လိုအပ္ပါသည္။',
            'postDescription.min' => 'post description သည္ အနည္းဆံုး ၁၀လံုးအထက္ရွိရမည္။',
            'postPrice.required' => 'fee ျဖည့္ရန္လိုအပ္ပါသည္။',
            'postRating.required' => 'rating ျဖည့္ရန္လိုအပ္ပါသည္။',
            'postImage.mimes' => 'image file type သည္ jpg, jpeg, png ျဖစ္ရမည္။'
        ];
        Validator::make($request->all(), $validationRules, $validationMessages)->validate();
    }
}