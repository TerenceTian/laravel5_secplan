<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\CreateShopsRequest;
use Chromabits\Purifier\Contracts\Purifier;
use Repositories\Api\IShopRepository;
use Auth;

class ShopsController extends Controller
{

    public function __construct(IShopRepository $shop, Purifier $purifier) {

        $this->shop = $shop;
        $this->purifier = $purifier;

        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('manager', ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $shops = $this->shop->getAllShops();

        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('shops.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateShopsRequest $request
     * @return Response
     */
    public function store(CreateShopsRequest $request) {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data = $this->purifier->clean($data);
        $shop = $this->shop->createOrUpdate($data);

        return redirect()->route('shops.show', $shop->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        $shop = $this->shop->getShopById($id);
        $items = $this->shop->getItemsInShop($id);

        return view('shops.show', compact('shop', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        $shop = $this->shop->getShopById($id);
        $this->RedirectIfNotOwner($shop->user_id);

        return view('shops.create_edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CreateShopsRequest $request
     * @return Response
     */
    public function update($id, CreateShopsRequest $request) {
        $data = $request->all();
        $shop = $this->shop->getShopById($id);
        $this->RedirectIfNotOwner($shop->user_id);

        //$data['user_id'] = Auth::user()->id;
        $data = $this->purifier->clean($data);
        $this->shop->createOrUpdate($data, $id);

        return redirect()->route('shops.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $shop = $this->shop->getShopById($id);
        $this->RedirectIfNotOwner($shop->user_id);

        $this->shop->destroy($id);

        return redirect()->route('shops.index');
    }

}
